<?php

namespace Database\Seeders;

use App\Models\PerangkatDaerah;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PerangkatDaerahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Dinas Komunikasi dan Informatika', 'slug' => 'diskominfo', 'email' => 'diskominfo@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 366110'],
            ['nama' => 'Bagian Pengadaan Barang dan Jasa', 'slug' => 'bag-pbj', 'email' => 'lpse@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Administrasi Perekonomian', 'slug' => 'bag-perekonomian', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Administrasi Kerjasama', 'slug' => 'bag-kerjasama', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Badan Perencanaan Pembangunan Daerah', 'slug' => 'bappeda', 'email' => 'bappeda@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391612'],
            ['nama' => 'Dinas Pertanahan', 'slug' => 'dispertan', 'email' => 'dinas.pertanahan@malangkab.go.id', 'alamat' => 'Jl. Terusan Kawi No. 5 Malang', 'telp' => '(0341) 325410'],
            ['nama' => 'Bagian Administrasi Kesejahteraan Rakyat', 'slug' => 'bag-kesra', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Organisasi', 'slug' => 'bag-organisasi', 'email' => 'organisasi@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Protokol dan Komunikasi Pimpinan', 'slug' => 'bag-prokopim', 'email' => 'prokopim@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Tata Usaha', 'slug' => 'bag-tu', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Umum', 'slug' => 'bag-umum', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Administrasi Tata Pemerintahan', 'slug' => 'bag-tapem', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Hukum', 'slug' => 'bag-hukum', 'email' => 'hukum@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Bagian Adms. Kemasyarakatan dan Pembinaan Mental', 'slug' => 'bag-kesmas-bintal', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'BKPSDM', 'slug' => 'bkpsdm', 'email' => 'bkpsdm@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 323062'],
            ['nama' => 'Dinas Kependudukan dan Pencatatan Sipil', 'slug' => 'dispendukcapil', 'email' => 'dispendukcapil@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391648'],
            ['nama' => 'Dinas Tenaga Kerja', 'slug' => 'disnaker', 'email' => 'disnaker@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 161 Kepanjen', 'telp' => '(0341) 392212'],
            ['nama' => 'Dinas Perindustrian dan Perdagangan', 'slug' => 'disperindag', 'email' => 'disperindag@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 2 Kepanjen', 'telp' => '(0341) 391717'],
            ['nama' => 'Dinas Ketahanan Pangan', 'slug' => 'dkp', 'email' => 'dkp@malangkab.go.id', 'alamat' => 'Jl. Raya Singosari No. 16', 'telp' => '(0341) 458331'],
            ['nama' => 'Dinas Sosial', 'slug' => 'dinsos', 'email' => 'dinsos@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 1 Kepanjen', 'telp' => '(0341) 391605'],
            ['nama' => 'Bagian Administrasi Sumber Daya Alam', 'slug' => 'bag-sda', 'email' => null, 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391673'],
            ['nama' => 'Dinas Peternakan dan Kesehatan Hewan', 'slug' => 'disnak-keswan', 'email' => 'disnak@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 6 Kepanjen', 'telp' => '(0341) 391630'],
            ['nama' => 'Inspektorat', 'slug' => 'inspektorat', 'email' => 'inspektorat@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 366258'],
            ['nama' => 'Dinas Pariwisata dan Kebudayaan', 'slug' => 'disparbud', 'email' => 'disparbud@malangkab.go.id', 'alamat' => 'Jl. Raya Singosari No. 275', 'telp' => '(0341) 451135'],
            ['nama' => 'Dinas Perpustakaan dan Kearsipan', 'slug' => 'disperpusip', 'email' => 'perpus@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 362431'],
            ['nama' => 'Dinas Pemberdayaan Masyarakat dan Desa', 'slug' => 'dpmd', 'email' => 'dpmd@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 327774'],
            ['nama' => 'Satpol PP', 'slug' => 'satpol-pp', 'email' => 'satpolpp@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 362447'],
            ['nama' => 'Badan Kesatuan Bangsa dan Politik', 'slug' => 'bakesbangpol', 'email' => 'bakesbangpol@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 325411'],
            ['nama' => 'Sekretariat DPRD', 'slug' => 'setwan', 'email' => 'setwan@malangkab.go.id', 'alamat' => 'Jl. Panji No. 119, Kepanjen', 'telp' => '(0341) 391624'],
            ['nama' => 'Badan Keuangan dan Aset Daerah', 'slug' => 'bkad', 'email' => 'bkad@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 325410'],
            ['nama' => 'Dinas PU Sumber Daya Air', 'slug' => 'pusda', 'email' => 'pusda@malangkab.go.id', 'alamat' => 'Jl. Kepanjen No. 1', 'telp' => '(0341) 391617'],
            ['nama' => 'Dinas Pendidikan', 'slug' => 'disdik', 'email' => 'pendidikan@malangkab.go.id', 'alamat' => 'Jl. Penarukan No. 1 Kepanjen', 'telp' => '(0341) 391642'],
            ['nama' => 'Dinas Pemuda dan Olahraga', 'slug' => 'dispora', 'email' => 'dispora@malangkab.go.id', 'alamat' => 'Stadion Kanjuruhan Kepanjen', 'telp' => '(0341) 391600'],
            ['nama' => 'Dinas Kesehatan', 'slug' => 'dinkes', 'email' => 'dinkes@malangkab.go.id', 'alamat' => 'Jl. Panji No. 120, Kepanjen', 'telp' => '(0341) 391621'],
            ['nama' => 'Dinas Perhubungan', 'slug' => 'dishub', 'email' => 'dishub@malangkab.go.id', 'alamat' => 'Jl. Raya Talangagung No. 1 Kepanjen', 'telp' => '(0341) 396621'],
            ['nama' => 'Dinas PPKB', 'slug' => 'dppkb', 'email' => 'dppkb@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391652'],
            ['nama' => 'Badan Pendapatan Daerah', 'slug' => 'bapenda', 'email' => 'bapenda@malangkab.go.id', 'alamat' => 'Jl. Panji No. 158, Kepanjen', 'telp' => '(0341) 391660'],
            ['nama' => 'Dinas Perikanan', 'slug' => 'diskan', 'email' => 'perikanan@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 4 Kepanjen', 'telp' => '(0341) 391661'],
            ['nama' => 'Dinas PPPA', 'slug' => 'dpppa', 'email' => 'dpppa@malangkab.go.id', 'alamat' => 'Jl. Terusan Kawi No. 5 Malang', 'telp' => '(0341) 355088'],
            ['nama' => 'Dinas PMPTSP', 'slug' => 'dpmptsp', 'email' => 'dpmptsp@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 4 Kepanjen', 'telp' => '(0341) 391604'],
            ['nama' => 'Dinas PU Bina Marga', 'slug' => 'dpubm', 'email' => 'dpubm@malangkab.go.id', 'alamat' => 'Jl. Raya Kepanjen No. 1', 'telp' => '(0341) 391616'],
            ['nama' => 'Dinas Perumahan, Kawasan Permukiman dan Cipta Karya', 'slug' => 'dpkpck', 'email' => 'dpkpcp@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 6 Kepanjen', 'telp' => '(0341) 391611'],
            ['nama' => 'BPBD', 'slug' => 'bpbd', 'email' => 'bpbd@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 101 Kepanjen', 'telp' => '(0341) 392111'],
            ['nama' => 'Dinas Koperasi dan Usaha Mikro', 'slug' => 'diskopum', 'email' => 'diskop@malangkab.go.id', 'alamat' => 'Jl. Trunojoyo No. 161 Kepanjen', 'telp' => '(0341) 392215'],
            ['nama' => 'Dinas Lingkungan Hidup', 'slug' => 'dlh', 'email' => 'dlh@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 325410'],
            ['nama' => 'Badan Penelitian dan Pengembangan Daerah', 'slug' => 'balitbangda', 'email' => 'balitbangda@malangkab.go.id', 'alamat' => 'Jl. KH Agus Salim No. 7 Malang', 'telp' => '(0341) 366110'],
            ['nama' => 'Dinas TPHP', 'slug' => 'dtphp', 'email' => 'pertanian@malangkab.go.id', 'alamat' => 'Jl. Raya Panji No. 158 Kepanjen', 'telp' => '(0341) 391618'],
            ['nama' => 'Kecamatan Ampelgading', 'slug' => 'kec-ampelgading', 'email' => 'ampelgading@malangkab.go.id', 'alamat' => 'Jl. Raya Tirtomoyo No. 1', 'telp' => '(0341) 851117'],
            ['nama' => 'Kecamatan Tirtoyudo', 'slug' => 'kec-tirtoyudo', 'email' => 'tirtoyudo@malangkab.go.id', 'alamat' => 'Jl. Raya Tirtoyudo No. 1', 'telp' => '(0341) 851121'],
            ['nama' => 'Kecamatan Dampit', 'slug' => 'kec-dampit', 'email' => 'dampit@malangkab.go.id', 'alamat' => 'Jl. Raya Dampit No. 1', 'telp' => '(0341) 896117'],
            ['nama' => 'Kecamatan Turen', 'slug' => 'kec-turen', 'email' => 'turen@malangkab.go.id', 'alamat' => 'Jl. Panglima Sudirman No. 1', 'telp' => '(0341) 824117'],
            ['nama' => 'Kecamatan Bantur', 'slug' => 'kec-bantur', 'email' => 'bantur@malangkab.go.id', 'alamat' => 'Jl. Raya Bantur No. 1', 'telp' => '(0341) 871117'],
            ['nama' => 'Kecamatan Sumbermanjing Wetan', 'slug' => 'kec-sumawe', 'email' => 'sumawe@malangkab.go.id', 'alamat' => 'Jl. Raya Sumawe No. 1', 'telp' => '(0341) 876117'],
            ['nama' => 'Kecamatan Gedangan', 'slug' => 'kec-gedangan', 'email' => 'gedangan@malangkab.go.id', 'alamat' => 'Jl. Raya Gedangan No. 1', 'telp' => '(0341) 873117'],
            ['nama' => 'Kecamatan Pagak', 'slug' => 'kec-pagak', 'email' => 'pagak@malangkab.go.id', 'alamat' => 'Jl. Raya Pagak No. 1', 'telp' => '(0341) 395117'],
            ['nama' => 'Kecamatan Dau', 'slug' => 'kec-dau', 'email' => 'dau@malangkab.go.id', 'alamat' => 'Jl. Raya Sengkaling No. 1', 'telp' => '(0341) 461117'],
            ['nama' => 'Kecamatan Karangploso', 'slug' => 'kec-karangploso', 'email' => 'karangploso@malangkab.go.id', 'alamat' => 'Jl. Raya Panglima Sudirman No. 1', 'telp' => '(0341) 461120'],
            ['nama' => 'Kecamatan Tajinan', 'slug' => 'kec-tajinan', 'email' => 'tajinan@malangkab.go.id', 'alamat' => 'Jl. Raya Tajinan No. 1', 'telp' => '(0341) 751117'],
            ['nama' => 'Kecamatan Singosari', 'slug' => 'kec-singosari', 'email' => 'singosari@malangkab.go.id', 'alamat' => 'Jl. Raya Singosari No. 1', 'telp' => '(0341) 458117'],
            ['nama' => 'Kecamatan Lawang', 'slug' => 'kec-lawang', 'email' => 'lawang@malangkab.go.id', 'alamat' => 'Jl. Raya Lawang No. 1', 'telp' => '(0341) 426117'],
            ['nama' => 'Kecamatan Pakis', 'slug' => 'kec-pakis', 'email' => 'pakis@malangkab.go.id', 'alamat' => 'Jl. Raya Pakis No. 1', 'telp' => '(0341) 791117'],
            ['nama' => 'Kecamatan Jabung', 'slug' => 'kec-jabung', 'email' => 'jabung@malangkab.go.id', 'alamat' => 'Jl. Raya Jabung No. 1', 'telp' => '(0341) 791120'],
            ['nama' => 'Kecamatan Pakisaji', 'slug' => 'kec-pakisaji', 'email' => 'pakisaji@malangkab.go.id', 'alamat' => 'Jl. Raya Pakisaji No. 1', 'telp' => '(0341) 396117'],
            ['nama' => 'Kecamatan Wagir', 'slug' => 'kec-wagir', 'email' => 'wagir@malangkab.go.id', 'alamat' => 'Jl. Raya Wagir No. 1', 'telp' => '(0341) 801117'],
            ['nama' => 'Kecamatan Tumpang', 'slug' => 'kec-tumpang', 'email' => 'tumpang@malangkab.go.id', 'alamat' => 'Jl. Raya Tumpang No. 1', 'telp' => '(0341) 787117'],
            ['nama' => 'Kecamatan Donomulyo', 'slug' => 'kec-donomulyo', 'email' => 'donomulyo@malangkab.go.id', 'alamat' => 'Jl. Raya Donomulyo No. 1', 'telp' => '(0341) 881117'],
            ['nama' => 'Kecamatan Kalipare', 'slug' => 'kec-kalipare', 'email' => 'kalipare@malangkab.go.id', 'alamat' => 'Jl. Raya Kalipare No. 1', 'telp' => '(0341) 393117'],
            ['nama' => 'Kecamatan Kromengan', 'slug' => 'kec-kromengan', 'email' => 'kromengan@malangkab.go.id', 'alamat' => 'Jl. Raya Kromengan No. 1', 'telp' => '(0341) 394117'],
            ['nama' => 'Kecamatan Ngantang', 'slug' => 'kec-ngantang', 'email' => 'ngantang@malangkab.go.id', 'alamat' => 'Jl. Raya Ngantang No. 1', 'telp' => '(0341) 521117'],
            ['nama' => 'Kecamatan Pujon', 'slug' => 'kec-pujon', 'email' => 'pujon@malangkab.go.id', 'alamat' => 'Jl. Raya Pujon No. 1', 'telp' => '(0341) 524117'],
            ['nama' => 'Kecamatan Kasembon', 'slug' => 'kec-kasembon', 'email' => 'kasembon@malangkab.go.id', 'alamat' => 'Jl. Raya Kasembon No. 1', 'telp' => '(0341) 523117'],
            ['nama' => 'Kecamatan Sumberpucung', 'slug' => 'kec-sumberpucung', 'email' => 'sumberpucung@malangkab.go.id', 'alamat' => 'Jl. Raya Sumberpucung No. 1', 'telp' => '(0341) 398117'],
            ['nama' => 'Kecamatan Bululawang', 'slug' => 'kec-bululawang', 'email' => 'bululawang@malangkab.go.id', 'alamat' => 'Jl. Raya Bululawang No. 1', 'telp' => '(0341) 833117'],
            ['nama' => 'Kecamatan Ngajum', 'slug' => 'kec-ngajum', 'email' => 'ngajum@malangkab.go.id', 'alamat' => 'Jl. Raya Ngajum No. 1', 'telp' => '(0341) 399117'],
            ['nama' => 'Kecamatan Kepanjen', 'slug' => 'kec-kepanjen', 'email' => 'kepanjen@malangkab.go.id', 'alamat' => 'Jl. Raya Kepanjen No. 1', 'telp' => '(0341) 391619'],
            ['nama' => 'Kecamatan Gondanglegi', 'slug' => 'kec-gondanglegi', 'email' => 'gondanglegi@malangkab.go.id', 'alamat' => 'Jl. Raya Gondanglegi No. 1', 'telp' => '(0341) 879117'],
            ['nama' => 'Kecamatan Pagelaran', 'slug' => 'kec-pagelaran', 'email' => 'pagelaran@malangkab.go.id', 'alamat' => 'Jl. Raya Pagelaran No. 1', 'telp' => '(0341) 877117'],
            ['nama' => 'Kecamatan Poncokusumo', 'slug' => 'kec-poncokusumo', 'email' => 'poncokusumo@malangkab.go.id', 'alamat' => 'Jl. Raya Poncokusumo No. 1', 'telp' => '(0341) 789117'],
            ['nama' => 'Kecamatan Wajak', 'slug' => 'kec-wajak', 'email' => 'wajak@malangkab.go.id', 'alamat' => 'Jl. Raya Wajak No. 1', 'telp' => '(0341) 821117'],
            ['nama' => 'Kecamatan Wonosari', 'slug' => 'kec-wonosari', 'email' => 'wonosari@malangkab.go.id', 'alamat' => 'Jl. Raya Wonosari No. 1', 'telp' => '(0341) 397117'],
        ];

        foreach ($data as $item) {
            $pd = PerangkatDaerah::create([
                'nama_pd' => $item['nama'],
                'slug' => $item['slug'],
                'email' => $item['email'],
                'alamat' => $item['alamat'],
                'telepon' => $item['telp'],
                'api_token' => Str::random(32),
            ]);

            User::create([
                'perangkat_daerah_id' => $pd->id,
                'name' => 'admin'.str_replace('-', '', $item['slug']),
                'email' => $item['email'] ?? ($item['slug'].'@placeholder.com'),
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
