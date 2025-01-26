<?php

use Illuminate\Support\Facades\Route;


/*
 * Login Ke Aplikasi
 * -------------------
 * Fungi: Halaman Login dan Proses Authentikasi
 * Tags: [View] [Action Login]
 * Role: - 
*/
Route::get('/', 'App\Http\Controllers\AuthController@viewLogin')->name('login');
Route::post('login', 'App\Http\Controllers\AuthController@login');


/*
 * Registrasi User Baru
 * -------------------
 * Fungi: Halaman registrasi penumpang agar dapat memesan tiket
 * Tags: [View] [Action Register]
 * Role: - 
*/
Route::get('register', 'App\Http\Controllers\AuthController@viewRegister')->name('register');
Route::post('register', 'App\Http\Controllers\AuthController@register');


/*
 * Logout dari Aplikasi
 * -------------------
 * Fungi: Hanya sebuah aksi untuk Logout
 * Tags: [Action Logout]
 * Role: - 
*/
Route::get('logout', 'App\Http\Controllers\AuthController@logout');








/*
 * Proteksi Auth + Role Admin
 * -------------------
 * Fungi: Hanya yang Memiliki Kredential + Role Admin yang bisa masuk
 * Tags: [auth] [role]
 * Role: [admin]
*/
//Route::middleware(['auth', 'role:admin'])->group(function () {
Route::middleware(['auth'])->group(function () {


    /*
     * Tampilan Awal Admin
     * -------------------
     * Fungi: Menampilkan table pengelolaan data Travel terdapat add, update, delete, tampil penumpang
     * Tags: [View] 
     * Role: [admin] 
    */
    Route::get('admin/home', 'App\Http\Controllers\Admin\TravelController@view')->name('admin.home');

   
    /*
     * Tambah Data Travel
     * -------------------
     * Fungi: Menambah Data Travel Baru
     * Tags: [View] [Action Add]
     * Role: [admin] 
    */
    Route::get('admin/home/add', 'App\Http\Controllers\Admin\TravelController@viewAdd');
    Route::post('admin/home/add', 'App\Http\Controllers\Admin\TravelController@add');



    /*
     * Edit Data Travel
     * -------------------
     * Fungi: Mengupdate Data Travel
     * Tags: [View] [Action Update]
     * Role: [admin] 
    */
    Route::get('admin/home/update/{id}', 'App\Http\Controllers\Admin\TravelController@viewUpdate');
    Route::put('admin/home/update/{id}', 'App\Http\Controllers\Admin\TravelController@update');


    /*
     * Delete Data Travel
     * -------------------
     * Fungi: Menghapus Data Travel
     * Tags: [View] [Action Delete]
     * Role: [admin] 
    */
    Route::delete('admin/home/delete/{id}', 'App\Http\Controllers\Admin\TravelController@delete')->name('admin.home.delete');


    /*
     * Lihat Daftar Pemesanan Travel
     * -------------------
     * Fungi: Menlihat Daftar Salah Satu Data Travel
     * Tags: [View] [Action Detail]
     * Role: [admin] 
    */
    Route::get('admin/home/penumpang/{id}', 'App\Http\Controllers\Admin\TravelController@viewPenumpang');


    /*
     * Konfirmasi Pembayaran
     * -------------------
     * Fungi: Melihat daftar yang melakukan konfirmasi pembayaran dan ada Action Konfirmasi
     * Tags: [View] [Action Update]
     * Role: [admin] 
    */
    Route::get('admin/pemesanan', 'App\Http\Controllers\Admin\PemesananController@view')->name('admin.pemesanan');
    Route::put('admin/pemesanan/konfirmasi/{id}', 'App\Http\Controllers\Admin\PemesananController@konfirmasi')->name('admin.pemesanan.konfirmasi');


}); // End Proteksi Auth + Role Admin





/*
 * Proteksi Auth + Role Penumpang
 * -------------------
 * Fungi: Hanya yang Memiliki Kredential + Role Penumpang yang bisa masuk
 * Tags: [auth] [role]
 * Role: [penumpang]
*/
//Route::middleware(['auth', 'role:penumpang'])->group(function () {
Route::middleware(['auth'])->group(function () {




    /*
     * Tampilan Awal Penumpang
     * -------------------
     * Fungi: Menampilkan Daftar Travel terdapat opsi Pilih Travel
     * Tags: [View] [Action Add]
     * Role: [penumpang] 
    */
    Route::get('penumpang/home', 'App\Http\Controllers\Penumpang\TravelController@view')->name('penumpang.home');
    Route::put('penumpang/home/{id}', 'App\Http\Controllers\Penumpang\TravelController@pilih')->name('penumpang.home.pilih');



    /*
     * Tampilan Riwayat Pesanan
     * -------------------
     * Fungi: Menampilkan Daftar Travel yang Telah di Booking baik telah di konfirmasi dan sudah dikonfirmasi
     * Tags: [View] [Action Upload] [Action Cetak]
     * Role: [penumpang] 
    */
    Route::get('penumpang/riwayat', 'App\Http\Controllers\Penumpang\PemesananController@view')->name('penumpang.riwayat');
    Route::get('penumpang/riwayat/upload/{id}', 'App\Http\Controllers\Penumpang\PemesananController@viewUpload');
    Route::post('penumpang/riwayat/upload/{id}', 'App\Http\Controllers\Penumpang\PemesananController@upload');
    Route::get('penumpang/riwayat/invoice/{id}', 'App\Http\Controllers\Penumpang\PemesananController@viewInvoice');



}); // End Proteksi Auth + Role Penumpang

