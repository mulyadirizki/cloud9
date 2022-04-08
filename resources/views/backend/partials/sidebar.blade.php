<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>CloudNine</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="{{ url('assets/images/logo.png') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2>{{ Auth::user()->name }}</h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
            <li><a><i class="fa fa-users"></i> Pelanggan <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('data-pelanggan.index') }}">Pelanggan Baru</a></li>
                <li><a href="{{ route('data-pelanggan.verifikasi-ditolak') }}">Pelanggan Verifikasi Ditolak</a></li>
                <li><a href="{{ route('data-pelanggan.verify') }}">Pelanggan Terverifikasi</a></li>
                <li><a href="{{ route('data-pelanggan.terputus') }}">Pelanggan Terputus</a></li>
                {{--  <li><a href="{{ route('data-pelanggan.putus-permanen') }}">Pelanggan Putus Permanen</a></li>  --}}
              </ul>
            </li>
            {{--  <li><a><i class="fa fa-map-marker"></i>Data Area<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('data-area.index') }}">Data Area</a></li>
              </ul>
            </li>  --}}
            <li><a><i class="fa fa-money"></i>Pembayaran<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('konfirmasi-pembayaran.index') }}">Konfirmasi Pembayaran</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
          <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>