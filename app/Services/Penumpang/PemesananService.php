<?php
namespace App\Services\Penumpang;

use App\Models\Penumpang as PenumpangModel; 
use Auth;
use DB;

class PemesananService
{
    public static function getIdPemesanan()
    {
        $penumpang = PenumpangModel::where('user_id', auth()->id())->first();

        return $penumpang->id;
    }

    public static function getRiwayatPemesanan()
    {
                
        $data = DB::select(
                    "
                    SELECT
                        
                        b.id, a.tujuan_travel, a.tgl, a.waktu, a.kouta, a.harga_tiket,
                        
                        CASE 
                            WHEN b.status = true THEN 'Lunas' 
                            ELSE 'Belum Bayar' 
                        END AS status,

                        CASE WHEN b.doc_confirm IS NULL 
                            THEN 'Belum Upload' 
                            ELSE 'Sudah Upload' 
                        END AS doc_confirm,
                        
                        to_char(b.created_at, 'DD MonthYYYY hh:ii:ss') waktu_pesan

                    FROM public.tb_travel AS a
                    LEFT JOIN public.tb_pemesanan AS b ON a.id = b.id_travel
                    WHERE b.id_penumpang = :passengerId
                    ", 
                    [':passengerId' => self::getIdPemesanan()]
                );
        return $data;

    }

    public static function getPemesananDetail($id)
    {
                
        $data = DB::select(
                    "
                    SELECT 
                      CASE 
                        WHEN c.jenkel = 'L' THEN CONCAT('Mr. ',c.nama)
                        WHEN c.jenkel = 'P' THEN CONCAT('Mrs.',c.nama)
                        ELSE '- '
                      END as nama,
                      to_char(a.created_at, 'DD MonthYYYY hh:ii:ss') waktu_pesan,
                      b.tujuan_travel,
                      CONCAT(
                        to_char(b.tgl, 'DD MonthYYYY'), ' ', b.waktu
                      ) waktu_berangkat, 
                      b.harga_tiket
                    FROM public.tb_pemesanan a
                    LEFT JOIN public.tb_travel b ON a.id_travel = b.id
                    LEFT JOIN public.tb_penumpang c ON a.id_penumpang = c.id
                    WHERE a.id = :pesananId
                    ", 
                    [':pesananId' => $id]
                );
        return $data;

    }

}
