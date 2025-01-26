<?php
namespace App\Http\Controllers\Penumpang;

use App\Http\Controllers\Controller; 
use App\Models\Travel as TravelModel; 
use App\Models\Penumpang as PenumpangModel; 
use App\Models\Pemesanan as PemesananModel; 
use App\Services\GlobalService;
use Illuminate\Http\Request;

class TravelController extends Controller
{

    public function view(){

       // Memanggil hasil One to Many antara tb_travel dan tb_pemesanan
       $travels = TravelModel::with('getpemesanan')->get();

        // Tindakan tambahan untuk menyelipkan sisa_kouta sebelum kirim ke view
        foreach ($travels as $travel) {
            $globalService = new GlobalService();
            $sisaKuota = $globalService->getSisaKuotaTravel($travel->id);
            $travel->sisa_kuota = $sisaKuota;
        }

        // Mengirimkan hasil ke view
        return view('penumpang.travel.view', compact('travels'));

    }

    
    public function pilih($id){

        // Mencari data di tb_penumpang dengan user_id untuk mendapatkan id penumpang
        $penumpang = PenumpangModel::where('user_id', auth()->id())->first();

        // Memanggil Global service dan mendapatkan sisa kouta dari $id yg merupakan id Travel
        $globalService = new GlobalService();
        $sisaKuota = $globalService->getSisaKuotaTravel($id);
        
        // Jika sisa kouta Habis maka redirect back() dan berikan pesan error
        if ($sisaKuota <= 0) {
            return redirect()->back()->with('error', 'Maaf, kuota untuk perjalanan ini sudah habis.');
        }
        
        // Jika kouta masih tersedia maka Penumpang bisa mendapatkan pesanannya
        $pemesanan = new PemesananModel;
        $pemesanan->id_travel = $id;
        $pemesanan->id_penumpang = $penumpang->id;
        $pemesanan->save();

        // Redicet dan berikan pesan success
        return redirect()->route('penumpang.home')
                          ->with('success', 'Berhasil Booking Travel Tersebut, Anda Sisa Konfirmasi Pembayaran!');

    }

}