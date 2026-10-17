<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
  public function up(): void {
    Schema::create('team_members', function (Blueprint $t) {
      $t->id(); $t->string('name', 120); $t->string('position', 120); $t->string('photo')->nullable(); $t->string('whatsapp', 32)->nullable(); $t->string('email', 160)->nullable();
      $t->boolean('is_active')->default(true); $t->integer('sort_order')->default(0); $t->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); });
    Schema::create('events', function (Blueprint $t) {
      $t->id(); $t->string('title', 160); $t->string('slug', 180)->nullable()->unique(); $t->date('event_date')->nullable(); $t->string('category', 80)->nullable(); $t->string('cover')->nullable();
      $t->text('description')->nullable(); $t->string('link')->nullable(); $t->boolean('is_published')->default(false); $t->integer('sort_order')->default(0); });
    Schema::create('gallery_items', function (Blueprint $t) {
      $t->id(); $t->string('photo'); $t->string('caption')->nullable(); $t->string('category', 80)->nullable(); $t->boolean('is_published')->default(false); $t->integer('sort_order')->default(0); });
    Schema::create('site_settings', function (Blueprint $t) { $t->string('k', 80)->primary(); $t->text('v')->nullable(); });
    Schema::create('inquiries', function (Blueprint $t) {
      $t->id(); $t->string('name', 120); $t->string('company', 120)->nullable(); $t->string('contact', 160); $t->string('topic', 120)->nullable(); $t->text('message');
      $t->enum('status', ['new','contacted','closed'])->default('new'); $t->char('ip_hash', 64)->nullable(); $t->timestamp('created_at')->useCurrent(); });
  }
  public function down(): void { foreach (['inquiries','site_settings','gallery_items','events','team_members'] as $t) Schema::dropIfExists($t); }
};
