<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Travel as TravelModel; 
use App\Models\Penumpang as PenumpangModel; 
use App\Services\GlobalService;
use App\Services\Admin\TravelService;
use Illuminate\Http\Request;


class TravelController extends Controller
{

    public function view()
    {

        // Mengambil semua data dalam table Travel
        //$datas = TravelModel::all();

        // menampilkan view
        //return view('admin.travel.view', compact('datas'));

       

        // Memanggil hasil One to Many antara tb_travel dan tb_pemesanan
        $travels = TravelModel::with('getpemesanan')->get();

        // Tindakan tambahan untuk menyelipkan sisa_kouta sebelum kirim ke view
        foreach ($travels as $travel) {
            $globalService = new GlobalService();
            $sisaKuota = $globalService->getSisaKuotaTravel($travel->id);
            $travel->sisa_kuota = $sisaKuota;
        }

        // Mengirimkan hasil ke view
        return view('admin.travel.view', compact('travels'));

    }


    public function viewAdd()
    {

        // menampilkan view
        return view('admin.travel.add');

    }

    public function add(Request $request)
    {

        // Validasi Request
         $validatedData = $request->validate([
            'tujuan_travel' => 'required|string|max:255',
            'tgl' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'kouta' => 'required|integer|min:1',
            'harga_tiket' => 'required|numeric|min:0',
         ]);

         // Simpan data ke database
         TravelModel::create($validatedData);

         // Redirect dengan pesan sukses
         return redirect()->route('admin.home')
                          ->with('success', 'Data Travel berhasil ditambahkan.');

    }

    public function viewUpdate($id)
    {

        // Fetch travel data using a model or repository
        $data = TravelModel::findOrFail($id); 

        // Handle potential record not found scenario
        if (!$data) {
            return abort(404, 'Travel record not found'); 
        }

        return view('admin.travel.update', compact('data'));

    }

    public function update(Request $request, $id)
    {

        // validasi request
        $request->validate([
            'tujuan_travel' => 'required|string|max:255',
            'tgl' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'kouta' => 'required|integer|min:1',
            'harga_tiket' => 'required|numeric|min:0',
        ]);

        // Mengecek Ketersediaan data
        $travel = TravelModel::findOrFail($id);

        // Jalankan fungsi update date
        $travel->update($request->all());

        // Redirect dan berikan pesan success
        return redirect()->route('admin.home')
                         ->with('success', 'Data Travel berhasil diupdate.');

    }


    public function delete($id)
    {
        
        // Mengecek Ketersediaan data
        $data = TravelModel::findOrFail($id);

        // Jalankan fungsi delete date
        $data->delete();

        // Redirect dan berikan pesan success
        return redirect()->back()->with('success', 'Data berhasil dihapus');

    }



    public function viewPenumpang($id)
    {

        // memanggil service
        $datas = TravelService::getDetailPenumpang($id);

        // memanggil Global service
        $sisa_kouta = GlobalService::getSisaKuotaTravel($id);

        // menampilkan hasil ke view
        return view('admin.travel.penumpang', compact('datas', 'sisa_kouta'));

    }


}