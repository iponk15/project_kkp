<!--begin::Brand-->
<div class="brand flex-column-auto " id="kt_brand">
    <!--begin::Logo-->
    <a href="index.html" class="brand-logo">
        <img alt="Logo" class="w-65px" src="{{ asset('assets/media/logos/logo-letter-13.png') }}"/>
    </a>
    <!--end::Logo-->
</div>
<!--end::Brand-->

<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div
        id="kt_aside_menu"
        class="aside-menu my-4  aside-menu-dropdown "
        data-menu-vertical="1"
        data-menu-dropdown="1" data-menu-scroll="0" data-menu-dropdown-timeout="500">
        
        <!--begin::Menu Nav-->
        <ul class="menu-nav ">
            <li class="menu-item  menu-item-active" aria-haspopup="true" >
                <a  href="{{ route('home') }}" class="menu-link ajaxify"><i class="menu-icon flaticon2-architecture-and-city"></i><span class="menu-text">Home</span></a>
            </li>
            @if( Auth::user()->role_kode == 'KKPADM' || Auth::user()->role_kode == 'KKPAPT' )
                <li class="menu-item  menu-item-submenu" aria-haspopup="true"  data-menu-toggle="hover">
                    <a  href="javascript:;" class="menu-link menu-toggle"><i class="menu-icon flaticon2-telegram-logo"></i><span class="menu-text">Master</span></a>
                    <div class="menu-submenu "><i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            @if(Auth::user()->role_kode == 'KKPADM')
                                <!-- <li class="menu-item " aria-haspopup="true" >
                                    <span class="menu-link">
                                        <span class="menu-text"><h5>Management User</h5></span>
                                    </span>
                                </li> -->
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('user.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-users icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data User</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="#" class="menu-link ajaxify">
                                        <i class="flaticon-user icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Pasien</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('role.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-suitcase icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Role</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('uker.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-suitcase icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Unit Kerja</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('poli.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-suitcase icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Poli</span>
                                    </a>
                                </li>
                            @endif

                            @if(Auth::user()->role_kode == 'KKPAPT')                        
                                <!-- <li class="menu-item " aria-haspopup="true" >
                                    <span class="menu-link">
                                        <span class="menu-text"><h5>Management Obat</h5></span>
                                    </span>
                                </li> -->
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('katobat.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon2-copy icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Kategori Obat</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('jenobat.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon2-document icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Jenis Obat</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('obat.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon2-rocket-1 icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Obat</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if( Auth::user()->role_kode == 'KKPPTG' || Auth::user()->role_kode == 'KKPSTR' || Auth::user()->role_kode == 'KKPDKT' )
                <li class="menu-item  menu-item-submenu" aria-haspopup="true"  data-menu-toggle="hover">
                    <a  href="javascript:;" class="menu-link menu-toggle"><i class="menu-icon flaticon2-group"></i><span class="menu-text">Pasien</span></a>
                    <div class="menu-submenu "><i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            @if( Auth::user()->role_kode == 'KKPPTG' )
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('inputpasien.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-edit-1 icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Input Pasien</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('pasienin.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-calendar-with-a-clock-time-tools icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Pasien Sedang Berobat</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('inputpasien.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-logout icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Pasien Selesai Berobat</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('pasien.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon2-group icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Data Pasien</span>
                                    </a>
                                </li>
                            @endif

                            @if( Auth::user()->role_kode == 'KKPSTR' || Auth::user()->role_kode == 'KKPDKT' )
                                <li class="menu-item " aria-haspopup="true" >
                                    <a  href="{{ route('pasienin.index') }}" class="menu-link ajaxify">
                                        <i class="flaticon-calendar-with-a-clock-time-tools icon-xl text-dark"><span></span></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="menu-text">Pasien Sedang Berobat</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>
<!--end::Aside Menu-->