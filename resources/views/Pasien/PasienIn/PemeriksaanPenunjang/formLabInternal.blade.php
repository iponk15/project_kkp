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
    <form class="form" id="formCekLab" method="POST">
        <input type="hidden" name="rjklab_id" value="{{ $labid }}">
        {{ csrf_field() }}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th width="20%">Nomor</th>
                        <td width="30%">{{ $records->pasien_norekdis }}</td>
                        <th width="20%">Tanggal</th>
                        <td width="30%">{{ date('D F Y') }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Nama</th>
                        <td width="30%">{{ $records->pasien_nama }}</td>
                        <th width="20%">Umur</th>
                        <td width="30%">{{ $records->pasien_umur }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Pangkat / Gol</th>
                        <td width="30%">{{ $records->golongan_nama }}</td>
                        <th width="20%">Jenis Kelamin</th>
                        <td width="30%">{{ $records->pasien_jk == 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
                    </tr>
                    <tr>
                        <th width="20%">NIP</th>
                        <td width="30%">-</td>
                        <th width="20%">Telp</th>
                        <td width="30%">{{ $records->pasien_telp }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Unit Kerja</th>
                        <td width="30%">{{ $records->uker_nama }}</td>
                        <th width="20%">Dokter</th>
                        <td width="30%">{{ $records->dokter_nama }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Diagosa</th>
                        <td colspan="3">
                            <textarea name="rjklab_diagnosa" class="form-control" rows="3" placeholder="Input Diagnosa">{{ @$labs->rjklab_diagnosa }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="table-responsive-lg">
                <table class="table">
                    <thead style="background-color: gainsboro;">
                        <tr>
                            <th colspan="3" class="text-center">HEMATOLOGI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_rutin" {{ @$labs->rjklab_htg_rutin == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Rutin (HB,HT,TR,Lc)
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_lekosit" {{ @$labs->rjklab_htg_lekosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Lekosit
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_dc" {{ @$labs->rjklab_htg_dc == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Diff Count
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_hb" {{ @$labs->rjklab_htg_hb == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HB
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_trombosit" {{ @$labs->rjklab_htg_trombosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Trombosit
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_gd" {{ @$labs->rjklab_htg_gd == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Golongan Darah
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_hematokrit" {{ @$labs->rjklab_htg_hematokrit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Hematokrit
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_led" {{ @$labs->rjklab_htg_led == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        LED
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_rhesus" {{ @$labs->rjklab_htg_rhesus == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Rhesus
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_eritrosit" {{ @$labs->rjklab_htg_eritrosit == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Eritrosit
                                    </label>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_htg_mmm" {{ @$labs->rjklab_htg_mmm == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        MVC, MCH, MCHC
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive-lg">
                <table class="table">
                    <thead style="background-color: gainsboro;">
                        <tr>
                            <th colspan="4" class="text-center">KIMIA KLINIK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><b>LEMAK HATI</b></td>
                            <td class="text-center"><b>FAAL HATI</b></td>
                            <td class="text-center"><b>FAAL GINJAL</b></td>
                            <td class="text-center"><b>GULA DARAH</b></td>
                        </tr>
                        <tr>
                            <td width="25%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_ld_kt" {{ @$labs->rjklab_kk_ld_kt == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol Total *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_fh_ast" {{ @$labs->rjklab_kk_fh_ast == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        AST/SGOT
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_fg_ureum" {{ @$labs->rjklab_kk_fg_ureum == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Ureum
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_gd_gds" {{ @$labs->rjklab_kk_gd_gds == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Gula Darah Sewaktu
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_ld_kh" {{ @$labs->rjklab_kk_ld_kh == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol HDL *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_fh_alt" {{ @$labs->rjklab_kk_fh_alt == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        ALT/SGPT
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_fg_kreatinin" {{ @$labs->rjklab_kk_fg_kreatinin == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kreatinin
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_gd_gdp" {{ @$labs->rjklab_kk_gd_gdp == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Gula Darah Puasa *
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" colspan="2">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_ld_kl" {{ @$labs->rjklab_kk_ld_kl == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Kolesterol LDL *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_fg_au" {{ @$labs->rjklab_kk_fg_au == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Asam Urat
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_gd_gdj" {{ @$labs->rjklab_kk_gd_gdj == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Gula Darah 2 JPP
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" colspan="3">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_ld_trig" {{ @$labs->rjklab_kk_ld_trig == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Trigliserida *
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_kk_gd_hba" {{ @$labs->rjklab_kk_gd_hba == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HBA!C *
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive-lg">
                <table class="table">
                    <thead style="background-color: gainsboro;">
                        <tr>
                            <th colspan="3" class="text-center">IMUNOLOGI & SEROLOGI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_is_widal" {{ @$labs->rjklab_is_widal == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Widal
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_is_hbs" {{ @$labs->rjklab_is_hbs == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HBsAg
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_is_ah" {{ @$labs->rjklab_is_ah == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Anti HBs
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive-lg">
                <table class="table">
                    <thead style="background-color: gainsboro;">
                        <tr>
                            <th colspan="3" class="text-center">URINE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_urine_hcg" {{ @$labs->rjklab_urine_hcg == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        HCG
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_urine_narkoba" {{ @$labs->rjklab_urine_narkoba == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Narkoba
                                    </label>
                                </div>
                            </td>
                            <td width="33.3333333%">
                                <div class="checkbox-inline"> 
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="rjklab_urine_ul" {{ @$labs->rjklab_urine_ul == '1' ? 'checked' : '' }} />
                                        <span></span>
                                        Urine Lengkap
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-2 ml-lg-auto">
                    <button type="submit" id="submitFormLab" class="btn btn-success mr-2">{{ empty($labid) ? 'Simpan' : 'Update'}}</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        // start form validation submit
        var form   = document.getElementById('formCekLab');
        var urll   = "{{ route( $route . '.storeFormLabInternal', ['psnrekdis_id' => Hashids::encode($records->psnrekdis_id)] ) }}";
        var fields = {};
        
        global.init_formVldtn(form, urll, fields, '#submitFormLab');
        // end form validation submit
    });
</script>