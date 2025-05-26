<header class="navbar sticky-top bg-coklap flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 me-0 px-3 fs-6 text-white d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo" style="height: auto; width: 100px;">
    </a>




    <!-- <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false"
                    aria-label="Toggle search">
                <svg class="bi text-white">
                    <use xlink:href="#search"/>
                </svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-dark" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <svg class="bi text-dark">
                    <use xlink:href="#list"/>
                </svg>
            </button>
        </li>
    </ul> -->

    <div class="dropdown me-3 m-auto">
        <a href="javascript:void(0)" class="dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-lg-start border-0 shadow-sm rounded-0 bg-coklap2">
            <li>
                <a class="dropdown-item bg-coklap2 text-white " href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    {{ __('Keluar') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</header>
