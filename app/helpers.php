<?php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

function settings(): array {
  static $s = null; if ($s !== null) return $s; $s = [];
  try { $s = DB::table('site_settings')->pluck('v', 'k')->all(); } catch (Throwable $x) { Log::error($x->getMessage()); }
  return $s;
}
/** Config dasar (config/tamandayu.php + .env) ditimpa pengaturan dari admin bila terisi. */
function cfg(): array {
  static $c = null;
  if ($c === null) { $c = config('tamandayu'); $s = settings();
    foreach (['whatsapp','email','address'] as $k) if (!empty($s[$k])) $c['contact'][$k] = $s[$k];
    foreach (['linktree','instagram','tiktok','facebook','youtube','documentation'] as $k) if (!empty($s[$k])) $c['links'][$k] = $s[$k]; }
  return $c;
}
function wa_link(?string $num, string $msg=''): ?string {
  $d = preg_replace('/\D+/', '', (string)$num);
  if ($d === '') return null;
  if ($d[0] === '0') $d = '62'.substr($d, 1);
  if (strlen($d) < 9 || strlen($d) > 15) return null;
  return 'https://wa.me/'.$d.($msg ? '?text='.rawurlencode($msg) : '');
}
function mail_link(?string $m): ?string { return ($m && filter_var($m, FILTER_VALIDATE_EMAIL)) ? 'mailto:'.$m : null; }
function ext_url(?string $u): ?string { return ($u && preg_match('#^https?://#i', $u) && filter_var($u, FILTER_VALIDATE_URL)) ? $u : null; }
function img(?string $path): ?string { return ($path && is_file(public_path($path))) ? url($path) : null; }
function btn(string $label, ?string $href, string $cls='btn', string $track='', bool $ext=true): string {
  if (!$href) return '<span class="'.e($cls).' is-disabled" aria-disabled="true" title="Kontak belum dikonfigurasi">'.e($label).'</span>';
  return '<a class="'.e($cls).'" href="'.e($href).'" data-track="'.e($track).'"'.($ext && str_starts_with($href, 'http') ? ' target="_blank" rel="noopener noreferrer"' : '').'>'.e($label).'</a>';
}
function rows(string $sql, array $fallback): array {
  try { $r = array_map(fn($o) => (array)$o, DB::select($sql)); if ($r) return $r; } catch (Throwable $x) { Log::error($x->getMessage()); }
  return $fallback;
}
function get_team(): array {
  $manual = []; // data manual dari config/tim.php (prioritas jika ada nama yang diisi)
  foreach (config('tim', []) as $m) if (trim((string)($m['nama'] ?? '')) !== '')
    $manual[] = ['name'=>$m['nama'], 'position'=>$m['jabatan'] ?? '', 'photo'=>$m['foto'] ?? null, 'whatsapp'=>$m['whatsapp'] ?? '', 'email'=>$m['email'] ?? ''];
  if ($manual) return array_slice($manual, 0, 8);
  $f = []; for ($i=1;$i<=8;$i++) { $n = sprintf('%02d',$i); $f[] = ['name'=>"[NAMA_ANGGOTA_$n]",'position'=>"[JABATAN_$n]",'photo'=>"assets/images/team/team-$n.jpg",'whatsapp'=>'','email'=>'','slot'=>"FOTO_SALES_$n"]; }
  return rows("SELECT name,position,photo,whatsapp,email FROM team_members WHERE is_active=1 ORDER BY sort_order,id LIMIT 8", $f);
}
function get_events(): array {
  $f = []; for ($i=1;$i<=8;$i++) { $n = sprintf('%02d',$i); $f[] = ['title'=>'[NAMA_EVENT]','event_date'=>'[TANGGAL_EVENT]','category'=>'[KATEGORI_EVENT]','cover'=>"assets/images/events/event-$n.jpg",'description'=>'[DESKRIPSI_EVENT]','link'=>'','placeholder'=>1,'slot'=>"FOTO_EVENT_$n"]; }
  $r = rows("SELECT title,event_date,category,cover,description,link FROM events WHERE is_published=1 ORDER BY sort_order,event_date DESC", []);
  if (!$r) return $f;
  return array_map(function ($e) { $t = $e['event_date'] ? strtotime($e['event_date']) : false;
    $e['upcoming'] = $t && $t >= strtotime('today') ? 1 : 0; $e['event_date'] = $t ? date('d M Y', $t) : ''; return $e; }, $r);
}
function get_gallery(): array {
  $f = []; for ($i=1;$i<=6;$i++) { $n = sprintf('%02d',$i); $f[] = ['photo'=>"assets/images/gallery/gallery-$n.jpg",'caption'=>'[KETERANGAN_FOTO]','placeholder'=>1,'slot'=>"FOTO_GALERI_$n"]; }
  return rows("SELECT photo,caption FROM gallery_items WHERE is_published=1 ORDER BY sort_order,id", $f);
}
function photo(array $r, string $key, string $alt, string $slot): string {
  if ($s = img($r[$key] ?? null)) return '<img src="'.e($s).'" alt="'.e($alt).'" loading="lazy" width="800" height="600">';
  return '<div class="ph" role="img" aria-label="'.e($alt).'"><span>'.e($r['slot'] ?? $slot).'</span></div>';
}
function logo_html(bool $light=false): string {
  if ($l = img(settings()['logo'] ?? null)) return '<img class="logo-img" src="'.e($l).'" alt="Taman Dayu Golf Club &amp; Resort" height="44">';
  return '<span class="logo-ph'.($light ? ' light' : '').'">[LOGO TAMAN DAYU]</span>';
}
function video_embed(?string $u): ?array {
  $u = ext_url($u); if (!$u) return null;
  if (preg_match('#(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/))([A-Za-z0-9_-]{11})#', $u, $m)) return ['type'=>'yt','src'=>'https://www.youtube-nocookie.com/embed/'.$m[1].'?autoplay=1&rel=0'];
  if (preg_match('#\.(mp4|webm)(\?.*)?$#i', $u)) return ['type'=>'file','src'=>$u];
  return null;
}
/** Upload aman: MIME asli, isi gambar, maks 5 MB; resize 2400px + konversi WebP (GD), koreksi EXIF. */
function store_image(?UploadedFile $f, string $dir): ?string {
  if (!$f) return null;
  if (!$f->isValid() || $f->getSize() > 5*1024*1024) throw new RuntimeException('Upload gagal atau file lebih dari 5 MB.');
  $tmp = $f->getRealPath(); $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);
  $ext = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'][$mime] ?? null;
  if (!$ext || !@getimagesize($tmp)) throw new RuntimeException('Hanya JPG, PNG, atau WebP yang diizinkan.');
  $rel = "assets/images/$dir/".bin2hex(random_bytes(10));
  if (function_exists('imagewebp')) {
    $im = match ($mime) { 'image/jpeg'=>@imagecreatefromjpeg($tmp), 'image/png'=>@imagecreatefrompng($tmp), default=>@imagecreatefromwebp($tmp) };
    if ($im) {
      if ($mime === 'image/jpeg' && function_exists('exif_read_data') && ($ex = @exif_read_data($tmp)) && ($deg = [3=>180,6=>-90,8=>90][$ex['Orientation'] ?? 1] ?? 0)) { if ($r = imagerotate($im, $deg, 0)) $im = $r; }
      if (imagesx($im) > 2400 && ($r = imagescale($im, 2400))) $im = $r;
      imagepalettetotruecolor($im); imagealphablending($im, false); imagesavealpha($im, true);
      if (!imagewebp($im, public_path("$rel.webp"), 82)) throw new RuntimeException('Gagal mengonversi gambar ke WebP.');
      return "$rel.webp";
    }
  }
  copy($tmp, public_path("$rel.$ext")); return "$rel.$ext";
}
