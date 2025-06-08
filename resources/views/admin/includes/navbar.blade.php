<header class="navbar sticky-top bg-coklap flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 me-0 px-3 fs-6 text-white d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <img src="{{ asset('images/Logo-Si-Ukur.png') }}" alt="Logo" style="height: auto; width: 100px;">
    </a>
    <div class="dropdown me-3 m-auto">
        <a href="javascript:void(0)" class="dropdown-toggle text-white fs-5" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-lg-start border-0 shadow-sm rounded-0 bg-coklap2">
            <li>
                <a class="dropdown-item bg-coklap2 text-white fs-5" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Keluar') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</header>
