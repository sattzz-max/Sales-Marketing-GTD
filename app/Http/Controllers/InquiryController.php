<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Log, Validator};
class InquiryController extends Controller {
  public function submit(Request $r) {
    if ($r->filled('website')) return response()->json(['ok'=>true,'message'=>'Terima kasih.']); // honeypot
    $v = Validator::make($r->all(), [
      'name'=>'required|string|min:2|max:120', 'company'=>'nullable|string|max:120', 'topic'=>'nullable|string|max:120', 'message'=>'required|string|min:5|max:2000',
      'contact'=>['required','string','max:160', function ($a, $val, $fail) { if (!filter_var($val, FILTER_VALIDATE_EMAIL) && strlen(preg_replace('/\D/', '', $val)) < 9) $fail('Isi email atau nomor WhatsApp yang valid.'); }]],
      ['name.required'=>'Isi nama Anda.','name.min'=>'Isi nama Anda.','message.required'=>'Tulis kebutuhan Anda.','message.min'=>'Tulis kebutuhan Anda.','contact.required'=>'Isi email atau nomor WhatsApp yang valid.']);
    if ($v->fails()) return response()->json(['ok'=>false,'message'=>$v->errors()->first()], 422);
    try {
      DB::table('inquiries')->insert(['name'=>$r->name,'company'=>$r->company,'contact'=>$r->contact,'topic'=>$r->topic,'message'=>$r->message,'ip_hash'=>hash('sha256', $r->ip().date('Y-m'))]);
      return response()->json(['ok'=>true,'message'=>'Inquiry diterima. Tim kami akan menghubungi Anda.']);
    } catch (\Throwable $x) {
      Log::error('inquiry: '.$x->getMessage());
      return response()->json(['ok'=>false,'message'=>'Inquiry belum tersimpan karena gangguan sistem. Data Anda masih di formulir; coba lagi atau hubungi kami lewat WhatsApp.'], 503);
    }
  }
}
