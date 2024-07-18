<div class="fixed-top">
    @if (session('status'))
        <div class="alert alert-{{ session('clr') }} text-white alert-dismissible fade show d-flex align-items-center justify-content-center col-12 col-md-6 border-0"
            style="margin: 10px auto;">
            <b>{{ session('status') }}</b>
            <button type="button" class="btn-close d-flex align-items-center" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-4">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('title')</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">@yield('title')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-item">
            <form action="logout" method="POST">
                @csrf
                <button class="nav-link bg-primary border-0" type="submit">
                    <div class="d-flex align-items-center">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-1 mb-1 d-flex align-items-center justify-content-center">
                            <i class="ni ni-button-power text-white text-lg opacity-10"></i>
                        </div>
                        <span class="nav-link-text text-white font-weight-bold d-none d-md-inline">Log Out</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</nav>
<!-- End Navbar -->
