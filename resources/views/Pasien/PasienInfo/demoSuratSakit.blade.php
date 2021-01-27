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
            <strong style="text-decoration: underline;">SURAT KETERANGAN SAKIT</strong>
        </td>
    </tr>
    <tr>
        <td style="padding-top: 10px;">
            <div>Yang bertanda tangan dibawah ini menerangkan bahwa :</div>
        </td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td style="padding-left: 50px; width: 20%;">N a m a</td>
        <td style="text-overflow: hidden;">: <strong>{{ $pasien->{'pasien_nama'} }}</strong></td>
    </tr>
    <tr>
        <td style="padding-left: 50px; width: 20%;">U m u r</td>
        <td>: <strong>{{ $pasien->{'pasien_umur'} }} tahun</strong></td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left: 50px;">Perlu beristirahat karena sakit, selama <strong>{{ $pasien->{'sskt_jmlhari'} }}</strong> hari. Terhitung tanggal <strong>{{ date('d F Y', strtotime($pasien->{'sskt_tgl_mulai'})) }}</strong> s/d <strong>{{ date('d F Y', strtotime($pasien->{'sskt_tgl_akhir'})) }}</strong>.</td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td style="width: 50%; vertical-align: top;">
            <div>Harap yang berkepentingan maklum.</div>
        </td>
        <td style="width: 50%;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center; height: 75px; vertical-align: top;">Jakarta, {{ date('d F Y') }}</td>
                </tr>
                <tr style="text-align: center">
                    <td>( .................................... )</td>
                </tr>
            </table>            
        </td>
    </tr>
</table>