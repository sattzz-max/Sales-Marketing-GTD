<?php
namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateAdmin extends Command {
  protected $signature = 'admin:create {email} {password}';
  protected $description = 'Buat atau perbarui akun admin (password min. 10 karakter)';
  public function handle(): int {
    if (strlen($this->argument('password')) < 10) { $this->error('Password minimal 10 karakter.'); return self::FAILURE; }
    User::updateOrCreate(['email'=>$this->argument('email')], ['name'=>'Admin','password'=>Hash::make($this->argument('password'))]);
    $this->info('Admin siap. Login di /admin/login'); return self::SUCCESS;
  }
}
