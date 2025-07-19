<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp message via Zenziva
     *
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function sendMessage($phone, $message)
    {
        try {
            $userkey = env('ZENZIVA_USERKEY_SETOR');
            $passkey = env('ZENZIVA_PASSKEY_SETOR');

            $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
            
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $url);
            curl_setopt($curlHandle, CURLOPT_HEADER, 0);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
            curl_setopt($curlHandle, CURLOPT_POST, 1);
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, [
                'userkey' => $userkey,
                'passkey' => $passkey,
                'to' => $phone,
                'message' => $message
            ]);

            $results = json_decode(curl_exec($curlHandle), true);
            curl_close($curlHandle);

            // Log the response for debugging
            Log::info("WhatsApp notification sent to {$phone}", [
                'response' => $results,
                'message' => $message
            ]);

            // Check if successful (status 1 means success in Zenziva)
            if (isset($results['status']) && $results['status'] == '1') {
                return true;
            }

            Log::error("Failed to send WhatsApp notification to {$phone}", [
                'response' => $results,
                'message' => $message
            ]);

            return false;

        } catch (\Exception $e) {
            Log::error("Error sending WhatsApp notification to {$phone}: " . $e->getMessage(), [
                'message' => $message,
                'exception' => $e
            ]);
            
            return false;
        }
    }

    /**
     * Send setoran notification to bank sampah penanggung jawab
     *
     * @param string $phone
     * @param array $setoranData
     * @return bool
     */
    public function sendSetoranNotification($phone, $setoranData)
    {
        $message = $this->formatSetoranMessage($setoranData);
        return $this->sendMessage($phone, $message);
    }

    /**
     * Format message for setoran notification
     *
     * @param array $setoranData
     * @return string
     */
    private function formatSetoranMessage($setoranData)
    {
        $userName = $setoranData['user_name'] ?? 'User';
        $setoranId = $setoranData['id'] ?? 'N/A';
        $tipeSetor = ucfirst($setoranData['tipe_setor'] ?? 'N/A');
        $estimasiTotal = number_format($setoranData['estimasi_total'] ?? 0);
        $bankName = $setoranData['bank_sampah_name'] ?? 'N/A';
        $userPhone = $setoranData['user_identifier'] ?? 'N/A';
        $address = $setoranData['address_full_address'] ?? 'N/A';
        $tanggalPenjemputan = $setoranData['tanggal_penjemputan'] ?? null;
        $waktuPenjemputan = $setoranData['waktu_penjemputan'] ?? null;

        $message = "🔔 *NOTIFIKASI SETORAN BARU*\n\n";
        $message .= "Halo! Ada setoran sampah baru yang perlu diproses.\n\n";
        $message .= "📋 *Detail Setoran:*\n";
        $message .= "• ID Setoran: #{$setoranId}\n";
        $message .= "• Nama User: {$userName}\n";
        $message .= "• Kontak User: {$userPhone}\n";
        $message .= "• Tipe Setor: {$tipeSetor}\n";
        $message .= "• Estimasi Total: Rp {$estimasiTotal}\n";
        $message .= "• Bank Sampah: {$bankName}\n";
        $message .= "• Alamat: {$address}\n";

        if ($tanggalPenjemputan) {
            $message .= "• Tanggal Penjemputan: " . date('d/m/Y', strtotime($tanggalPenjemputan)) . "\n";
        }

        if ($waktuPenjemputan) {
            $message .= "• Waktu Penjemputan: {$waktuPenjemputan}\n";
        }

        $message .= "\n⚠️ *Status:* Dikonfirmasi\n";
        $message .= "📱 Silakan login ke dashboard admin untuk memproses setoran ini.\n\n";
        $message .= "Terima kasih,\nTim Bengkel Sampah";

        return $message;
    }

    /**
     * Get Zenziva balance for SETOR (transaction) account
     *
     * @return array|null
     */
    public function getZenzivaSetorBalance()
    {
        $userkey = env('ZENZIVA_USERKEY_SETOR');
        $passkey = env('ZENZIVA_PASSKEY_SETOR');
        $url = 'https://console.zenziva.net/api/balance/?userkey=' . $userkey . '&passkey=' . $passkey;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        return $result;
    }
} 