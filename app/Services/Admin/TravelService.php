<?php
namespace App\Services\Admin;
 
use DB;

class TravelService
{

    public static function getDetailPenumpang($id_travel)
    {
                
        $data = DB::select(
                    "
                         SELECT
                            
                             a.id, a.tujuan_travel, 
                             
                             CONCAT(
                                to_char(a.tgl, 'DD MonthYYYY'), ' ', a.waktu
                             ) waktu_berangkat, 
                             
                             a.kouta, a.harga_tiket,
                            
                            CASE 
                                WHEN b.status = true THEN 'Lunas' 
                                ELSE 'Menunggu Pembayaran' 
                            END AS status,

                            CASE WHEN b.doc_confirm IS NULL 
                                THEN 'Belum Upload' 
                                ELSE 'Sudah Upload' 
                            END AS doc_confirm,
                            
                            to_char(b.created_at, 'DD MonthYYYY hh:ii:ss') waktu_pesan,
                            c.nama,
                            c.alamat,

                            CASE 
                                WHEN c.jenkel = 'L' THEN 'Mr.'
                                WHEN c.jenkel = 'P' THEN 'Mrs.'
                                ELSE '- '
                            END as jenkel

                        FROM public.tb_travel AS a
                        LEFT JOIN public.tb_pemesanan AS b ON a.id = b.id_travel
                        LEFT JOIN public.tb_penumpang AS c ON b.id_penumpang = c.id
                        WHERE a.id = :travelId
                    ", 
                    [':travelId' => $id_travel]
                );
        return $data;

    }

   
}
