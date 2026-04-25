<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // Pakai username, jangan email
            $table->string('password');
            $table->string('password_plain')->nullable(); 
            $table->string('role')->default('siswa'); 
            $table->string('gender')->nullable();
            $table->string('class')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        
        // Bagian password_reset_tokens dan sessions di bawahnya biarkan saja
    }

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->renameColumn('username', 'email');
    });
}
};
