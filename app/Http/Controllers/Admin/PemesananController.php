<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Pemesanan as PemesananModel;
use App\Services\Admin\PemesananService as PemesananService;


class PemesananController extends Controller
{

    public function view(){

        // memanggil service
        $datas = PemesananService::getListKonfirmasiPembayaran();

        // menampilkan hasil dari service ke view
        return view('admin.pemesanan.view', compact('datas'));

    }

    public function konfirmasi($id)
    {
        
        // Query untuk mencari Pemesanan status belum bayar
        PemesananModel::where('id', $id)
                      ->update(['status' => true]);

        // redirect dan berikan pesan success
        return redirect()->route('admin.pemesanan')
                         ->with('success', 'Berhasil Konfirmasi Pembayaran!');
    }


}