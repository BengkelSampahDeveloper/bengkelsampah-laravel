<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $isCabang = $admin->role !== 'admin' && $admin->id_bank_sampah;
        $bankSampahList = \App\Models\BankSampah::orderBy('nama_bank_sampah')->get();
        
        // Get real Zenziva balance data
        $otpController = new \App\Http\Controllers\Api\OtpController();
        $zenzivaOtpBalance = $otpController->getZenzivaOtpBalance();
        
        // Get real Zenziva balance data for setor
        $whatsappService = new \App\Services\WhatsAppService();
        $zenzivaSetorBalance = $whatsappService->getZenzivaSetorBalance();
        
        // Ganti logika selectedBankId
        $selectedBankId = $isCabang ? $admin->id_bank_sampah : $request->get('bank_sampah_id');
        $periode = $request->get('periode', 'harian');
        $rangeDate = $request->get('range_date');
        $startDate = null; $endDate = null;
        if ($periode === 'range' && $rangeDate) {
            // Coba split dengan ' to ' jika ' - ' tidak ditemukan
            if (strpos($rangeDate, ' to ') !== false) {
                $dates = explode(' to ', $rangeDate);
            } else {
                $dates = explode(' - ', $rangeDate);
            }
            if (count($dates) === 2) {
                $startDate = trim($dates[0]);
                $endDate = trim($dates[1]);
                // Jika format bukan Y-m-d, konversi ke Y-m-d
                try {
                    $startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d');
                    $endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d');
                } catch (\Exception $e) {
                    $startDate = null;
                    $endDate = null;
                }
            }
        }
        $dashboardSummary = $this->getDashboardSummary($selectedBankId, $periode, $startDate, $endDate);
        
        // Data untuk grafik perbandingan
        $comparisonData = $this->getComparisonChartData($selectedBankId, $periode, $startDate, $endDate);

        // 5 transaksi terakhir (semua status, sesuai filter)
        $lastTransactions = \App\Models\Setoran::with('user')
            ->when($selectedBankId, function($q) use ($selectedBankId) {
                $q->where('bank_sampah_id', $selectedBankId);
            })
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 5 top sampah disetor dari transaksi status selesai/berhasil, sesuai filter
        $topSampahSetor = \App\Models\Setoran::whereIn('status', ['selesai', 'berhasil'])
            ->when($selectedBankId, function($q) use ($selectedBankId) {
                $q->where('bank_sampah_id', $selectedBankId);
            })
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get()
            ->flatMap(function($setoran) {
                $items = is_array($setoran->items_json) ? $setoran->items_json : json_decode($setoran->items_json, true);
                return collect($items)->map(function($item) {
                    $sampahId = $item['sampah_id'] ?? $item['id'] ?? null;
                    $gambar = null;
                    if ($sampahId) {
                        $sampah = \App\Models\Sampah::find($sampahId);
                        $gambar = $sampah ? $sampah->gambar : null;
                    }
                    return [
                        'nama' => $item['sampah_nama'] ?? $item['nama_sampah'] ?? $item['nama'] ?? '-',
                        'berat' => floatval($item['aktual_berat'] ?? $item['estimasi_berat'] ?? 0),
                        'gambar' => $gambar,
                    ];
                });
            })
            ->groupBy('nama')
            ->map(function($group) {
                return [
                    'nama' => $group[0]['nama'],
                    'total_berat' => $group->sum('berat'),
                    'jumlah_transaksi' => $group->count(),
                    'gambar' => $group[0]['gambar'] ?? null,
                ];
            })
            ->sortByDesc('total_berat')
            ->take(5)
            ->values()
            ->toArray();
        
        // Legend label untuk grafik perbandingan
        $legendCurrent = '';
        $legendPrevious = '';
        if ($periode === 'harian') {
            $date = $startDate ? \Carbon\Carbon::parse($startDate) : now();
            $legendCurrent = $date->translatedFormat('d F Y');
            $legendPrevious = $date->copy()->subDay()->translatedFormat('d F Y');
        } elseif ($periode === 'mingguan') {
            $date = $startDate ? \Carbon\Carbon::parse($startDate) : now()->startOfWeek();
            $legendCurrent = $date->translatedFormat('d F Y') . ' - ' . $date->copy()->endOfWeek()->translatedFormat('d F Y');
            $legendPrevious = $date->copy()->subWeek()->translatedFormat('d F Y') . ' - ' . $date->copy()->subWeek()->endOfWeek()->translatedFormat('d F Y');
        } elseif ($periode === 'bulanan') {
            $date = $startDate ? \Carbon\Carbon::parse($startDate) : now();
            $legendCurrent = $date->translatedFormat('F Y');
            $legendPrevious = $date->copy()->subMonth()->translatedFormat('F Y');
        } elseif ($periode === 'enam_bulanan') {
            $date = $startDate ? \Carbon\Carbon::parse($startDate) : now();
            $legendCurrent = $date->copy()->subMonths(5)->translatedFormat('F') . ' - ' . $date->translatedFormat('F Y');
            $legendPrevious = $date->copy()->subMonths(11)->translatedFormat('F') . ' - ' . $date->copy()->subMonths(6)->translatedFormat('F Y');
        } elseif ($periode === 'tahunan') {
            $date = $startDate ? \Carbon\Carbon::parse($startDate) : now();
            $legendCurrent = $date->translatedFormat('Y');
            $legendPrevious = $date->copy()->subYear()->translatedFormat('Y');
        }
        if ($periode === 'range' && $startDate && $endDate) {
            $start = \Carbon\Carbon::parse($startDate);
            $end = \Carbon\Carbon::parse($endDate);
            $legendCurrent = $start->translatedFormat('d M Y') . ' - ' . $end->translatedFormat('d M Y');
            $days = $start->diffInDays($end);
            $prevEnd = $start->copy()->subDay();
            $prevStart = $prevEnd->copy()->subDays($days);
            $legendPrevious = $prevStart->translatedFormat('d M Y') . ' - ' . $prevEnd->translatedFormat('d M Y');
        }
        // Grafik tren setoran (30 hari terakhir)
        $trendDays = [];
        $trendValues = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = \Carbon\Carbon::now()->subDays($i);
            $trendDays[] = $day->format('d M');
            $query = \App\Models\Setoran::whereDate('created_at', $day)->where('status', 'selesai');
            if ($selectedBankId) $query->where('bank_sampah_id', $selectedBankId);
            $trendValues[] = $query->count();
        }
        // Grafik distribusi status setoran
        $statusLabels = ['dikonfirmasi','diproses','dijemput','selesai','batal'];
        $statusCounts = [];
        foreach ($statusLabels as $status) {
            $query = \App\Models\Setoran::where('status', $status);
            if ($selectedBankId) $query->where('bank_sampah_id', $selectedBankId);
            $statusCounts[] = $query->count();
        }
        // Top 5 jenis sampah
        $topSampah = [];
        $setorans = \App\Models\Setoran::when($selectedBankId, function($q) use ($selectedBankId) { $q->where('bank_sampah_id', $selectedBankId); })->get();
        $sampahStats = [];
        foreach ($setorans as $setoran) {
            $items = json_decode($setoran->items_json, true) ?? [];
            foreach ($items as $item) {
                $nama = $item['sampah_nama'] ?? 'Unknown';
                $berat = $item['aktual_berat'] ?? $item['estimasi_berat'] ?? 0;
                if (!isset($sampahStats[$nama])) $sampahStats[$nama] = 0;
                $sampahStats[$nama] += $berat;
            }
        }
        arsort($sampahStats);
        $topSampah = array_slice($sampahStats, 0, 5, true);
        // User growth (6 bulan)
        $userGrowthMonths = [];
        $userGrowthCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $userGrowthMonths[] = $month->format('M Y');
            $query = \App\Models\User::where('created_at', '<=', $month->endOfMonth());
        if ($selectedBankId) {
                $query->whereHas('setorans', function($q) use ($selectedBankId) { $q->where('bank_sampah_id', $selectedBankId); });
            }
            $userGrowthCounts[] = $query->count();
        }
        // Revenue analytics (30 hari)
        $revenueDays = [];
        $revenueValues = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = \Carbon\Carbon::now()->subDays($i);
            $revenueDays[] = $day->format('d M');
            $query = \App\Models\Setoran::whereDate('created_at', $day)->where('status', 'selesai');
            if ($selectedBankId) $query->where('bank_sampah_id', $selectedBankId);
            $total = 0;
            foreach ($query->get() as $setoran) {
                $items = json_decode($setoran->items_json, true) ?? [];
                foreach ($items as $item) {
                    $berat = $item['aktual_berat'] ?? $item['estimasi_berat'] ?? 0;
                    $harga = $item['harga_per_satuan'] ?? 0;
                    $total += $berat * $harga;
                }
            }
            $revenueValues[] = $total;
        }
        // Tabel aktivitas terbaru
        $recentSetoran = \App\Models\Setoran::with(['user','bankSampah'])->orderBy('created_at','desc')->limit(10)->get();
        $recentUsers = \App\Models\User::orderBy('created_at','desc')->limit(10)->get();
        $recentEvents = \App\Models\Event::withCount('participants')->orderBy('created_at','desc')->limit(10)->get();
        $recentArticles = \App\Models\Artikel::orderBy('created_at','desc')->limit(10)->get();
        // Statistik event
        $eventStats = [
            'total_events' => \App\Models\Event::count(),
            'active_events' => \App\Models\Event::where('status','active')->count(),
            'completed_events' => \App\Models\Event::where('status','completed')->count(),
        ];
        // Permintaan hapus akun
        $deleteRequests = \App\Models\DeleteAccountRequest::orderBy('created_at','desc')->limit(10)->get();
        // Hitung total sampah setor (kg dan unit)
        $totalSampahKg = 0;
        $totalSampahUnit = 0;
        $setoranSelesai = \App\Models\Setoran::where('status', 'selesai')
            ->when($selectedBankId, function($q) use ($selectedBankId) {
                $q->where('bank_sampah_id', $selectedBankId);
            })
            ->whereBetween('created_at', [$startDate ?? now()->startOfDay(), $endDate ?? now()->endOfDay()])
            ->get();
        foreach ($setoranSelesai as $setoran) {
            $items = is_array($setoran->items_json) ? $setoran->items_json : json_decode($setoran->items_json, true);
            foreach ($items as $item) {
                $satuan = strtolower($item['satuan'] ?? 'kg');
                $berat = floatval($item['aktual_berat'] ?? $item['estimasi_berat'] ?? 0);
                if ($satuan === 'kg') {
                    $totalSampahKg += $berat;
                } else {
                    $totalSampahUnit += $berat;
                }
            }
        }
        return view('dashboard', compact(
            'bankSampahList','zenzivaOtpBalance','zenzivaSetorBalance','dashboardSummary','comparisonData',
            'legendCurrent','legendPrevious','totalSampahKg','totalSampahUnit',
            'trendDays','trendValues','statusLabels','statusCounts','topSampah',
            'userGrowthMonths','userGrowthCounts','revenueDays','revenueValues',
            'recentSetoran','recentUsers','recentEvents','recentArticles','eventStats','deleteRequests',
            'lastTransactions',
            'topSampahSetor',
        ));
    }

    private function getDashboardSummary($selectedBankId, $periode, $startDate, $endDate)
    {
        $now = now();
        $summary = [];
        // Helper for period calculation
        $getPeriodRange = function($periode, $startDate, $endDate, $previous = false) use ($now) {
        if ($periode === 'range' && $startDate && $endDate) {
                $start = \Carbon\Carbon::parse($startDate);
                $end = \Carbon\Carbon::parse($endDate);
                if ($previous) {
                    $days = $start->diffInDays($end);
                    $end = $start->copy()->subDay();
                    $start = $end->copy()->subDays($days);
                }
                return [$start->startOfDay(), $end->endOfDay()];
            }
            switch ($periode) {
                case 'harian':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subDay()->startOfDay(), $baseDate->copy()->subDay()->endOfDay()]
                        : [$baseDate->copy()->startOfDay(), $baseDate->copy()->endOfDay()];
                case 'mingguan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subWeek()->startOfWeek(), $baseDate->copy()->subWeek()->endOfWeek()]
                        : [$baseDate->copy()->startOfWeek(), $baseDate->copy()->endOfWeek()];
                case 'bulanan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subMonth()->startOfMonth(), $baseDate->copy()->subMonth()->endOfMonth()]
                        : [$baseDate->copy()->startOfMonth(), $baseDate->copy()->endOfMonth()];
                case 'enam_bulanan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subMonths(12)->startOfMonth(), $baseDate->copy()->subMonths(6)->endOfMonth()]
                        : [$baseDate->copy()->subMonths(6)->startOfMonth(), $baseDate->copy()->endOfMonth()];
                case 'tahunan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subYear()->startOfYear(), $baseDate->copy()->subYear()->endOfYear()]
                        : [$baseDate->copy()->startOfYear(), $baseDate->copy()->endOfYear()];
                default:
                    return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
            }
        };
        // 1. Total User
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            $userQuery = \App\Models\User::whereHas('setorans', function($q) use ($selectedBankId, $start, $end) {
                if ($selectedBankId) {
                    $q->where('bank_sampah_id', $selectedBankId);
                }
                $q->whereBetween('created_at', [$start, $end]);
            });
            $summary['user' . ($isPrev ? '_prev' : '')] = $userQuery->count();
        }
        // 2. Total Setoran Selesai
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            $setoranQuery = \App\Models\Setoran::where('status', 'selesai')->whereBetween('created_at', [$start, $end]);
            if ($selectedBankId) $setoranQuery->where('bank_sampah_id', $selectedBankId);
            $summary['setoran' . ($isPrev ? '_prev' : '')] = $setoranQuery->count();
        }
        // 3. Total Nilai Setoran (Aktual)
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            $setoranQuery = \App\Models\Setoran::where('status', 'selesai')->whereBetween('created_at', [$start, $end]);
            if ($selectedBankId) $setoranQuery->where('bank_sampah_id', $selectedBankId);
            $summary['nilai_setoran' . ($isPrev ? '_prev' : '')] = $setoranQuery->sum('aktual_total');
        }
        // 4. Total Poin (jumlahkan langsung aktual_total dari setoran tabung yang selesai)
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            $setoranQuery = \App\Models\Setoran::where('status', 'selesai')
                ->where('tipe_setor', 'tabung')
                ->whereBetween('created_at', [$start, $end]);
            if ($selectedBankId) {
                $setoranQuery->where('bank_sampah_id', $selectedBankId);
            }
            $summary['poin_redeem' . ($isPrev ? '_prev' : '')] = $setoranQuery->sum('aktual_total');
        }
        // 5. Total Sampah (Kg dan Unit)
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            $setoranQuery = \App\Models\Setoran::where('status', 'selesai')->whereBetween('created_at', [$start, $end]);
            if ($selectedBankId) $setoranQuery->where('bank_sampah_id', $selectedBankId);
            $totalSampahKg = 0;
            $totalSampahUnit = 0;
            foreach ($setoranQuery->get() as $setoran) {
                $items = is_array($setoran->items_json) ? $setoran->items_json : json_decode($setoran->items_json, true);
                foreach ($items as $item) {
                    $satuan = strtolower($item['satuan'] ?? $item['sampah_satuan'] ?? 'kg');
                    $berat = floatval($item['aktual_berat'] ?? $item['estimasi_berat'] ?? 0);
                    if ($satuan === 'kg') {
                        $totalSampahKg += $berat;
                    } elseif ($satuan === 'unit') {
                        $totalSampahUnit += $berat;
                    }
                }
            }
            $summary['total_sampah_kg' . ($isPrev ? '_prev' : '')] = $totalSampahKg;
            $summary['total_sampah_unit' . ($isPrev ? '_prev' : '')] = $totalSampahUnit;
        }
        return $summary;
    }

    private function getComparisonChartData($selectedBankId, $periode, $startDate, $endDate)
    {
        $now = now();
        $data = [];
        
        // Helper untuk mendapatkan range periode
        $getPeriodRange = function($periode, $startDate, $endDate, $previous = false) use ($now) {
            if ($periode === 'range' && $startDate && $endDate) {
                $start = \Carbon\Carbon::parse($startDate);
                $end = \Carbon\Carbon::parse($endDate);
                if ($previous) {
                    $days = $start->diffInDays($end);
                    $end = $start->copy()->subDay();
                    $start = $end->copy()->subDays($days);
                }
                return [$start->startOfDay(), $end->endOfDay()];
            }
            
            switch ($periode) {
                case 'harian':
                    // FIX: Konsisten dengan logika lainnya
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subDay()->startOfDay(), $baseDate->copy()->subDay()->endOfDay()]
                        : [$baseDate->copy()->startOfDay(), $baseDate->copy()->endOfDay()];
                case 'mingguan':
                    // FIX: Gunakan startDate jika ada, bukan selalu $now
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subWeek()->startOfWeek(), $baseDate->copy()->subWeek()->endOfWeek()]
                        : [$baseDate->copy()->startOfWeek(), $baseDate->copy()->endOfWeek()];
                case 'bulanan':
                    // FIX: Gunakan startDate jika ada, bukan selalu $now
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subMonth()->startOfMonth(), $baseDate->copy()->subMonth()->endOfMonth()]
                        : [$baseDate->copy()->startOfMonth(), $baseDate->copy()->endOfMonth()];
                case 'enam_bulanan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subMonths(12)->startOfMonth(), $baseDate->copy()->subMonths(6)->endOfMonth()]
                        : [$baseDate->copy()->subMonths(6)->startOfMonth(), $baseDate->copy()->endOfMonth()];
                case 'tahunan':
                    $baseDate = $startDate ? \Carbon\Carbon::parse($startDate) : $now;
                    return $previous
                        ? [$baseDate->copy()->subYear()->startOfYear(), $baseDate->copy()->subYear()->endOfYear()]
                        : [$baseDate->copy()->startOfYear(), $baseDate->copy()->endOfYear()];
                default:
                    return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
            }
        };

        // Generate data untuk periode saat ini dan sebelumnya
        foreach ([false, true] as $isPrev) {
            [$start, $end] = $getPeriodRange($periode, $startDate, $endDate, $isPrev);
            
            $periodData = [];
            
            // Generate data points berdasarkan periode
            if ($periode === 'harian') {
                // 24 jam
                for ($i = 0; $i < 24; $i++) {
                    // FIX: Gunakan copy() untuk menghindari modifikasi objek asli
                    $hourStart = $start->copy()->addHours($i);
                    $hourEnd = $start->copy()->addHours($i)->endOfHour();
                    
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$hourStart, $hourEnd]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $hourStart->format('H:i'),
                        'value' => (float) $total
                    ];
                }
            } elseif ($periode === 'mingguan') {
                // 7 hari
                for ($i = 0; $i < 7; $i++) {
                    $day = $start->copy()->addDays($i);
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$day->copy()->startOfDay(), $day->copy()->endOfDay()]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $day->format('D, d M'),
                        'value' => (float) $total
                    ];
                }
            } elseif ($periode === 'bulanan') {
                // Jumlah hari sesuai bulan
                $daysInMonth = $start->daysInMonth;
                for ($i = 0; $i < $daysInMonth; $i++) {
                    $day = $start->copy()->addDays($i);
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$day->copy()->startOfDay(), $day->copy()->endOfDay()]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $day->format('d M'),
                        'value' => (float) $total
                    ];
                }
            } elseif ($periode === 'enam_bulanan') {
                // 6 bulan
                $months = \Carbon\CarbonPeriod::create($start, '1 month', $end);
                foreach ($months as $month) {
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $month->format('M Y'),
                        'value' => (float) $total
                    ];
                }
            } elseif ($periode === 'tahunan') {
                // 12 bulan
                $months = \Carbon\CarbonPeriod::create($start, '1 month', $end);
                foreach ($months as $month) {
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $month->format('M'),
                        'value' => (float) $total
                    ];
                }
            } else {
                // Range custom
                $days = $start->diffInDays($end);
                if ($days <= 31) {
                    $dateRange = \Carbon\CarbonPeriod::create($start, '1 day', $end);
                } else {
                    $interval = max(1, floor($days / 30));
                    $dateRange = \Carbon\CarbonPeriod::create($start, $interval . ' days', $end);
                }
                foreach ($dateRange as $day) {
                    $query = \App\Models\Setoran::where('status', 'selesai')
                        ->whereBetween('created_at', [$day->copy()->startOfDay(), $day->copy()->endOfDay()]);
                    if ($selectedBankId) {
                        $query->where('bank_sampah_id', $selectedBankId);
                    }
                    $total = $query->sum('aktual_total');
                    $periodData[] = [
                        'label' => $day->format('d M'),
                        'value' => (float) $total
                    ];
                }
            }
            
            $data[$isPrev ? 'previous' : 'current'] = $periodData;
        }
        
        return $data;
    }
} 