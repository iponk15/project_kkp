<form method="POST" class="form" id="formResepObat">
    {{ csrf_field() }}
    <div class="modal-header" style="background-color: #173f5f;">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white;">{!! $modalTitle !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="example">
            <div class="example-preview">
                <div class="formRptResepObat">
                    <div class="form-group row input_fields_wrap">
                        <div class="col-lg-12 multiForm_0">
                            <div class="form-group row align-items-center">
                                <div class="col-md-4">
                                    <label>Obat &nbsp;&nbsp;&nbsp;<span class="text-muted notif_0"></span></label>
                                    <select name="resep_obat_id[]" class="form-control slctObat">
                                        <option></option>
                                    </select>
                                    <div class="d-md-none mb-2"></div>
                                </div>
                                <div class="col-md-2">
                                    <label>Jumlah</label>
                                    <input type="number" class="form-control resep_jumlah_0" placeholder="Jumlah" name="resep_jumlah[]">
                                    <div class="d-md-none mb-2"></div>
                                </div>
                                <div class="col-md-4">
                                    <label>Keterangan:</label>
                                    <textarea name="resep_keterangan[]" class="form-control resep_keterangan_0" rows="1" placeholder="Keterangan"></textarea>
                                    <div class="d-md-none mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-0 col-form-label text-right"></label>
                        <div class="col-lg-12">
                            <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary addResepObat" style="width: 100%;">
                                <i class="la la-plus"></i>Add
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Note </label>
                            <textarea name="resnote_keterangan" class="form-control" rows="5" placeholder="Catatan untuk menambahkan resep obat"></textarea>
                            <div class="d-md-none mb-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success font-weight-bold btnSimpan" id="btnResepObat">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formResepObat');
        var urll   = "{{ route( $route . '.storeResepObat', ['psnrekdis_id' => $psnrekdis_id] ) }}";
        var fields = {
            resep_obat_id : { validators : { notEmpty : { message : 'Obat tidak boleh kosong' } } },
            resep_jumlah  : { validators : { notEmpty : { message : 'Jumlah tidak boleh kosong' } } }
        };
        
        global.init_formVldtn(form, urll, fields, '#btnResepObat');
        // end form validation submit

        // start add remove dynamic form obat
        var wrapper    = $(".input_fields_wrap");
        var add_button = $(".addResepObat");
        
        var x = 0;
        $(add_button).click(function(e){
            e.preventDefault();
            
            x++;
            $(wrapper).append('<div class="col-lg-12 multiForm_'+ x +'">' +
                    '<div class="form-group row align-items-center">' +
                        '<div class="col-md-4">' +
                            '<label>Obat &nbsp;&nbsp;&nbsp;<span class="text-muted notif_'+ x +'"></span></label>' +
                            '<select name="resep_obat_id[]" class="form-control slctObat tempSlct_'+ x +'">' +
                                '<option></option>' +
                            '</select>' +
                            '<div class="d-md-none mb-2"></div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<label>Jumlah</label>' +
                            '<input type="number" class="form-control resep_jumlah_'+ x +'" placeholder="Jumlah" name="resep_jumlah[]">' +
                            '<div class="d-md-none mb-2"></div>' +
                        '</div>' +
                        '<div class="col-md-4">' +
                            '<label>Keterangan:</label>' +
                            '<textarea name="resep_keterangan[]" class="form-control resep_keterangan_'+ x +'" rows="1" placeholder="Keterangan"></textarea>' +
                            '<div class="d-md-none mb-2"></div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>' +
                            '<a href="javascript:;" data-counter="'+ x +'" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger remove_field">' +
                                '<i class="la la-trash-o"></i>Delete' +
                            '</a>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );

            selectObat(x)
        });
        
        $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            var counter = $(this).data('counter');

            $('.multiForm_' + counter).remove(); 
        });
        // end add remove dynamic form obat

        selectObat(0)
    });

    function selectObat(idx){
        // start select2 obat
        var obatOption = {
            route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_obat", "prefix" => "obat"]) }}',
            placeholder : 'Pilih Obat',
            allowClear  : true
        };

        global.init_select2('.slctObat', obatOption);
        // end select2 obat

        $('.slctObat').on('change', function(){
            var val = $(this).val();
            
            $.post('{{ route( $route . ".cekStokObat" ) }}', { obat_id : val }, function(data){
                $('.notif_' + idx).text(data.message);

                (data.stok == 0) 
                    ? $('.resep_jumlah_' + idx).attr('disabled', true) + $('.resep_keterangan_' + idx).attr('disabled', true)
                    : $('.resep_jumlah_' + idx).attr('disabled', false) + $('.resep_keterangan_' + idx).attr('disabled', false);

            },'json');
        });
    }
</script>