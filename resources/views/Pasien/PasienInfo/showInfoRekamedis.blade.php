<style>
    .bckg{
        background-color: cornsilk;
    }
</style>
<div class="example">
    <div class="example-preview">
        <ul class="nav nav-tabs nav-bold" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#hasilPemeriksaan">
                    <span class="nav-icon"><i class="la la-bullhorn text-primary icon-lg"></i></span>
                    <span class="nav-text text-primary">Hasil Pemeriksaan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#resepObat">
                    <span class="nav-icon"><i class="la la-notes-medical text-primary icon-lg"></i></span>
                    <span class="nav-text text-primary">Resep Obat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#hasilLab">
                    <span class="nav-icon"><i class="la la-book-medical text-primary icon-lg"></i></span>
                    <span class="nav-text text-primary">Hasil Lab</span>
                </a>
            </li>
        </ul>
        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="hasilPemeriksaan" role="tabpanel" aria-labelledby="hasilPemeriksaan">
                @if(empty($records->psnrekdis_id))
                    <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Mohon maaf belum ada informasi yang bisa ditampilkan</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                @else
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Subjective</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="23%" class="text-right bckg">Keluhan Utama</th>
                                <td width="27%">{{ $records->psnrekdis_sbj_kelutm }}</td>
                                <th width="23%" class="text-right bckg">Riwayat Penyakit Dahulu</th>
                                <td width="27%">{{ $records->psnrekdis_sbj_keltam }}</td>
                            </tr>
                            <tr>
                                <th class="text-right bckg">Keluhan Tambahan</th>
                                <td>{{ $records->psnrekdis_sbj_riwpktskr }}</td>
                                <th class="text-right bckg">Riwayat Penyakit Keluarga</th>
                                <td>{{ $records->psnrekdis_sbj_riwpktdhl }}</td>
                            </tr>
                            <tr>
                                <th class="text-right bckg">Riwayat Penyakit Sekarang</th>
                                <td>{{ $records->psnrekdis_sbj_riwpktklg }}</td>
                                <th class="text-right bckg">Riwayat Penyakit Alergi</th>
                                <td>{{ $records->psnrekdis_sbj_riwpktkalg }}</td>
                            </tr>
                        </table>
                    </div>
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Objective</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th width="50%" class="text-center bckg" colspan="2">2A. VITAL SIGN</th>
                                <th width="50%" class="text-center bckg" colspan="2">2B. STATUS GIZI</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-right" width="25%">Tekanan Darah</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_vstd }} mmHG</td>
                                    <th width="25%" class="text-right">Berat Badan</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_sgbb }} kg</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">HR</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_vshr }} x/menit</td>
                                    <th width="25%" class="text-right">Tinggi Badan</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_sgtb }} cm</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">RR</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_vsrr }} x/menit</td>
                                    <th width="25%" class="text-right">IMT</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_sgimt }} kg/m2</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">Suhu Badan</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_vst }} °C</td>
                                    <th width="25%" class="text-right" colspan="2"></th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-center bckg">2C. PEMERIKSAAN FISIK</th>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">Kepala</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pfkpl }}</td>
                                    <th width="25%" class="text-right">Leher</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pflhr }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">Thorax, Cor</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pflhr }}</td>
                                    <th width="25%" class="text-right">Thorax, Pulmo</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pftpul }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">Abdomen</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pftpul }}</td>
                                    <th width="25%" class="text-right">Ekstremitas, Atas</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pfeksats }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right" width="25%">Ekstremitas, Bawah</th>
                                    <td width="25%">{{ $records->psnrekdis_obj_pfeksbwh }}</td>
                                    <th width="25%" class="text-right" colspan="2"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Assessment</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center bckg">Diagnosa Keperawatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ $records->psnrekdis_asm_digkrt }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">4. Planning</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center bckg">Rencana Asuhan Keperawatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{ $records->psnrekdis_pln_rak }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tab-pane fade" id="resepObat" role="tabpanel" aria-labelledby="resepObat">
                @if($resep->isEmpty())
                    <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Mohon maaf belum ada informasi yang bisa ditampilkan</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1%">No. </th>
                                    <th class="text-center">Obat</th>
                                    <th class="text-center">Kategori Obat</th>
                                    <th class="text-center" width="10%">Jenis Obat</th>
                                    <th class="text-center" width="12%">Jumlah Obat</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resep as $key => $value)
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
                @endif
            </div>
            <div class="tab-pane fade" id="hasilLab" role="tabpanel" aria-labelledby="hasilLab">Tab content 4</div>
        </div>
    </div>
</div>