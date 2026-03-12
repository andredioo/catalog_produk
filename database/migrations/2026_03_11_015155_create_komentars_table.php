<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('komentars', function (Blueprint $table) {
        $table->id();
        $table->foreignId('foto_id')->constrained()->onDelete('cascade');
        $table->string('nama');
        $table->text('komentar');
        $table->text('balasan')->nullable(); // Pastikan kolom balasan ada di sini
        $table->timestamps();
    });
}
    public function down()
    {
        Schema::table('komentars', function (Blueprint $table) {
            $table->dropColumn('balasan');
        });
    }
};