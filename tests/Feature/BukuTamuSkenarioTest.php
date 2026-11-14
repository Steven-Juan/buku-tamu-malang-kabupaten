<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Auth\RequestPasswordReset;
use App\Filament\Widgets\AdminPdStats;
use App\Livewire\DepartmentDetail;
use App\Livewire\GuestForm;
use App\Models\Guest;
use App\Models\PerangkatDaerah;
use App\Models\User;
use App\Notifications\ResetPasswordNotification as AppResetPasswordNotification;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Filament\Facades\Filament;
use Filament\Notifications\Auth\ResetPassword as FilamentResetPasswordNotification;
use Filament\Pages\Auth\PasswordReset\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

/**
 * Skenario uji TP-25..TP-34 + pengisian formulir tamu publik.
 *
 * Dijalankan di container uji terpisah dengan database uji sendiri (RefreshDatabase),
 * memakai kunci uji resmi Cloudflare Turnstile (verifikasi ke siteverify sungguhan).
 */
class BukuTamuSkenarioTest extends BaseTestCase
{
    use RefreshDatabase;

    private const SITEKEY_UJI = '1x00000000000000000000AA';

    private const SECRET_SELALU_LOLOS = '1x0000000000000000000000000000000AA';

    private const SECRET_SELALU_GAGAL = '2x0000000000000000000000000000000AA';

    /** Token dummy yang diterima secret uji Cloudflare. */
    private const TOKEN_DUMMY = 'XXXX.DUMMY.TOKEN.XXXX';

    private const SANDI_LAMA_A = 'SandiLamaA#2026';

    private PerangkatDaerah $pdA;

    private PerangkatDaerah $pdB;

    private User $adminA;

    private User $adminB;

    private User $superAdmin;

    private Guest $tamuA;

    private Guest $tamuB;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.turnstile.sitekey' => self::SITEKEY_UJI,
            'services.turnstile.secret' => self::SECRET_SELALU_LOLOS,
        ]);

        Filament::setCurrentPanel(Filament::getPanel('admin'));

        $this->pdA = PerangkatDaerah::create([
            'nama_pd' => 'Dinas Komunikasi dan Informatika',
            'slug' => 'diskominfo',
            'email' => 'kominfo@malangkab.go.id',
            'alamat' => 'Jl. K.H. Agus Salim No. 7 Malang',
            'telepon' => '0341364776',
        ]);

        $this->pdB = PerangkatDaerah::create([
            'nama_pd' => 'Badan Kepegawaian dan Pengembangan SDM',
            'slug' => 'bkpsdm',
            'email' => 'bkpsdm@malangkab.go.id',
            'alamat' => 'Jl. KH. Agus Salim No. 7 Malang',
            'telepon' => '0341364776',
        ]);

        $this->adminA = User::factory()->create([
            'perangkat_daerah_id' => $this->pdA->id,
            'name' => 'admindiskominfo',
            'email' => 'kominfo@malangkab.go.id',
            'password' => self::SANDI_LAMA_A,
        ]);

        $this->adminB = User::factory()->create([
            'perangkat_daerah_id' => $this->pdB->id,
            'name' => 'adminbkpsdm',
            'email' => 'bkpsdm@malangkab.go.id',
        ]);

        $this->superAdmin = User::factory()->create([
            'perangkat_daerah_id' => null,
            'name' => 'Super Admin 1',
            'email' => 'admin@admin.com',
        ]);

        $this->tamuA = $this->buatTamu($this->pdA, 'Tamu Milik A');
        $this->tamuB = $this->buatTamu($this->pdB, 'Tamu Milik B');
    }

    // ------------------------------------------------------------------
    // TP-25 .. TP-27: isolasi data antarinstansi di panel admin
    // ------------------------------------------------------------------

    // Catatan: setiap metode tes hanya memakai SATU user. Berganti user di dalam satu metode
    // (setelah respons 403/404) memicu artefak harness: binding `redirect` Livewire tertinggal di
    // container aplikasi tes sehingga StartSession menerima Livewire Redirector (TypeError -> 500).
    // Di produksi tiap request memakai state aplikasi baru, jadi kontrol dipisah per metode.

    public function test_tp25_admin_a_membuka_edit_tamu_milik_b_mendapat_404(): void
    {
        $this->actingAs($this->adminA)
            ->get("/admin/guests/{$this->tamuB->id}/edit")
            ->assertNotFound();
    }

    public function test_tp25_kontrol_admin_a_bisa_membuka_edit_tamu_miliknya(): void
    {
        $this->actingAs($this->adminA)->get("/admin/guests/{$this->tamuA->id}/edit")->assertOk();
    }

    public function test_tp25_kontrol_super_admin_bisa_membuka_edit_tamu_b(): void
    {
        $this->actingAs($this->superAdmin)->get("/admin/guests/{$this->tamuB->id}/edit")->assertOk();
    }

    public function test_tp26_admin_a_membuka_edit_perangkat_daerah_b_mendapat_404(): void
    {
        $this->actingAs($this->adminA)
            ->get("/admin/perangkat-daerahs/{$this->pdB->id}/edit")
            ->assertNotFound();
    }

    public function test_tp26_kontrol_admin_a_bisa_membuka_edit_perangkat_daerah_miliknya(): void
    {
        $this->actingAs($this->adminA)->get("/admin/perangkat-daerahs/{$this->pdA->id}/edit")->assertOk();
    }

    public function test_tp27_admin_a_membuka_daftar_user_mendapat_403(): void
    {
        $this->actingAs($this->adminA)->get('/admin/users')->assertForbidden();
    }

    public function test_tp27_admin_a_membuka_edit_user_super_admin_mendapat_403(): void
    {
        $this->actingAs($this->adminA)->get("/admin/users/{$this->superAdmin->id}/edit")->assertForbidden();
    }

    public function test_tp27_admin_a_membuka_edit_user_admin_b_mendapat_403(): void
    {
        $this->actingAs($this->adminA)->get("/admin/users/{$this->adminB->id}/edit")->assertForbidden();
    }

    public function test_tp27_kontrol_super_admin_bisa_membuka_daftar_user(): void
    {
        $this->actingAs($this->superAdmin)->get('/admin/users')->assertOk();
    }

    public function test_tp27_kontrol_super_admin_bisa_membuka_edit_user(): void
    {
        $this->actingAs($this->superAdmin)->get("/admin/users/{$this->adminA->id}/edit")->assertOk();
    }

    // ------------------------------------------------------------------
    // TP-31: QR Code di halaman publik instansi
    // ------------------------------------------------------------------

    public function test_tp31_qr_code_halaman_instansi_a_menuju_formulir_instansi_a(): void
    {
        $urlFormA = route('guest.form', $this->pdA->slug);
        $urlFormB = route('guest.form', $this->pdB->slug);

        // SVG QR yang diberikan komponen ke halaman /instansi/{slug A}
        $qrSvg = Livewire::test(DepartmentDetail::class, ['slug' => $this->pdA->slug])->get('qrCode');

        // SVG tersebut benar-benar tampil di halaman publik
        $this->get("/instansi/{$this->pdA->slug}")->assertOk()->assertSee($qrSvg, false);

        // Cek nilai yang diberikan ke generator: SVG identik dengan QR untuk URL formulir A, bukan B
        $this->assertSame($this->qrSvgUntuk($urlFormA), $qrSvg);
        $this->assertNotSame($this->qrSvgUntuk($urlFormB), $qrSvg);

        // Decode QR sungguhan (SVG -> PNG dengan rsvg-convert, lalu zbarimg)
        $hasilDecode = $this->decodeQrSvg($qrSvg);
        $this->assertNotNull($hasilDecode, 'QR tidak bisa di-decode (rsvg-convert/zbarimg tidak tersedia atau gagal)');
        $this->assertSame($urlFormA, $hasilDecode);

        // URL hasil decode membuka formulir instansi A
        $this->get($hasilDecode)
            ->assertOk()
            ->assertSee($this->pdA->nama_pd)
            ->assertDontSee($this->pdB->nama_pd);
    }

    // ------------------------------------------------------------------
    // TP-32: widget "Tamu Hari Ini" admin A
    // ------------------------------------------------------------------

    public function test_tp32_widget_tamu_hari_ini_admin_a_hanya_menghitung_tamu_a(): void
    {
        $this->actingAs($this->adminA);

        $awal = $this->angkaTamuHariIni();

        $this->buatTamu($this->pdA, 'Tamu Baru A');
        $setelahTamuA = $this->angkaTamuHariIni();
        $this->assertSame($awal + 1, $setelahTamuA, 'Tamu baru untuk A harus menambah angka A sebanyak 1');

        $this->buatTamu($this->pdB, 'Tamu Baru B');
        $setelahTamuB = $this->angkaTamuHariIni();
        $this->assertSame($setelahTamuA, $setelahTamuB, 'Tamu baru untuk B tidak boleh mengubah angka A');

        fwrite(STDERR, "\n[TP-32] Tamu Hari Ini admin A: awal={$awal}, +tamu A={$setelahTamuA}, +tamu B={$setelahTamuB}\n");
    }

    // ------------------------------------------------------------------
    // TP-33: lupa password
    // ------------------------------------------------------------------

    public function test_tp33_reset_password_lewat_halaman_lupa_password(): void
    {
        Notification::fake();

        $token = $this->mintaTokenResetLewatHalaman($this->adminA);

        // Notifikasi kustom aplikasi (bahasa Indonesia) dicatat terpisah: lihat laporan
        fwrite(STDERR, "\n[TP-33] Notifikasi kustom App\\Notifications\\ResetPasswordNotification terkirim? "
            .(Notification::sent($this->adminA, AppResetPasswordNotification::class)->isNotEmpty() ? 'ya' : 'tidak')."\n");

        $sandiBaru = 'SandiBaruA#2026';

        Livewire::test(ResetPassword::class, ['email' => $this->adminA->email, 'token' => $token])
            ->fillForm(['password' => $sandiBaru, 'passwordConfirmation' => $sandiBaru])
            ->call('resetPassword')
            ->assertHasNoErrors()
            ->assertRedirect(Filament::getLoginUrl());

        // Login dengan sandi baru berhasil
        $this->loginLewatHalaman($this->adminA->email, $sandiBaru)->assertHasNoErrors();
        $this->assertAuthenticatedAs($this->adminA);
        Filament::auth()->logout();

        // Login dengan sandi lama gagal
        $this->loginLewatHalaman($this->adminA->email, self::SANDI_LAMA_A)->assertHasErrors(['data.username']);
        $this->assertGuest();
    }

    public function test_tp33_token_reset_kedaluwarsa_lebih_dari_60_menit_ditolak(): void
    {
        Notification::fake();

        $token = $this->mintaTokenResetLewatHalaman($this->adminA);

        $this->travel(61)->minutes();

        Livewire::test(ResetPassword::class, ['email' => $this->adminA->email, 'token' => $token])
            ->fillForm(['password' => 'SandiBaruA#2026', 'passwordConfirmation' => 'SandiBaruA#2026'])
            ->call('resetPassword')
            ->assertNoRedirect()
            ->assertNotified(__('passwords.token'));

        $this->assertTrue(Hash::check(self::SANDI_LAMA_A, $this->adminA->fresh()->password), 'Sandi lama harus tetap berlaku');
        $this->assertFalse(Hash::check('SandiBaruA#2026', $this->adminA->fresh()->password));
    }

    // ------------------------------------------------------------------
    // TP-34: Turnstile di login admin
    // ------------------------------------------------------------------

    public function test_tp34_login_ditolak_jika_turnstile_gagal(): void
    {
        config(['services.turnstile.secret' => self::SECRET_SELALU_GAGAL]);

        $komponen = $this->loginLewatHalaman($this->adminA->email, self::SANDI_LAMA_A, self::TOKEN_DUMMY)
            ->assertHasErrors(['turnstile_token' => 'turnstile']);

        $this->assertSame('Verifikasi keamanan gagal, silakan coba lagi.', $komponen->errors()->first('turnstile_token'));
        $this->assertGuest();
    }

    public function test_tp34_login_ditolak_tanpa_token_turnstile(): void
    {
        $komponen = $this->loginLewatHalaman($this->adminA->email, self::SANDI_LAMA_A, token: '')
            ->assertHasErrors(['turnstile_token' => 'required']);

        $this->assertSame('Silakan centang verifikasi keamanan.', $komponen->errors()->first('turnstile_token'));
        $this->assertGuest();
    }

    public function test_tp34_login_berhasil_jika_turnstile_lolos_dan_kredensial_benar(): void
    {
        $this->loginLewatHalaman($this->adminA->email, self::SANDI_LAMA_A, self::TOKEN_DUMMY)
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($this->adminA);
    }

    // ------------------------------------------------------------------
    // Tambahan: formulir tamu publik dari langkah 1 sampai submit
    // ------------------------------------------------------------------

    public function test_tambahan_formulir_tamu_publik_dengan_avatar_tersimpan_ke_instansi_a(): void
    {
        $jumlahB = Guest::where('perangkat_daerah_id', $this->pdB->id)->count();

        $this->isiFormulirTamu('Budi Santoso', fn ($form) => $form
            ->set('foto_metode', 'avatar')
            ->set('selectedAvatar', 'guest-man.png'));

        $tamu = Guest::where('nama', 'Budi Santoso')->sole();
        $this->assertSame($this->pdA->id, (int) $tamu->perangkat_daerah_id);
        $this->assertSame('images/avatars/guest-man.png', $tamu->foto);
        $this->assertNotNull($tamu->signatureDataUri());
        $this->assertSame($jumlahB, Guest::where('perangkat_daerah_id', $this->pdB->id)->count());
    }

    public function test_tambahan_formulir_tamu_publik_dengan_foto_kamera_tersimpan_ke_instansi_a(): void
    {
        Storage::fake('public');

        $this->isiFormulirTamu('Siti Aminah', fn ($form) => $form
            ->set('jenis_kelamin', 'Perempuan')
            ->set('foto_metode', 'kamera')
            ->set('foto_base64', $this->gambarDataUri('jpeg')));

        $tamu = Guest::where('nama', 'Siti Aminah')->sole();
        $this->assertSame($this->pdA->id, (int) $tamu->perangkat_daerah_id);
        $this->assertStringEndsWith('.jpg', $tamu->foto);
        Storage::disk('public')->assertExists($tamu->foto);
    }

    // ------------------------------------------------------------------
    // Helper
    // ------------------------------------------------------------------

    private function buatTamu(PerangkatDaerah $pd, string $nama): Guest
    {
        return Guest::create([
            'perangkat_daerah_id' => $pd->id,
            'nama' => $nama,
            'jenis_kelamin' => 'Laki-laki',
            'asal_instansi' => 'Instansi Uji',
            'keperluan' => 'Koordinasi',
            'foto' => 'images/avatars/guest-man.png',
            'ttd_digital' => $this->gambarDataUri('png'),
        ]);
    }

    /** Data URI gambar asli (dibuat dengan GD) untuk tanda tangan/foto. */
    private function gambarDataUri(string $jenis): string
    {
        $img = imagecreatetruecolor(160, 60);
        imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255));
        imageline($img, 10, 45, 150, 15, imagecolorallocate($img, 0, 0, 0));

        ob_start();
        $jenis === 'png' ? imagepng($img) : imagejpeg($img, null, 80);
        $biner = ob_get_clean();

        return "data:image/{$jenis};base64,".base64_encode($biner);
    }

    private function isiFormulirTamu(string $nama, callable $langkahFoto): void
    {
        $form = Livewire::test(GuestForm::class, ['slug' => $this->pdA->slug])
            ->assertSet('currentStep', 1)
            ->set('nama', $nama)
            ->set('jenis_kelamin', 'Laki-laki')
            ->set('asal_instansi', 'Universitas Brawijaya')
            ->set('keperluan', 'Koordinasi kegiatan')
            ->set('pesan_kesan', 'Pelayanan cepat')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2);

        $langkahFoto($form);

        $form->set('ttd_digital', $this->gambarDataUri('png'))
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 3)
            ->set('turnstile_token', self::TOKEN_DUMMY)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertDispatched('tamu-berhasil-disimpan');
    }

    private function loginLewatHalaman(string $username, string $password, ?string $token = self::TOKEN_DUMMY)
    {
        return Livewire::test(Login::class)
            ->set('turnstile_token', (string) $token)
            ->fillForm(['username' => $username, 'password' => $password])
            ->call('authenticate');
    }

    private function mintaTokenResetLewatHalaman(User $user): string
    {
        Livewire::test(RequestPasswordReset::class)
            ->fillForm(['email' => $user->email])
            ->call('request')
            ->assertHasNoErrors()
            ->assertNotified();

        $token = null;

        Notification::assertSentTo($user, FilamentResetPasswordNotification::class, function ($notifikasi) use (&$token) {
            $token = $notifikasi->token;

            return true;
        });

        $this->assertNotEmpty($token);

        return $token;
    }

    private function angkaTamuHariIni(): int
    {
        $widget = Livewire::test(AdminPdStats::class)->instance();
        $stats = (function () {
            return $this->getStats();
        })->call($widget);

        foreach ($stats as $stat) {
            if ($stat->getLabel() === 'Tamu Hari Ini') {
                return (int) $stat->getValue();
            }
        }

        $this->fail('Stat "Tamu Hari Ini" tidak ditemukan di widget AdminPdStats');
    }

    /** Membuat SVG QR dengan pengaturan yang sama seperti DepartmentDetail::mount(). */
    private function qrSvgUntuk(string $url): string
    {
        return (new Writer(new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd)))->writeString($url);
    }

    private function decodeQrSvg(string $svg): ?string
    {
        if (! is_executable('/usr/bin/rsvg-convert') || ! is_executable('/usr/bin/zbarimg')) {
            return null;
        }

        $svgFile = tempnam(sys_get_temp_dir(), 'qr').'.svg';
        $pngFile = tempnam(sys_get_temp_dir(), 'qr').'.png';
        file_put_contents($svgFile, $svg);

        exec('rsvg-convert -w 600 -h 600 -b white '.escapeshellarg($svgFile).' -o '.escapeshellarg($pngFile), $o, $rcRender);
        exec('zbarimg --raw -q '.escapeshellarg($pngFile), $hasil, $rcDecode);

        @unlink($svgFile);
        @unlink($pngFile);

        return ($rcRender === 0 && $rcDecode === 0) ? trim(implode("\n", $hasil)) : null;
    }
}
