<!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a href="{{ url('opd/beranda') }}"><i class="si si-home"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span></a>
            <ul>
                <li>
                    <a href="{{ url('opd/peta') }}">Manajemen Peta</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Referensi</span></a>
            <ul>
                <li>
                    <a href="{{ url('opd/referensi/icon') }}">Ikon Peta</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ url('opd/api') }}"><i class="si si-link"></i><span class="sidebar-mini-hide">Manajemen API</span></a>
        </li>
        <!-- <li>
            <a href="{{ url('opd/panduan') }}"><i class="si si-notebook"></i><span class="sidebar-mini-hide">Panduan</span></a>
        </li> -->
    </ul>

    <div style="background-color: rgba(0, 0, 0, 0.03); display: flex; justify-content: center; padding: 16px 0; border-radius: 8px; margin-top: 16px; backdrop-filter: blur(1px);">
        <img src="{{ asset('assets_front/images/Kabupaten_Sukoharjo.png') }}" alt="" style="width: 100px; height: auto;">
    </div>
</div>
<!-- END Side Navigation -->
</div>
<!-- Sidebar Content -->
</div>
<!-- END Sidebar Scroll Container -->
</nav>