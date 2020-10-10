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
                    <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                        <div class="navi-item mb-2">
                            <a href="{{ route( $route . '.formPeriksaDokter', ['psntrans_id' => $psntrans_id] ) }}" class="navi-link py-4 active asideInfoPasien ajaxify">
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
                                <span class="navi-text font-size-lg"> Form Pemeriksaan </span>
                            </a>
                        </div>
                        @if($records->poli_kode == 'KKPPOLGG')
                            <div class="navi-item mb-2">
                                <a href="{{ route( $route . '.odontogram' ) }}" class="navi-link py-4 asideInfoPasien" data-toggle="tooltip" title="" data-original-title="Odontogram" data-transid="{{ Hashids::encode($records->psnrekdis_id) }}">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <circle fill="#000000" opacity="0.3" cx="15" cy="17" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="9" cy="17" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="7" cy="11" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="17" cy="11" r="5"/>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="7" r="5"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text"> Odontogram </span>
                                </a>
                            </div>
                        @endif
                        <div class="navi-item mb-2">
                            <a href="{{ route( 'pasieninfo.infoRekamedis' ) }}" class="navi-link py-4 asideInfoPasien" data-toggle="tooltip" title="" data-original-title="Riwayat Rekamedis" data-transid="{{ Hashids::encode($records->pasien_id) }}">
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
                        <div class="navi-item mb-2">
                            <a href="{{ route( $route . '.debugOdontogram' ) }}" class="navi-link py-4 asideInfoPasien" data-toggle="tooltip" title="" data-original-title="Riwayat Rekamedis" data-transid="{{ Hashids::encode($records->psnrekdis_id) }}">
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
                                <span class="navi-text"> Debug odontogram </span>
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
            <!--begin::Advance Table: Widget 7-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
                        <h3 class="card-label text-info">
                            {{ (!empty($cardTitle) ? $cardTitle : 'Card Title' ) }}
                            <small>{!! (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) !!}</small>
                            <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <form class="form" id="formPeriksaDokter" method="POST" form-confirm="1">
                    <input type="hidden" value="{{ $records->poli_kode }}" name="poli_kode">
                    {{ csrf_field() }}
                    <div class="card-body py-5">
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Subjective</h3>
                        <!-- <div class="form-group">
                            <div class="alert alert-custom alert-light-warning fade mb-5 d-none formAlert" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                <div class="alert-text">A simple primary alert—check it out!</div>
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Keluhan Utama <span class="text-danger"> * </span></label>
                                <textarea placeholder="Keluhan Utama" name="psnrekdis_sbj_kelutm" class="form-control" rows="2">{{ $records->psnrekdis_sbj_kelutm }}</textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="col-lg-4">
                                <label>Keluhan Tambahan <span class="text-danger"> * </span></label>
                                <textarea placeholder="Keluhan tambahan" name="psnrekdis_sbj_keltam" class="form-control" rows="2">{{ $records->psnrekdis_sbj_keltam }}</textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="col-lg-4">
                                <label>Riwayat Penyakit Sekarang</label>
                                <textarea placeholder="Riwayat Penyakit Sekarang" name="psnrekdis_sbj_riwpktskr" class="form-control" rows="2">{{ $records->psnrekdis_sbj_riwpktskr }}</textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Riwayat Penyakit Dahulu</label>
                                <textarea placeholder="Riwayat Penyakit Dahulu" name="psnrekdis_sbj_riwpktdhl" class="form-control" rows="2">{{ $records->psnrekdis_sbj_riwpktdhl }}</textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="col-lg-4">
                                <label>Riwayat Penyakit Keluarga</label>
                                <textarea placeholder="Riwayat Penyakit Keluarga" name="psnrekdis_sbj_riwpktklg" class="form-control" rows="2"> {{ $records->psnrekdis_sbj_riwpktklg }} </textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="col-lg-4">
                                <label>Riwayat Penyakit Alergi</label>
                                <textarea placeholder="Riwayat Penyakit Alergi" name="psnrekdis_sbj_riwpktkalg" class="form-control" rows="2"> {{ $records->psnrekdis_sbj_riwpktkalg }} </textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Objective</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="example">
                                    <div class="example-preview">
                                        <h3 class="font-size-lg text-dark font-weight-bold mb-6">2A. VITAL SIGN</h3>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Tekanan Darah</label>
                                                <input type="text" class="form-control" name="psnrekdis_obj_vstd" placeholder="Tekanan Darah" value="{{ $records->psnrekdis_obj_vstd }}">
                                                <span class="form-text text-muted">Dalam satuan mmHG</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>HR</label>
                                                <input type="text" class="form-control" name="psnrekdis_obj_vshr" placeholder="HR" value="{{ $records->psnrekdis_obj_vshr }}">
                                                <span class="form-text text-muted">Dalam satuan x/menit</span>
                                            </div>
                                        </div>  
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>RR</label>
                                                <input type="text" class="form-control" name="psnrekdis_obj_vsrr" placeholder="RR" value="{{ $records->psnrekdis_obj_vsrr }}">
                                                <span class="form-text text-muted">Dalam satuan x/menit</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Suhu Badan</label>
                                                <input type="text" class="form-control" name="psnrekdis_obj_vst" placeholder="Suhu Badan" value="{{ $records->psnrekdis_obj_vst }}">
                                                <span class="form-text text-muted">Dalam satuan °C</span>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            @if($records->poli_kode != 'KKPPOLGG')
                                <div class="col-lg-6">
                                    <div class="example">
                                        <div class="example-preview">
                                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2B. STATUS GIZI</h3>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label>Berat Badan</label>
                                                    <input type="text" class="form-control psnrekdis_obj_sgbb" name="psnrekdis_obj_sgbb" placeholder="Berat Badan" value="{{ $records->psnrekdis_obj_sgbb }}">
                                                    <span class="form-text text-muted">Dalam satuan kg</span>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Tinggi Badan</label>
                                                    <input type="text" class="form-control psnrekdis_obj_sgtb" name="psnrekdis_obj_sgtb" placeholder="Tinggi Badan" value="{{ $records->psnrekdis_obj_sgtb }}">
                                                    <span class="form-text text-muted">Dalam satuan cm</span>
                                                </div>
                                            </div>      
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label>IMT</label>
                                                    <input type="text" class="form-control psnrekdis_obj_sgimt" name="psnrekdis_obj_sgimt" placeholder="IMT" value="{{ $records->psnrekdis_obj_sgimt }}" readonly>
                                                    <span class="form-text text-muted">Dalam satuan kg/m2</span>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <br>
                        @if($records->poli_kode != 'KKPPOLGG')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="example">
                                        <div class="example-preview">
                                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2C. PEMERIKSAAN FISIK</h3>
                                            <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label>Kepala</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pfkpl" placeholder="Kepala" value="{{ $records->psnrekdis_obj_pfkpl }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Leher</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pflhr" placeholder="Leher" value="{{ $records->psnrekdis_obj_pflhr }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Thorax, Cor</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pftcor" placeholder="Thorax, cor" value="{{ $records->psnrekdis_obj_pftcor }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Thorax Pulmo</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pftpul" placeholder="Thorax Pulmo" value="{{ $records->psnrekdis_obj_pftpul }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>  
                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label>Abdomen</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pfabd" placeholder="Abdomen" value="{{ $records->psnrekdis_obj_pfabd }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Ekstremitas, Atas</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pfeksats" placeholder="Ekstremitas, Atas" value="{{ $records->psnrekdis_obj_pfeksats }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Ekstremitas, Bawah</label>
                                                    <input type="text" class="form-control" name="psnrekdis_obj_pfeksbwh" placeholder="Ekstremitas, Bawah" value="{{ $records->psnrekdis_obj_pfeksbwh }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Assessment</h3>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Diagnosa Keperawatan" name="psnrekdis_asm_digkrt" class="form-control" rows="3"> {{ $records->psnrekdis_asm_digkrt }} </textarea>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">4. Planning</h3>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Rencana Asuhan Keperawatan" name="psnrekdis_pln_rak" class="form-control" rows="3"> {{ $records->psnrekdis_pln_rak }} </textarea>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-2 ml-lg-auto">
                                <button type="submit" class="btn btn-success mr-2">Update Pemeriksaan</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 7-->
        </div>
        <!--end::Content-->
    </div>
    
    {{-- start form input stok --}}
    <div class="modal fade" id="formResepDoketer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="ctnFormResep">
                
            </div>
        </div>
    </div>
    {{-- start form input stok --}}
    
    <a href="<?php echo route($route . '.formPeriksaDokter', ['psntrans_id' => $psntrans_id]); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            // start hitung IMT
            $('.psnrekdis_obj_sgbb, .psnrekdis_obj_sgtb').on('keyup', function(){
                var bb   = $('.psnrekdis_obj_sgbb').val();
                var tb   = $('.psnrekdis_obj_sgtb').val();
                var htb  = tb / 100;
                var htb2 = (htb * htb);
                var imt  = bb / htb2;
                var res  = Number(imt.toFixed(2));

                $('.psnrekdis_obj_sgimt').val(res);
            });
            // end hitung IMT

            // start form validation submit
            var form   = document.getElementById('formPeriksaDokter');
            var urll   = "{{ route( $route . '.updateFormDokter', ['psntrans_id' => $psntrans_id] ) }}";
            var fields = {
                psnrekdis_sbj_kelutm : { validators : { notEmpty : { message : 'Keluhan utama tidak boleh kosong' } } },
                psnrekdis_sbj_keltam : { validators : { notEmpty : { message : 'Keluhan tambahan tidak boleh kosong' } } },
            };
            
            global.init_formVld(form, urll, fields);
            // end form validation submit

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

        function f_resepObat(ele,eve){
            var option = {
                route : $(ele).data('route'),
                blkUi : '#body-content',
                type  : 'ajax',
                html  : true,
                rnder : '#ctnFormResep',
                data  : { psnrekdisid : $(ele).data('psnrekdisid') }
            }

            ajaxProses('post', option);
        }

        function f_rujukLab(ele,eve){
            eve.preventDefault();

            var option = {
                route : $(ele).data('route'),
                data  : { psnrekdis_id : $(ele).data('psnrekdisid')},
                blkUi : '#body-content',
                type  : 'swal',
                attr  : {
                    title : 'Anda yakin ?',
                    text  : 'Merujuk pasien ini kebagian Laboratorium',
                    icon  : 'warning',
                    showCancelButton  : true,
                    confirmButtonText : 'Iya',
                    cancelButtonText  : 'Tidak',
                    reverseButtons    : true
                }
            };
            
            ajaxProses('post', option);
        }

        function f_selesai(ele, eve){
            eve.preventDefault();

            var option = {
                route : $(ele).data('route'),
                data  : { psntrans_id : $(ele).data('psntransid') },
                blkUi : '#body-content',
                type  : 'swal',
                attr  : {
                    title : 'Anda yakin ?',
                    text  : 'Untuk menyelesaikan pemeriksaan terhadap pasien ini',
                    icon  : 'warning',
                    showCancelButton  : true,
                    confirmButtonText : 'Iya',
                    cancelButtonText  : 'Tidak',
                    reverseButtons    : true
                }
            };
            
            ajaxProses('post', option);
        }
    </script>
@endsection