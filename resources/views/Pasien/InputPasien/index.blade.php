@extends('layouts.content')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="{{ (!empty($cardIcon) ? $cardIcon : 'flaticon2-chat-1') }} text-info icon-xl"></i></span>
                <h3 class="card-label text-info">
                    {{ (!empty($cardTitle) ? $cardTitle : 'Card Title' ) }}
                    <small>{{ (!empty($cardSubTitle) ? $cardSubTitle : 'Card Sub Title' ) }}</small>
                    <!-- <span class="d-block text-muted pt-2 font-size-sm">row selection and group actions</span> -->
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-icon btn-light-info ajaxify mr-2" data-toggle="tooltip" data-theme="dark" title="Reload">
                    <i class="flaticon2-reload"></i>
                </a>
            </div>
        </div>
        <div class="card-body" id="bodyFormPasien">
            <div class="form-group">
                <label><b>Pilih Opsi</b></label>
                <div class="radio-inline">
                    <label class="radio radio-success">
                        <input type="radio" name="opsi_pasien" value="0" class="opsiPasien">
                        <span></span>
                        Pasien Baru
                    </label>
                    <label class="radio radio-danger">
                        <input type="radio" name="opsi_pasien" value="1" class="opsiPasien">
                        <span></span>
                        Pasien Terdaftar
                    </label>
                </div>
                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
            </div>

            <div class="separator separator-solid separator-border-2 separator-dark"></div>
            <br>
            <div id="ctnFrmPasien"></div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.opsiPasien').on('change', function(){
                var val    = $(this).val();
                var option = {
                    route : (val == 0) ? '{{ route( $route . ".pasienbaru" ) }}' : '{{ route( $route . ".pasienterdaftar" ) }}',
                    blkUi : '#bodyFormPasien',
                    type  : 'ajax',
                    html  : true,
                    rnder : '#ctnFrmPasien'
                };

                ajaxProses('post', option);
            });
        });
    </script>
@endsection