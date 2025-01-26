<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        /*
         * Membuat tabel users
         * 
        */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'penumpang'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });

        /*
         * Menambahkan data ke tabel users
         *
        */
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });



        /**
         * Membuat tabel tb_travel
         *
        */
        Schema::create('tb_travel', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan_travel');
            $table->date('tgl');
            $table->time('waktu');
            $table->integer('kouta');
            $table->decimal('harga_tiket', 10, 2);
            $table->timestamps();
        });

        DB::table('tb_travel')->insert([
            'tujuan_travel' => 'Bali',
            'tgl' => '2025-02-09',
            'waktu' => '10:00:00',
            'kouta' => 2,
            'harga_tiket' => 500000,
        ]);

        DB::table('tb_travel')->insert([
            'tujuan_travel' => 'Jogjakarta',
            'tgl' => '2025-02-11',
            'waktu' => '10:00:00',
            'kouta' => 2,
            'harga_tiket' => 1240000,
        ]);
        

        /**
         * Membuat tabel tb_penumpang
         *
        */
        Schema::create('tb_penumpang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenkel', ['L', 'P']);
            $table->text('alamat');
            $table->integer('user_id');
            $table->timestamps();
        });

      /**
        * Membuat tabel tb_pemesanan
        */
        Schema::create('tb_pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_travel')->constrained('tb_travel')->onDelete('cascade');
            $table->foreignId('id_penumpang')->constrained('tb_penumpang')->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->string('doc_confirm')->nullable();
            $table->timestamps();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('tb_travel');
        Schema::dropIfExists('tb_penumpang');
        Schema::dropIfExists('tb_pemesanan');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }

};
