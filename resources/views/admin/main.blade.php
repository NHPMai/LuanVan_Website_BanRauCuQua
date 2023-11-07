<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<style>
    .panel-heading {
        position: relative;
        height: 57px;
        line-height: 57px;
        letter-spacing: 0.2px;
        color: #000;
        font-size: 28px;
        font-weight: 530;
        padding: 0 16px;
        background: #ddede0;
        border-top-right-radius: 2px;
        border-top-left-radius: 2px;
        text-transform: uppercase;
        text-align: center;
    }
    .panel-default>.panel-heading {
    color: #000000 ! important;
    background-color: #ddede0 ! important;
    border-color: #ddede0 ! important;
    font-size: 20px;
}
</style>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto nav-pills ">
                <li class="nav-item menu-open">
                    <div class="btn-group">
                        <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                            <i class="fas fa-user"></i>
                        </button>

                        <div class="dropdown-menu" role="menu">
                            @if (Auth::check())

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.logout') }}" class="dropdown-item">
                                Log Out
                            </a>

                            @else

                            <a href="{{asset('danh-muc/register')}}" class="dropdown-item">Đăng ký</a>
                            <a href="{{asset('admin/users/login')}}" class="dropdown-item">Đăng nhập</a>

                            @endif

                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        @include('admin.sidebar')


        <div class="content-wrapper">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ url('admin/search')}}" method="GET" class="form-inline pl-3 pt-3">
                                <div class="form-group">
                                    <input class="form-control form-control-sidebar" name="query" type="search" placeholder="Search" aria-label="Search">
                                </div>

                                <button type="submit" class="btn btn-light">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </form>
                        </div>

                        <div class="col-6 pt-3">
                            <form id="search-form" action="{{ url('admin/searchProductMicrophone')}}" class="d-flex" method="get">
                                <div class="btn btn-white input-group-text border-0" type="submit" id="">
                                    <div style="display:none">
                                        <input id="search-input" name="keywork" type="text">

                                    </div>
                                    <span class="microphone">
                                        <i class="fas fa-microphone"></i>
                                        <span class="recording-icon"></span>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- <div class="col">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ url('admin/searchdonhang')}}" method="GET" class="form-inline pl-3 pt-3"  >
                            <div class="form-group" >
                                <input class="form-control form-control-sidebar" name="query" type="search" placeholder="Search Đơn Hàng" aria-label="Search">
                            </div>

                            <button type="submit" class="btn btn-light" >
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </form>
                    </div>

                    <div class="col-6 pt-3">
                        <form id="search-form" action="{{ url('admin/searchProductMicrophonedonhang')}}" class="d-flex" method="get">
                            <div class="btn btn-white input-group-text border-0" type="submit" id="">
                                <div style="display:none">
                                    <input id="search-input" name="keywork"  type="text">

                                </div>
                                <span class="microphone">
                                    <i class="fas fa-microphone"></i>
                                    <span class="recording-icon"></span>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            </div>








            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">


                    @include('admin.alert')

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card  mt-3">
                                <div class="panel-heading">
                                    <h3 class="panel-heading">{{ $title }}</h3>
                                </div>

                                @yield('content')

                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>


        <!-- /.content-wrapper -->
        <!-- <footer class="main-footer">
        
    </footer> -->
    </div>
    <!-- ./wrapper -->
    @include('admin.footer')
</body>

<style>
    a {
        text-decoration: none;
    }

    .microphone {
        cursor: pointer;
    }

    .microphone .recording-icon {
        display: none;
        width: 10px;
        height: 10px;
        background-color: brown;
        border-radius: 50%;
        animation: pulse 50s infinite linear;
    }

    .microphone.recording.recording-icon {
        display: none;
    }

    .microphone.recording.fa-microphone {
        display: none;
    }
</style>

</html>