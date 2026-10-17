<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder {
  public function run(): void { // 8 slot tim placeholder; ganti lewat admin
    for ($i = 1; $i <= 8; $i++) { $n = sprintf('%02d', $i);
      DB::table('team_members')->insert(['name'=>"[NAMA_ANGGOTA_$n]", 'position'=>"[JABATAN_$n]", 'photo'=>"assets/images/team/team-$n.jpg", 'sort_order'=>$i]); }
  }
}
