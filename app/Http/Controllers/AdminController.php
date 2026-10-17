<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log};
class AdminController extends Controller {
  const RES = [
    'team'=>['Tim Sales & Marketing (maks. 8 aktif tampil)','team_members','photo','team','sort_order,id',
      ['name'=>['Nama lengkap','text'],'position'=>['Jabatan','text'],'whatsapp'=>['WhatsApp (mis. 0812xxxx atau 62812xxxx)','text'],'email'=>['Email','email'],'sort_order'=>['Urutan','number'],'is_active'=>['Aktif','check']]],
    'events'=>['Event','events','cover','events','sort_order,event_date DESC',
      ['title'=>['Judul event','text'],'event_date'=>['Tanggal','date'],'category'=>['Kategori','text'],'description'=>['Deskripsi singkat','textarea'],'link'=>['Tautan detail (opsional)','url'],'sort_order'=>['Urutan','number'],'is_published'=>['Tampilkan di website','check']]],
    'gallery'=>['Galeri Dokumentasi','gallery_items','photo','gallery','sort_order,id',
      ['caption'=>['Keterangan foto','text'],'category'=>['Kategori','text'],'sort_order'=>['Urutan','number'],'is_published'=>['Tampilkan di website','check']]],
  ];
  const SETTINGS = ['whatsapp'=>['WhatsApp utama (mis. 0812xxxx)','t'],'email'=>['Email resmi departemen','e'],'address'=>['Alamat resmi','t'],
    'linktree'=>['URL Linktree','u'],'instagram'=>['URL Instagram','u'],'tiktok'=>['URL TikTok','u'],'facebook'=>['URL Facebook','u'],'youtube'=>['URL YouTube','u'],'documentation'=>['URL dokumentasi','u'],
    'video_url'=>['URL video hero (YouTube atau .mp4/.webm; kosong = tombol video disembunyikan)','u'],
    'hero_title_en'=>['Judul hero (English)','t'],'hero_desc_en'=>['Deskripsi hero (English)','a'],'hero_title_id'=>['Judul hero (Indonesia)','t'],'hero_desc_id'=>['Deskripsi hero (Indonesia)','a']];

  public function loginForm() { return view('admin.login'); }
  public function login(Request $r) {
    if (Auth::attempt($r->only('email', 'password'))) { $r->session()->regenerate(); return redirect()->route('admin.inquiries'); }
    return back()->with('err', 'Email atau password salah.');
  }
  public function logout(Request $r) { Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken(); return redirect()->route('login'); }

  public function inquiries() { return view('admin.inquiries', ['rows'=>DB::table('inquiries')->orderByDesc('id')->limit(200)->get()]); }
  public function status(Request $r) {
    if (in_array($r->status, ['new','contacted','closed'], true)) DB::table('inquiries')->where('id', (int)$r->id)->update(['status'=>$r->status]);
    return redirect()->route('admin.inquiries');
  }

  public function index(Request $r, string $res) {
    [$title, $table, $photo, $dir, $order, $f] = self::RES[$res];
    $edit = $r->query('edit') ? DB::table($table)->where('id', (int)$r->query('edit'))->first() : null;
    return view('admin.crud', ['res'=>$res,'title'=>$title,'f'=>$f,'photo'=>$photo,'edit'=>$edit,'rows'=>DB::table($table)->orderByRaw($order)->get()]);
  }
  public function save(Request $r, string $res) {
    [, $table, $photo, $dir, , $f] = self::RES[$res]; $id = (int)$r->input('id');
    try {
      $v = [];
      foreach ($f as $c=>$m) { $x = trim((string)$r->input($c, ''));
        if ($m[1]==='check') $x = $r->has($c) ? 1 : 0; elseif ($m[1]==='number') $x = (int)$x;
        elseif ($m[1]==='date' && $x==='') $x = null;
        elseif ($m[1]==='url' && $x!=='' && !ext_url($x)) throw new \RuntimeException('URL harus diawali http:// atau https://');
        elseif ($m[1]==='email' && $x!=='' && !filter_var($x, FILTER_VALIDATE_EMAIL)) throw new \RuntimeException('Format email tidak valid.');
        $v[$c] = $x; }
      if ($photo && ($p = store_image($r->file($photo), $dir))) $v[$photo] = $p;
      if ($id) DB::table($table)->where('id', $id)->update($v); else DB::table($table)->insert($v);
    } catch (\RuntimeException $x) { return back()->with('err', $x->getMessage()); }
    catch (\Throwable $x) { Log::error($x->getMessage()); return back()->with('err', 'Gagal menyimpan. Pastikan kolom wajib terisi (galeri wajib punya foto).'); }
    return redirect()->route('admin.crud', $res)->with('ok', 'Tersimpan.');
  }
  public function destroy(Request $r, string $res) { DB::table(self::RES[$res][1])->where('id', (int)$r->input('id'))->delete(); return redirect()->route('admin.crud', $res); }

  public function settings() { return view('admin.settings', ['f'=>self::SETTINGS,'cur'=>DB::table('site_settings')->pluck('v', 'k')->all()]); }
  public function saveSettings(Request $r) {
    try {
      $v = [];
      foreach (self::SETTINGS as $k=>$m) { $x = trim((string)$r->input($k, ''));
        if ($m[1]==='u' && $x!=='' && !ext_url($x)) throw new \RuntimeException($m[0].': harus diawali http:// atau https://');
        if ($m[1]==='e' && $x!=='' && !filter_var($x, FILTER_VALIDATE_EMAIL)) throw new \RuntimeException('Format email tidak valid.');
        $v[$k] = $x; }
      foreach (['logo','hero_image'] as $u) if ($p = store_image($r->file($u), 'hero')) $v[$u] = $p;
      foreach ($v as $k=>$x) DB::table('site_settings')->updateOrInsert(['k'=>$k], ['v'=>$x]);
    } catch (\RuntimeException $x) { return back()->with('err', $x->getMessage()); }
    catch (\Throwable $x) { Log::error($x->getMessage()); return back()->with('err', 'Gagal menyimpan pengaturan.'); }
    return back()->with('ok', 'Pengaturan tersimpan.');
  }
}
