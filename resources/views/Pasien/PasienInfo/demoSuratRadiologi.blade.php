<style>
    table { 
        border-spacing: 10px;
        border-collapse: separate;
    }
</style>
<table style="width: 100%; border-bottom: 1px solid black; margin-bottom: 10px;">
    <tr>
        <td align="center">
            <img src="assets/media/logos/kkp-log-min.jpg" alt="" style="height: 100px; text-align: center;">
        </td>
        <td align="center">
            <h4>
                <strong>KLINIK KEMENTERIAN KELAUTAN DAN PERIKANAN</strong><br>
                Medan Merdeka Timur No.16, Gedung Mina Bahari<br>
                Jakarta Pusat 10110<br>
                Telp. 021-3519070 Ext. 7044 / 7045
            </h4>
        </td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td style="text-align: center;">
            <strong style="text-decoration: underline;">INFO PEMERIKSAAN</strong>
        </td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td colspan="4">1. Subjective</td>
    </tr>
    <tr>
        <td width="25%" style="background-color: #FFF8DC;">Keluhan Utama</td>
        <td width="25%">{{ $records->psnrekdis_sbj_kelutm }}</td>
        <td width="25%" style="background-color: #FFF8DC;">Riwayat Penyakit Dahulu</td>
        <td width="25%">{{ $records->psnrekdis_sbj_keltam }}</td>
    </tr>
    <tr>
        <td width="25%" style="background-color: #FFF8DC;">Keluhan Tambahan</td>
        <td width="25%">{{ $records->psnrekdis_sbj_riwpktskr }}</td>
        <td width="25%" style="background-color: #FFF8DC;">Riwayat Penyakit Keluarga</td>
        <td width="25%">{{ $records->psnrekdis_sbj_riwpktdhl }}</td>
    </tr>
    <tr>
        <td width="25%" style="background-color: #FFF8DC;">Riwayat Penyakit Sekarang</td>
        <td width="25%">{{ $records->psnrekdis_sbj_riwpktklg }}</td>
        <td width="25%" style="background-color: #FFF8DC;">Riwayat Penyakit Alergi</td>
        <td width="25%">{{ $records->psnrekdis_sbj_riwpktkalg }}</td>
    </tr>
    <tr>
        <td colspan="4">2. Objective</td>
    </tr>
    <tr>
        <td colspan="2" style="background-color: #FFF8DC; text-align: center;">2A. VITAL SIGN</td>
        <td colspan="2" style="background-color: #FFF8DC; text-align: center;">2B. STATUS GIZI</td>
    </tr>
    <tr>
        <td width="25%">Tekanan Darah</td>
        <td width="25%">{{ $records->psnrekdis_obj_vstd }} mmHG</td>
        <td width="25%">Berat Badan</td>
        <td width="25%">{{ $records->psnrekdis_obj_sgbb }} kg</td>
    </tr>
    <tr>
        <td width="25%">HR</td>
        <td width="25%">{{ $records->psnrekdis_obj_vshr }} x/menit</td>
        <td width="25%">Tinggi Badan</td>
        <td width="25%">{{ $records->psnrekdis_obj_sgtb }} cm</td>
    </tr>
    <tr>
        <td width="25%">RR</td>
        <td width="25%">{{ $records->psnrekdis_obj_vsrr }} x/menit</td>
        <td width="25%">IMT</td>
        <td width="25%">{{ $records->psnrekdis_obj_sgimt }} kg/m2</td>
    </tr>
    <tr>
        <td width="25%">Suhu Badan</td>
        <td width="25%">{{ $records->psnrekdis_obj_vst }} °C</td>
        <td width="25%" colspan="2"></td>
    </tr>
    @if($records->poli_kode != 'KKPPOLGG')
        <tr>
            <td colspan="4" style="background-color: #FFF8DC; text-align: center;">2C. PEMERIKSAAN FISIK</td>
        </tr>
        <tr>
            <td width="25%">Kepala</td>
            <td width="25%">{{ $records->psnrekdis_obj_pfkpl }}</td>
            <td width="25%">Leher</td>
            <td width="25%">{{ $records->psnrekdis_obj_pflhr }}</td>
        </tr>
        <tr>
            <td width="25%">Thorax, Cor</td>
            <td width="25%">{{ $records->psnrekdis_obj_pflhr }}</td>
            <td width="25%">Thorax, Pulmo</td>
            <td width="25%">{{ $records->psnrekdis_obj_pftpul }}</td>
        </tr>
        <tr>
            <td width="25%">Abdomen</td>
            <td width="25%">{{ $records->psnrekdis_obj_pftpul }}</td>
            <td width="25%">Ekstremitas, Atas</td>
            <td width="25%">{{ $records->psnrekdis_obj_pfeksats }}</td>
        </tr>
        <tr>
            <td width="25%">Ekstremitas, Bawah</td>
            <td width="25%">{{ $records->psnrekdis_obj_pfeksbwh }}</td>
            <td width="25%" colspan="2"></td>
        </tr>
    @endif
</table>
@if($records->poli_kode != 'KKPPOLGG')
    <table style="width: 100%;">
        <tr>
            <td width="50%">3. Assesment</td>
            <td width="50%">4. Planning</td>
        </tr>
        <tr>
            <td style="background-color: #FFF8DC; text-align: center;">Diagnosa Keperawatan</td>
            <td style="background-color: #FFF8DC; text-align: center;">Rencana Asuhan Keperawatan</td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $records->psnrekdis_asm_digkrt }}</td>
            <td style="text-align: center;">{{ $records->psnrekdis_pln_rak }}</td>
        </tr>
    </table>
@endif