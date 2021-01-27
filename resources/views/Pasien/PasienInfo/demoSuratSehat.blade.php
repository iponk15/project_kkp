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
            <strong style="text-decoration: underline;">SURAT KETERANGAN BERBADAN SEHAT</strong>
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
        <td style="padding-left: 50px; width: 25%;">Nama</td>
        <td>: <strong>{{ $pasien->{'pasien_nama'} }}</strong></td>
    </tr>
    <tr>
        <td style="padding-left: 50px; width: 25%;">Umur</td>
        <td>: <strong>{{ $pasien->{'pasien_umur'} }} tahun</strong></td>
    </tr>
    <tr>
        <td style="padding-left: 50px; width: 25%;">Jenis Kelamin</td>
        <td>: <strong>{!! $pasien->{'pasien_jk'} == 'p'? 'Pria/<span style="text-decoration: line-through;">Wanita</span>':'Wanita/<span style="text-decoration: line-through;">Pria</span>' !!}</strong><td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td style="padding-top: 10px;">
            <div>Waktu diperiksa dalam keadaan SEHAT, surat keterangan ini diperlukan untuk :</div>
        </td>
    </tr>
</table>
<table style="width: 100%;">
    @php
        $reasons = [
            'Diklat Prajabatan',
            'Diklat PIM',
            'Mengikuti Training',
            'Keterangan Lain-lain',
        ]
    @endphp
    @foreach ($reasons as $key => $item)
    <tr>
        <td style="padding-left: 50px; width: 25px;"><div style="width: 25px; height: 25px; border: 1px solid black;">{{ $pasien->{'ssht_keperluan'} == ($key+1) ?? "✓" }}</div></td>
        <td>{{$pasien->{'ssht_keperluan'} == '4' ? $pasien->{'ssht_keterangan'} : ucwords($item) }}<td>
    </tr>
    @endforeach
</table>
<table style="width: 100%;">
    <tr>
        <td>
            <div>Demikian harap yang berkepentingan maklum.</div>
        </td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td style="width: 50%;">
            <table>
                <tr>
                    <td colspan="2"><div style="text-decoration: underline;">Hasil Pemeriksaan</div></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tinggi Badan</td>
                    <td>: {{ $pasien->{'pasien_tinggi_badan'} }} cm</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Berat Badan</td>
                    <td>: {{ $pasien->{'pasien_berat_badan'} }} kg</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tensi</td>
                    <td>: {{ $pasien->{'pasien_tensi_darah'} }} mm/hg</td>
                </tr>
                <tr>
                    <td style="width: 20%;">Buta Warna</td>
                    <td>: - </td>
                </tr>
            </table>
        </td>
        <td style="width: 50%;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center;">Jakarta, {{ date('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="text-align: center; height: 100px; vertical-align: top;">Pemeriksa,</td>
                </tr>
                <tr style="text-align: center">
                    <td>( .................................... )</td>
                </tr>
            </table>            
        </td>
    </tr>
</table>