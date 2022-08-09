<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username')->unique();
            $table->string('api_token');
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });
        $pass = Hash::make('12345678');
        
       DB::table('users')->insert([
        'firstname' => 'super',
        'lastname' => 'admin',
        'username' => 'admin',
        'password' => $pass,
        'api_token' => base64_encode($pass),
        'is_admin' => true,
       ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
