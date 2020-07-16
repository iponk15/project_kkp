<form action="{{ route( $route . '.storeStokObat' ) }}" method="POST" class="form" id="stkbatFormTambah">
    {{ csrf_field() }}
    <input type="hidden" name="stkbat_obat_id" value="{{ $obat_id }}">
    <div class="modal-header" style="background-color: #173f5f;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">Input Stok Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Nama Obat </label>
                <input type="email" class="form-control" value="{{ $records->obat_nama }}" disabled />
                <span class="form-text text-muted"></span>
            </div>
            <div class="col-lg-6">
                <label>Stok <span class="text-danger"> * </span></label>
                <input type="number" class="form-control" placeholder="Stok Obat" name="stkbat_stok"/>
                <span class="form-text text-muted"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label>Keterangan </label>
                <textarea name="stkbat_keterangan" class="form-control" rows="3" placeholder="Keterangan ..."></textarea>
                <span class="form-text text-muted"></span>
            </div>
            <div class="col-lg-6">
                <label>&nbsp; </label>
                <button type="submit" class="btn btn-success mr-2 form-control">Submit</button>
            </div>
        </div>

        <div class="separator separator-solid separator-border-2"></div>

        <div class="example">
            <div class="example-preview">
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <form class="formSearch">
                                <div class="row align-items-center">
                                    <div class="col-md-7 my-2 my-md-0">
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
                            <h5>Histori Input Stok Obat</h5>
                        </div>
                    </div>
                </div>

                <div class="datatable datatable-bordered datatable-head-custom" id="ktTableStokObat"></div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('stkbatFormTambah');
        var route  = "{{ route($route . '.storeStokObat') }}";
        var fields = { stkbat_stok : { validators : { notEmpty : { message : 'Stok tidak boleh kosong' } } } };
        
        global.init_formVld(form, route, fields);
        // end form validation submit

        // start set ktable datatable
        var id     = '#ktTableStokObat';
        var urll   = '{{ route($route . ".ktableStokObat", ["obat_id" => $obat_id] ) }}';
        var column = [
            { field : 'no', title : 'No. ', textAlign : 'center', sortable : false, width : 30 },
            { field : 'stkbat_keterangan', title : 'Keterangan', width : 200 },
            { field : 'stkbat_stok', title : 'Stok', width : 40, textAlign : 'center' },
            { field : 'stkbat_created_date', title : 'Created Date' },
        ];

        var cari = { generalSearch : '.generalSearch' };

        global.init_ktable(id,urll,column,cari);
        // end set ktable datatable
    });
</script>