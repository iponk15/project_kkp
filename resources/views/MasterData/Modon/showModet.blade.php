@extends('layouts.content')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
                <h3 class="card-label text-info">
                    {!! (!empty($cardTitle) ? $cardTitle : 'Card Title' ) !!}
                    <small>{!! (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) !!}</small>
                    <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-icon btn-light-warning ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Kembali">
                    <i class="flaticon2-left-arrow-1"></i>
                </a>
                <a href="{{ route($route . '.showModet', ['id' => $id, 'modetid' => $modetid]) }}" class="btn btn-sm btn-icon btn-light-info ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Reload">
                    <i class="flaticon2-reload"></i>
                </a>
            </div>
        </div>
        <form class="form" id="modetFormTambah" method="POST">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>Kode</label>
                        <input type="text" class="form-control" placeholder="Input kode" name="modet_kode" value="{{ @$records->modet_kode }}">
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-3">
                        <label>Points</label>
                        <input type="text" class="form-control" placeholder="Input Points" name="modet_points" value="{{ @$records->modet_points }}">
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-3">
                        <label>Order</label>
                        <input type="number" class="form-control" placeholder="Input Order" name="modet_order" value="{{ @$records->modet_order }}">
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-1">
                        <label>&nbsp;</label>
                        <button type="submit" id="btnSubmitModon" class="form-control btn btn-success mr-2">{{ !empty($modetid) ? 'Update' : 'Simpan' }}</button>
                        <span class="form-text text-muted"></span>
                    </div>
                    <div class="col-lg-2">
                        <label>&nbsp;</label>
                        <a href="{{ route( $route . '.show' ) }}" class="form-control btn btn-light-success btn-sm mr-2 ajaxify">
                            <i class="flaticon-file-1"></i>Tambah Data
                        </a>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="separator separator-solid separator-border-2 separator-warning"></div>  
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">No. </th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Point</th>
                                <th class="text-center">Order</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($modet->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="7"><i class="font-size-sm">Data kosong</i></td>
                                </tr>
                            @else
                                @foreach($modet as $key => $rows)
                                    <tr {!! ( $rows->modet_id == @$records->modet_id ? 'style="background-color: aquamarine;"' : '' ) !!}>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $rows->modet_kode }}</td>
                                        <td>{{ $rows->modet_points }}</td>
                                        <td class="text-center">{{ $rows->modet_order }}</td>
                                        <td class="text-center">{{ $rows->modet_status == '1' ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ date('d F Y - H:i', strtotime($rows->modet_createddate)) }}</td>
                                        <td class="text-center">
                                            @if($rows->modet_id != @$records->modet_id)
                                                <div class="dropdown dropdown-inline">
                                                    <a href="{{ route($route . '.showModet', ['id' => $id, 'modetid' => Hashids::encode($rows->modet_id)]) }}" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit">
                                                        <i class="flaticon-edit text-warning icon-md"></i>
                                                    </a>
                                                    <a href="{{ route($route . '.deleteModet', ['id' => Hashids::encode($rows->modet_id)]) }}" onClick="return f_action(this, event)" type="button" class="btn btn-clean btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-theme="dark" title="Delete">
                                                        <i class="flaticon-delete text-danger icon-md"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <a href="<?php echo route($route . '.showModet', ['id' => $id, 'modetid' => $modetid]); ?>" class="ajaxify reload"></a>

    <script>
        $(document).ready(function(){
            // start form validation submit
            var form   = document.getElementById('modetFormTambah');
            var urll   = "{{ route($route . '.storeModet', ['id' => $id, 'modetid' => $modetid]) }}";
            var fields = {
                modet_kode   : { validators : { notEmpty : { message : 'Kode tidak boleh kosong' } } },
                modet_points : { validators : { notEmpty : { message : 'Points tidak boleh kosong' } } },
                modet_order  : { validators : { notEmpty : { message : 'Order tidak boleh kosong' } } },
            };
            
            global.init_formVldtn(form,urll,fields,'#btnSubmitModon');
            // end form validation submit
        });

        function f_action(ele,eve,flag){
            eve.preventDefault();
            
            var option = {
                route : $(ele).attr('href'),
                blkUi : '#body-content',
                type  : 'swal',
                attr  : {
                    title: 'Anda yakin ?',
                    text: 'akan menghapus data ini',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Iya',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }
            };
            
            ajaxProses('post', option);
        }
    </script>
@endsection