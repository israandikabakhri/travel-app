<?php
namespace App\Http\Controllers\Penumpang;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Penumpang as PenumpangModel; 
use App\Models\Pemesanan as PemesananModel; 
use App\Services\Penumpang\PemesananService;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{

    public function view(){

        // Memanggil service 
        $datas = PemesananService::getRiwayatPemesanan();

        // Menampilkan hasil service ke view
        return view('penumpang.pemesanan.view', compact('datas'));

    }

    public function viewUpload($id)
    {
        // memanggil view dan melempar $id kedalamnya
        return view('penumpang.pemesanan.upload', compact('id'));
    }

   

    public function upload(Request $request, $id)
    {
        // validasi upload file
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048|file'
        ]);

        // Memeriksa ketersediaan data
        $pemesanan = PemesananModel::find($id);

        // Jika ketersediaan data tidak ada maka rederice back() dan berikan pesan error
        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Pemesanan tidak ditemukan');
        }

        // Hapus file lama jika ada
        if ($pemesanan->doc_confirm) {
            Storage::delete('public/uploads/' . $pemesanan->doc_confirm);
        }

        // Mendefenisikan file
        $file = $request->file('file');

        // Memberikan nama file
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Menaruh ke storage public
        $filePath = $file->storeAs($fileName);

        // Update infromasi ke table Pemesanan dengna field 'doc_confirm' sesuai Nama file diatas
        $pemesanan->doc_confirm = $filePath;

        // Simpan Perubaha
        $pemesanan->save();

        // redirec dan berikan pesan success dan informasi nama file
        return redirect()->route('penumpang.riwayat')
                      ->with('success', 'File berhasil diunggah!')
                      ->with('file', Storage::url($filePath)); // Link ke file
    }



    public function viewinvoice($id)
    {

        // Memanggil service 
        $data = PemesananService::getPemesananDetail($id);


        // memanggil view dan melempar $id kedalamnya
        return view('penumpang.pemesanan.invoice', compact('data'));
    }


}