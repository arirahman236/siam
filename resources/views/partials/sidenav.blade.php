<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" target="_blank">
            <img src="../img/unmu.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">SIAM</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapseAkademik" role="button">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-hat-3 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Akademik</span>
                </a>
                <div class="collapse ms-4 mt-0" id="collapseAkademik">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('KRS') ? 'active' : '' }}" href="/KRS">Lihat KRS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('entri-krs') ? 'active' : '' }}" href="/entri-krs">Entri KRS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('KHS') ? 'active' : '' }}" href="/KHS">Lihat KHS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('rekap-nilai') ? 'active' : '' }}" href="/rekap-nilai">Rekap Nilai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tugas-akhir') ? 'active' : '' }}" href="/tugas-akhir">Tugas Akhir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('wisuda') ? 'active' : '' }}" href="/wisuda">Wisuda</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('keuangan') ? 'active' : '' }}" href="/keuangan">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#collapsePerkuliahan" role="button">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-books text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Perkuliahan</span>
                </a>
                <div class="collapse ms-4 mt-0" id="collapsePerkuliahan">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-link {{ request()->is('jadwal-kuliah') ? 'active' : '' }}">
                            <a class="dropdown-item" href="/jadwal-kuliah">Jadwal Kuliah</a>
                        </li>
                        <li class="nav-link {{ request()->is('jadwal-ujian') ? 'active' : '' }}">
                            <a class="dropdown-item" href="/jadwal-ujian">Jadwal Ujian</a>
                        </li>
                        <li class="nav-link {{ request()->is('presensi') ? 'active' : '' }}">
                            <a class="dropdown-item" href="/presensi">Presensi</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Biodata</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="/profile">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('message') ? 'active' : '' }}" href="message">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-email-83 text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Message</span>
                </a>
            </li> -->
        </ul>
    </div>
    <div class="sidenav-footer pt-2">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-70 mx-auto" src="../img/illustrations/Dashboard.svg" alt="sidebar_illustration">
            <p class="mt-0 text-center">UNIVERSITAS MUHAMMADIYAH PALANGKARAYA</p>
        </div>
    </div>
</aside>