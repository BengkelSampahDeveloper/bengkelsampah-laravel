@php
$admin = Auth::guard('admin')->user();
$isCabang = $admin->role !== 'admin';
$menu = [
    ['route' => 'dashboard', 'icon' => 'icon/ic_dashboard.svg', 'label' => 'Dashboard'],
    ['route' => 'dashboard.transaksi', 'icon' => 'icon/ic_transaksi.svg', 'label' => 'Transaksi', 'subroutes' => ['dashboard.transaksi', 'dashboard.transaksi.show']],
    ['route' => 'dashboard.sampah', 'icon' => 'icon/ic_sampah.svg', 'label' => 'Sampah', 'subroutes' => ['dashboard.sampah', 'dashboard.sampah.show', 'dashboard.sampah.edit']],
];
if(!$isCabang) {
    $menu = array_merge($menu, [
        ['route' => 'dashboard.category', 'icon' => 'icon/ic_category.svg', 'label' => 'Kategori', 'subroutes' => ['dashboard.category', 'dashboard.category.create', 'dashboard.category.edit', 'dashboard.category.show']],
        ['route' => 'dashboard.user', 'icon' => 'icon/ic_pelanggan.svg', 'label' => 'User', 'subroutes' => ['dashboard.user', 'dashboard.user.edit', 'dashboard.user.show']],
        ['route' => 'dashboard.bank', 'icon' => 'icon/ic_banksampah.svg', 'label' => 'Bank Sampah', 'subroutes' => ['dashboard.bank', 'dashboard.bank.show', 'dashboard.bank.edit', 'dashboard.bank.create']],
        ['route' => 'dashboard.event', 'icon' => 'icon/ic_program.svg', 'label' => 'Event', 'subroutes' => ['dashboard.event', 'dashboard.event.show', 'dashboard.event.create', 'dashboard.event.edit']],
        ['route' => 'dashboard.poin', 'icon' => 'icon/ic_poin.svg', 'label' => 'Poin', 'subroutes' => ['dashboard.poin', 'dashboard.poin.create']],
        ['route' => 'dashboard.artikel', 'icon' => 'icon/ic_artikel.svg', 'label' => 'Artikel', 'subroutes' => ['dashboard.artikel', 'dashboard.artikel.create', 'dashboard.artikel.edit', 'dashboard.artikel.show']],
    ]);
}
$current = Route::currentRouteName();
@endphp

<button class="mobile-toggle" onclick="toggleSidebar()">☰</button>
<div class="sidebar-overlay" onclick="closeSidebar()"></div>
<nav class="sidebar" id="sidebar">
    <div class="logo-section">
        <img src="{{ asset('company/bengkelsampah.png') }}" alt="Logo" class="logo">
    </div>
    <ul class="nav-menu">
        @foreach ($menu as $item)
        <li class="nav-item">
            <a href="{{ route($item['route']) }}" class="nav-link{{ isset($item['subroutes']) && in_array($current, $item['subroutes']) ? ' active' : ($current === $item['route'] ? ' active' : '') }}">
                <span class="nav-icon"><img src="/{{ $item['icon'] }}" alt="{{ $item['label'] }}"></span>
                <span class="nav-text">{{ $item['label'] }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</nav>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }
    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    }
    function toggleCollapse() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
    }
    function toggleUserDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        // Close dropdown when clicking outside
        if (dropdown.style.display === 'block') {
            setTimeout(() => {
                document.addEventListener('click', closeDropdownOnClickOutside);
            }, 0);
        }
    }
    function closeDropdownOnClickOutside(e) {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown && !dropdown.contains(e.target) && !e.target.closest('[onclick="toggleUserDropdown()"]')) {
            dropdown.style.display = 'none';
            document.removeEventListener('click', closeDropdownOnClickOutside);
        }
    }
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }
    });
</script> 