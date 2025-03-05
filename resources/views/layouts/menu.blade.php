<!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li>
            <a href="{{ url('admin/beranda') }}"><i class="si si-home"></i><span class="sidebar-mini-hide">Beranda</span></a>
        </li>
        <li>
            <a href="{{ url('admin/peta_preview') }}"><i class="si si-pointer"></i><span class="sidebar-mini-hide">Peta</span></a>
        </li>

        <!-- <li>
            <a href="{{ url('admin/peta') }}"><i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span></a>
        </li> -->
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-map"></i><span class="sidebar-mini-hide">Manajemen Peta</span></a>
            <ul>
                <li>
                    <a href="{{ url('admin/peta') }}">Manajemen Peta</a>
                </li>
                <!-- <li>
                    <a href="{{ url('admin/layer_rtrw') }}">Manajemen Layer RTRW</a>
                </li> -->
            </ul>
        </li>
        <!-- <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Rekomendasi</span></a>
            <ul>
                <li>
                    <a href="{{ url('admin/perijinan') }}">Rekomendasi RTR</a>
                </li>
                <li>
                    <a href="{{ url('admin/perijinan_kkr') }}">Rekomendasi KKR</a>
                </li>
            </ul>
        </li> -->
        <!-- <li>
            <a href="{{ url('admin/rekap') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Rekap</span></a>
        </li> -->
        <li>
            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Referensi</span></a>
            <ul>
                <li>
                    <a href="{{ url('admin/referensi/opd') }}">Bidang</a>
                </li>
                <li>
                    <a href="{{ url('admin/referensi/icon') }}">Ikon Peta</a>
                </li>
                <li>
                    <a href="{{ url('admin/referensi/koordinat') }}">Koordinat Peta</a>
                </li>
                <!-- <li>
                    <a href="{{ url('admin/referensi/rpr') }}">Rencana Penggunaan Ruang</a>
                </li>
                <li>
                    <a href="{{ url('admin/referensi/st') }}">Status Tanah</a>
                </li> -->
                <!-- <li>
                    <a href="be_forms_premade.html">Peta Rencana Struktur Ruang</a>
                <li>
                    <a href="{{ url('admin/referensi/rencana_struktur_ruang') }}">Peta Rencana Struktur Ruang</a>
                </li>
                <li>
                    <a href="{{ url('admin/referensi/rencana_pola_ruang') }}">Peta Rencana Pola Ruang</a>
                </li>
                <li>
                    <a href="be_forms_premade.html">Peta Penetapan Kawasan Strategis</a>
                </li> -->
            </ul>
        </li>
        <li>
            <a href="{{ url('admin/user') }}"><i class="si si-users"></i><span class="sidebar-mini-hide">Manajemen User</span></a>
        </li>

        <li>
            <a href="{{ url('admin/api') }}"><i class="si si-link"></i><span class="sidebar-mini-hide">Manajemen API</span></a>
        </li>

        <!-- <li>
            <a href="{{ url('admin/widget') }}"><i class="fa fa-cubes"></i><span class="sidebar-mini-hide">Manajemen Widget</span></a>
        </li> -->

        <!-- <li>
            <a href="{{ url('admin/panduan') }}"><i class="si si-notebook"></i><span class="sidebar-mini-hide">Panduan</span></a>
        </li> -->

        <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Website</span></li>
        <!-- <li>
            <a href="{{ url('admin/website/profil') }}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Profil</span></a>
        </li> -->
        <!-- <li>
            <a href="{{ url('admin/website/berita') }}"><i class="si si-feed"></i><span class="sidebar-mini-hide">Berita</span></a>
        </li> -->
        <!-- <li>
            <a href="{{ url('admin/website/layanan') }}"><i class="si si-paper-plane"></i><span class="sidebar-mini-hide">Layanan</span></a>
        </li> -->
        <li>
            <a href="{{ url('admin/website/regulasi') }}"><i class="si si-grid"></i><span class="sidebar-mini-hide">Regulasi</span></a>
        </li>
        <!-- <li>
            <a href="{{ url('admin/website/album') }}"><i class="si si-picture"></i><span class="sidebar-mini-hide">Album Peta</span></a>
        </li> -->
        <!-- <li>
            <a href="{{ url('admin/website/prioritas_pembangunan') }}"><i class="si si-list"></i><span class="sidebar-mini-hide">Prioritas Pembangunan</span></a>
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