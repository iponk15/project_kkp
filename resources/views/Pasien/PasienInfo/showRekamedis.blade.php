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
        <div class="card-toolbar"></div>
    </div>
    <div class="card-body">
        <!--begin::Search Form-->
        <div class="mb-7">
            <div class="row align-items-center">
                <div class="col-lg-9 col-xl-8">
                    <form class="formSearch">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control generalSearch" placeholder="Search..." name="generalSearch"/>
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0 text-right">
                    
                </div>
            </div>
        </div>
        <!--end::Search Form-->

        <div class="datatable datatable-bordered datatable-head-custom" id="ktTableRekamedis"></div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // start set ktable datatable
        var id     = '#ktTableRekamedis';
        var urll   = '{{ route($route . ".ktableRekamedis", [ "psntrans_id" => $transid ] ) }}';
        var column = [
            { field : 'RecordID', title : '#', sortable : false, width : 10 },
            { field : 'no', title : 'No. ', textAlign : 'center', sortable : false, width : 30 },
            { field : 'dokter_nama', title : 'Nama Dokter' },
            { field : 'poli_nama', title : 'Poli'},
            { field : 'pastrans_created_date', title : 'Tgl Berobat'},
        ];

        var cari = { generalSearch : '.generalSearch' };
        var chld = {
            title : 'Detail Informasi Reamedis Pasien',
            route : '{{ route( $route . ".showInfoRekamedis" ) }}',
            html  : true
        }

        global.init_ktable(id,urll,column,cari,chld);
        // end set ktable datatable
    });
</script>