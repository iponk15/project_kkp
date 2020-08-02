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
                                {{ $dataTrans->pasien_nama }}
                            </a>
                            <div class="text-muted">
                                {{ $dataTrans->pasien_norekdis }}
                            </div>
                            <div class="mt-2">
                                {{ $dataTrans->poli_nama }}
                            </div>
                            <div class="mt-2">
                                {{ $dataTrans->dokter_nama }}
                            </div>
                        </div>
                    </div>
                    <!--end::User-->

                    <!--begin::Contact-->
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Jenis Kelamin</span>
                            <span class="text-muted">{{ ($dataTrans->pasien_jk == 'L' ? 'Laki-laki' : 'Perempuan') }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Tanggal Lahir</span>
                            <span class="text-muted">{{ date('d F Y', strtotime($dataTrans->pasien_tgllahir)) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Umur</span>
                            <span class="text-muted">{{ $dataTrans->pasien_umur }} Tahun</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Email</span>
                            <span class="text-muted">{{ $dataTrans->pasien_email }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Telp</span>
                            <span class="text-muted">{{ $dataTrans->pasien_telp }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="font-weight-bold mr-2">Alamat</span>
                            <span class="text-muted">{{ $dataTrans->pasien_alamat }}</span>
                        </div>
                    </div>
                    <!--end::Contact-->

                    <!--begin::Nav-->
                    @if($dataTrans->pastrans_status == '3')
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="btn btn-success btnApproveResep" style="width: 100%;" data-psntransid="{{ $psntrans_id }}">
                                    <i class="flaticon2-circle-vol-2"></i> Approve
                                </button>
                            </div>
                        </div>
                    @endif
                    <!--end::Nav-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
        <!--end::Aside-->

        <div class="flex-row-fluid ml-lg-8" id="bodyCtn">
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">{{ $pagetitle }}</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">{{ $cardTitle }}</span>
                    </h3>
                    <div class="card-toolbar"></div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body py-2">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1%">No. </th>
                                    <th class="text-center">Obat</th>
                                    <th class="text-center">Kategori Obat</th>
                                    <th class="text-center">Jenis Obat</th>
                                    <th class="text-center">Jumlah Obat</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataResep as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->obat_nama }}</td>
                                        <td>{{ $value->katobat_nama }}</td>
                                        <td class="text-center">{{ $value->jenobat_nama }}</td>
                                        <td class="text-center">{{ $value->resep_jumlah }}</td>
                                        <td>{{ $value->resep_keterangan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end::Table-->

                    @if($dataTrans->resnote_keterangan != '')
                        <div class="example">
                            <div class="example-preview">
                                <h6> Catatan Resep <span class="text-danger"> * </span> </h6> 
                                <p>{{ $dataTrans->resnote_keterangan }}</p>
                            </div>
                        </div>
                        <br>
                    @endif
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>

    <a href="<?php echo route($route . '.index'); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            $('.btnApproveResep').on('click', function(){
                var option = {
                    route : '{{ route( $route . ".approveResep" ) }}',
                    data  : { psntrans_id : $(this).data('psntransid') },
                    blkUi : '#body-content',
                    type  : 'swal',
                    attr  : {
                        title : 'Anda yakin ?',
                        text  : 'Akan menyetujui obat ini.',
                        icon  : 'warning',
                        showCancelButton  : true,
                        confirmButtonText : 'Iya',
                        cancelButtonText  : 'Tidak',
                        reverseButtons    : true
                    }
                };
                
                ajaxProses('post', option);
            });
        });
    </script>
@endsection