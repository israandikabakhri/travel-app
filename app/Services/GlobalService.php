<?php
namespace App\Services;

use App\Models\Travel;
use App\Models\Pemesanan;

class GlobalService
{
    public static function getSisaKuotaTravel(int $travelId)
    {
        $travel = Travel::find($travelId);
        if (!$travel) {
            return null; // Atau berikan pesan error
        }

        $totalPemesanan = Pemesanan::where('id_travel', $travelId)->count();
        $sisaKuota = $travel->kouta - $totalPemesanan;

        return $sisaKuota;
    }
}