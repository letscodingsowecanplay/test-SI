<div class="sidebar position-fixed border-right col-md-3 col-lg-2 p-0 bg-coklap">
    <div class="offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-body position-static sidebar-sticky d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item mb-3">
                    <a class="d-flex align-items-center gap-2 text-white nav-link {{ (request()->is('admin')) ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <span data-feather="home" class="align-text-bottom text-white"></span>
                        <span class="fw-bold fs-5">Dashboard</span>
                    </a>
                </li>
                @can('datasiswa_access')
                <li class="nav-item mb-3">
                    <a class="d-flex align-items-center gap-2 text-white nav-link {{ request()->is('admin/datasiswa*') ? 'active' : '' }}" href="{{ route('admin.datasiswa.index') }}">
                        <span data-feather="users" class="align-text-bottom text-white"></span>
                        <span class="fw-bold fs-5">Data Siswa</span>
                    </a>
                </li>
                @endcan
                @can('datalatihansiswa_access')
                <li class="nav-item mb-3">
                    <a class="d-flex align-items-center gap-2 text-white nav-link {{ request()->is('admin/datalatihan*') ? 'active' : '' }}" href="{{ route('admin.datalatihan.index') }}">
                        <span data-feather="edit" class="align-text-bottom text-white"></span>
                        <span class="fw-bold fs-5">Data Latihan Siswa</span>
                    </a>
                </li>
                @endcan
                @can('datahasilbelajarsiswa_access')
                <li class="nav-item mb-3">
                    <a class="d-flex align-items-center gap-2 text-white nav-link {{ request()->is('admin/hasilbelajar*') ? 'active' : '' }}" href="{{ route('admin.hasilbelajar.index') }}">
                        <span data-feather="bar-chart-2" class="align-text-bottom text-white"></span>
                        <span class="fw-bold fs-5">Hasil Belajar</span>
                    </a>
                </li>
                @endcan
                @can('editkkm_access')
                <li class="nav-item mb-3">
                    <a class="d-flex align-items-center gap-2 text-white nav-link {{ request()->is('admin/kkm*') ? 'active' : '' }}" href="{{ route('admin.kkm.index') }}">
                        <span data-feather="award" class="align-text-bottom text-white"></span>
                        <span class="fw-bold fs-5">KKM</span>
                    </a>
                </li>
                @endcan
                @php
                    $isSubbab1 = isset($nomorHalaman) && $nomorHalaman >= 1 && $nomorHalaman <= 10;
                    $isSubbab2 = isset($nomorHalaman) && $nomorHalaman >= 11 && $nomorHalaman <= 16;
                @endphp
                @can('materi_access')
                <li class="nav-item mb-3">
                    <a id="menu-subbab-1"
                       class="d-flex align-items-center gap-2 text-white nav-link {{ $isSubbab1 ? 'active' : '' }} fs-5"
                       href="{{ route('admin.materi.index') }}">
                        <span data-feather="folder" class="align-text-bottom text-white"></span>
                        <span class="fw-semibold">SubBab 1: Membandingkan dan Mengurutkan Panjang Benda</span>
                        <span id="gembok-1" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a id="menu-subbab-2"
                       class="d-flex align-items-center gap-2 text-white nav-link {{ $isSubbab2 ? 'active' : '' }} fs-5"
                       href="{{ route('admin.materi.halaman11') }}">
                        <span data-feather="folder" class="align-text-bottom text-white"></span>
                        <span class="fw-semibold">SubBab 2: Mengukur Panjang Benda</span>
                        <span id="gembok-2" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                    </a>
                </li>
                @endcan
                @can('evaluasi_access')
                <li class="nav-item mb-3">
                    <a id="menu-ayo-evaluasi" class="d-flex gap-2 align-items-center nav-link {{ (request()->is('admin/evaluasi*')) ? 'active' : '' }} fs-5 text-white" href="{{ route('admin.evaluasi.petunjuk') }}">
                        <span data-feather="file-text" class="align-text-bottom text-white"></span>
                        <span class="fw-semibold">Evaluasi</span>
                        <span id="gembok-3" class="ms-2 text-danger d-none"><span data-feather="lock"></span></span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
<script>
window.initKunciSidebar = function(statusLulus) {
    const menus = [
        {menu: 'menu-subbab-2', gembok: 'gembok-2', prasyarat: 'ayo-berlatih-2'},
        {menu: 'menu-ayo-evaluasi', gembok: 'gembok-3', prasyarat: 'ayo-berlatih-3'},
    ];
    menus.forEach(item => {
        const menuEl = document.getElementById(item.menu);
        const gembokEl = document.getElementById(item.gembok);
        if (!statusLulus[item.prasyarat] || statusLulus[item.prasyarat] !== 'lulus') {
            menuEl.classList.add('disabled');
            menuEl.style.pointerEvents = 'none';
            menuEl.style.color = '#c2c2c2';
            if (gembokEl) gembokEl.classList.remove('d-none');
        } else {
            menuEl.classList.remove('disabled');
            menuEl.style.pointerEvents = '';
            menuEl.style.color = '';
            if (gembokEl) gembokEl.classList.add('d-none');
        }
    });
}
window.initKunciSidebar(@json($statusLulus ?? []));
</script>
