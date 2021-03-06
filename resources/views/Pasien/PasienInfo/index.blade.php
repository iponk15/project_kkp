@extends('layouts.content')
@section('content')
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
            <!--begin::Profile Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-10">
                    <!--begin::User-->
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            <div class="symbol-label" style="background-image:url({{ asset('assets/media/users/300_21.jpg') }})"></div>
                            <i class="symbol-badge bg-success"></i>
                        </div>
                        <div>
                            <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                {{ $records->pasien_nama }}
                            </a>
                            <div class="text-muted">
                                {{ $records->pasien_norekdis }}
                            </div>
                            <div class="mt-2">
                                {{ $records->poli_nama }}
                            </div>
                            <div class="mt-2">
                                {{ $records->nama_dokter }}
                            </div>
                        </div>
                    </div>
                    <!--end::User-->

                    <!--begin::Contact-->
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Jenis Kelamin</span>
                            <a href="#" class="text-muted text-hover-primary">{{ ( $records->pasien_jk == 'L' ? 'Laki-laki' : 'Perempuan' ) }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Tanggal Lahir</span>
                            <a href="#" class="text-muted text-hover-primary">{{ date('d F Y', strtotime($records->pasien_tgllahir)) }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Umur</span>
                            <a href="#" class="text-muted text-hover-primary">{{ $records->pasien_umur }} Thn</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Email</span>
                            <a href="#" class="text-muted text-hover-primary">{{ $records->pasien_email }}</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Telp</span>
                            <span class="text-muted">{{ $records->pasien_telp }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="font-weight-bold mr-2">Alamat</span>
                            <span class="text-muted">{{ $records->pasien_alamat }}</span>
                        </div>
                    </div>
                    <!--end::Contact-->

                    <!--begin::Nav-->
                    <div class="navi navi-bold navi-hover navi-link-rounded">
                        <div class="navi-item mb-2">
                            <a href="{{ route( $route . '.infoPeriksaSuster' ) }}" class="navi-link py-4 asideInfoPasien" data-transid="{{ $psntrans_id }}">
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>                    
                                </span>
                                <span class="navi-text font-size-lg"> Hasil Pemeriksaan </span>
                            </a>
                        </div>

                        <div class="navi-item mb-2">
                            <a href="{{ route( $route . '.infoResepObat' ) }}" class="navi-link py-4 asideInfoPasien" data-toggle="tooltip" title="" data-placement="right" data-original-title="Resep Obat" data-transid="{{ $psntrans_id }}">
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect>
                                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text"> Resep Obat </span>
                            </a>
                        </div>
                        
                        <div class="navi-item mb-2">
                            <a href="{{ route( $route . '.infoRekamedis' ) }}" class="navi-link py-4 asideInfoPasien" data-toggle="tooltip" title="" data-placement="right" data-original-title="Riwayat Rekamedis" data-transid="{{ Hashids::encode($records->pasien_id) }}">
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect>
                                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text"> Riwayat Rekamedis </span>
                            </a>
                        </div>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
        <!--end::Aside-->

        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8 eleBlockUi" id="bodyCtnInfoPasien">
            <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>    
                </div>
                <div class="alert-text">
                    Silahkan klik aside menu untuk menampilkan informasi.
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.asideInfoPasien').on('click', function(e){
                e.preventDefault();

                $('.asideInfoPasien').removeClass('active');
                $(this).addClass('active');

                var option = {
                    route : $(this).attr('href'),
                    blkUi : '.eleBlockUi',
                    type  : 'ajax',
                    html  : true,
                    rnder : '#bodyCtnInfoPasien',
                    data  : { transid : $(this).data('transid') }
                }

                ajaxProses('post', option);
            });
        });
    </script>
@endsection