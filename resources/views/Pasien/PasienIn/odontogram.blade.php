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
    <div class="card-body py-5">
        <div class="example">
            <div class="example-preview">
                <form class="form" id="jenispFormTambah" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="9.9 67.66 480.2 245.766">
                                <g transform="matrix(1.5, 0, 0, 1.5, 38.161758, 86.386719)" id="gmain">
                                    @foreach($modon as $rows)
                                        <g id="{{ $rows['modon_kode'] }}" transform="{!! $rows['modon_transform'] !!}">
                                            @foreach($rows['modon_detail'] as $modets)
                                                <polygon points="{!! $modets['modet_points'] !!}" stroke="navy" stroke-width="0.5" id="{{ $modets['modet_kode'] }}" opacity="1" style="fill: {{ (!empty($modets['modet_warna']) ? $modets['modet_warna'] : 'white') }}; stroke-miterlimit: 2;"/>
                                            @endforeach
                                            <text style="fill: rgb(0, 0, 128); font-size: 8px; white-space: pre;" x="6" y="-5">{{ $rows['modon_no'] }}</text>
                                        </g>
                                    @endforeach
                                    <path d="M 140.742 -8.763 L 140.742 -9.768 C 140.742 -10.037 140.958 -10.258 141.229 -10.258 C 141.493 -10.258 141.709 -10.037 141.709 -9.768 L 141.709 -8.763 L 143.392 -8.763 L 141.229 -5.82 L 139.059 -8.763 L 140.742 -8.763 Z" style="fill:#000080;"></path>
                                    <path d="M 140.742 65.352 L 140.742 66.357 C 140.742 66.626 140.958 66.847 141.229 66.847 C 141.493 66.847 141.709 66.626 141.709 66.357 L 141.709 65.352 L 143.392 65.352 L 141.229 62.409 L 139.059 65.352 L 140.742 65.352 Z" style="fill:#000080;" bx:origin="0.5 0.476983"></path>
                                    <path d="M 140.742 73.904 L 140.742 72.899 C 140.742 72.63 140.958 72.409 141.229 72.409 C 141.493 72.409 141.709 72.63 141.709 72.899 L 141.709 73.904 L 143.392 73.904 L 141.229 76.847 L 139.059 73.904 L 140.742 73.904 Z" style="fill:#000080;"></path>
                                    <path d="M 140.742 148.685 L 140.742 149.69 C 140.742 149.959 140.958 150.18 141.229 150.18 C 141.493 150.18 141.709 149.959 141.709 149.69 L 141.709 148.685 L 143.392 148.685 L 141.229 145.742 L 139.059 148.685 L 140.742 148.685 Z" style="fill:#000080;" bx:origin="0.5 0.476983"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <label class="kodeodon"><h6>xxx-x</h6></label>
                            </div>
                            
                            <div class="form-group">
                                <label>Kode <span class="text-danger">*</span></label>
                                <input type="text" readonly class="form-control odon_kode" placeholder="Kode Odontogram" name="odon_kode">
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="form-group">
                                <label>Jenis Penyakit<span class="text-danger">*</span></label>
                                <select name="odon_jenisp_id" class="form-control odon_jenisp_id">
                                    <option></option>
                                </select>
                                <span class="form-text text-muted"></span>
                            </div>
                            <div class="form-group">
                                <label>Keterangan<span class="text-danger">*</span></label>
                                <textarea name="odon_keterangan" class="form-control" rows="3" placeholder="Input Keterangan"></textarea>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Simpan Data</button>
                        </div>
                    </div>
                </form>
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
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0 text-right"></div>
                    </div>
                </div>
                <!--end::Search Form-->

                <!--begin: Datatable-->
                <div class="datatable datatable-bordered datatable-head-custom" id="ktTableTestOdon"></div>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("polygon").hover(function (evt) {
            var sector = $(evt.target);
            var posisi = sector.attr('id');
            var nomor  = sector.parent().attr('id');
            $('.kodeodon').html('<h6>'+nomor+'-'+posisi+'</h6>');
        });

        $('svg').on('click', 'polygon', function (e) {
            var sector   = $(e.target); 
            var strdebug = sector.parent().attr('id') + '-' + sector.attr('id');
                
            $('.odon_kode').val(strdebug);
            e.preventDefault();
        });

        // start select2 option jenis penyakit
        var jenispOption = {
            route_to    : '{{ route("globalfunction.getdata", ["table" => "kkp_jenisp_gigi", "prefix" => "jenisp"]) }}',
            placeholder : 'Pilih Jeis Penyakit',
            allowClear  : true
        };

        global.init_select2('.odon_jenisp_id', jenispOption);
        // end select2 option jenis penyakit

        // start form validation submit
        var form   = document.getElementById('jenispFormTambah');
        var urll   = "{{ route($route . '.storeOdontogram', ['psnrekdis_id' => $psnrekdis_id]) }}";
        var fields = {
            odon_kode       : { validators : { notEmpty : { message : 'Kode tidak boleh kosong' } } },
            odon_jenisp_id  : { validators : { notEmpty : { message : 'Jenis Penyakit tidak boleh kosong' } } },
            odon_keterangan : { validators : { notEmpty : { message : 'Keterangan tidak boleh kosong' } } },
        };
        
        global.init_formVld(form, urll, fields);
        // end form validation submit

        // start set ktable datatable
        var id     = '#ktTableTestOdon';
        var urll   = '{{ route($route . ".ktableOdon", ["psnrekdis_id" => $psnrekdis_id] ) }}';
        var column = [
            { field : 'no', title : 'No. ', textAlign : 'center', sortable : false, width : 30 },
            { field : 'odon_kode', title : 'Gigi', width : 45 },
            { field : 'jenisp_nama', title : 'Jenis Penyakit', width : 170 },
            { field : 'odon_keterangan', title : 'Keterangan', width : 170 },
            { field : 'odon_createddate', title : 'Created At', width : 170, textAlign : 'center' }
        ];

        var cari = {
            generalSearch : '.generalSearch',
            status        : '.status'
        };

        global.init_ktable(id,urll,column,cari);
        // end set ktable datatable
    });
</script>