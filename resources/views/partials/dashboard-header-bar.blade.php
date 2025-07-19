@php $isCabang = Auth::guard('admin')->user()->role !== 'admin'; @endphp
<div class="dashboard-header-bar" style="position:sticky;top:0;z-index:20;background:#fff;box-shadow:var(--card-shadow);border-radius:14px;margin-bottom:1.5rem;padding:1.2rem 2rem;display:flex;flex-wrap:wrap;align-items:center;gap:1.2rem;justify-content:space-between;">
    <div style="display:flex;align-items:center;gap:1.2rem;flex:1;min-width:220px;">
        <h2 style="font-size:1.3rem;font-weight:700;color:#39746E;margin:0 1.5rem 0 0;">{{ $title ?? '' }}</h2>
        @if(View::hasSection('header-filters'))
            @yield('header-filters')
        @endif
    </div>
    <div style="display:flex;align-items:center;gap:1.2rem;">
        <!-- Avatar User with Dropdown -->
        <div style="position:relative;">
            <div style="width:40px;height:40px;border-radius:50%;background:#0FB7A6;color:white;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:14px;cursor:pointer;transition:background 0.2s;" onclick="toggleUserDropdown()" onmouseover="this.style.background='#0DA594'" onmouseout="this.style.background='#0FB7A6'">
                {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 2)) }}
            </div>
            <!-- User Dropdown Menu -->
            <div id="userDropdown" style="position:absolute;right:0;top:48px;width:280px;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.15);border:1px solid #E5E6E6;z-index:50;display:none;">
                <div style="padding:20px;border-bottom:1px solid #F3F4F6;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:48px;height:48px;background:#0FB7A6;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:600;font-size:18px;">
                            {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 2)) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <p style="font-size:16px;font-weight:600;color:#39746E;margin:0 0 4px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</p>
                            <p style="font-size:13px;color:#6B7271;margin:0 0 8px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::guard('admin')->user()->email ?? 'admin@example.com' }}</p>
                            <div>
                                <span style="display:inline-flex;align-items:center;padding:4px 8px;border-radius:12px;font-size:11px;font-weight:600;{{ Auth::guard('admin')->user()->role === 'admin' ? 'background:#DBEAFE;color:#1E40AF;' : 'background:#D1FAE5;color:#065F46;' }}">
                                    {{ Auth::guard('admin')->user()->role === 'admin' ? 'Super Admin' : 'Admin Cabang' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding:8px;">
                    <a href="{{ route('admin.profile') }}" style="display:flex;align-items:center;padding:12px 16px;font-size:14px;color:#39746E;border-radius:8px;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='#F3F4F6'" onmouseout="this.style.background='transparent'">
                        <svg style="width:16px;height:16px;margin-right:12px;color:#6B7271;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        View Profile
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="display:flex;align-items:center;padding:12px 16px;font-size:14px;color:#DC2626;border-radius:8px;text-decoration:none;transition:background 0.2s;background:none;border:none;width:100%;cursor:pointer;text-align:left;" onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">
                            <svg style="width:16px;height:16px;margin-right:12px;color:#DC2626;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 