<?php
namespace App\Services\Admin;
 
use DB;

class PemesananService
{

    public static function getListKonfirmasiPembayaran()
    {
                
        $data = DB::select(
                    "
                     SELECT 
                         a.id id_pemesanan, 
                         
                         b.tujuan_travel,  
                         CONCAT(
                           to_char(b.tgl, 'DD MonthYYYY'), ' ', b.waktu
                         ) waktu_berangkat, 
                         
                         b.kouta, b.harga_tiket,
                         
                         CASE 
                            WHEN c.jenkel = 'L' THEN 'Mr.'
                            WHEN c.jenkel = 'P' THEN 'Mrs.'
                            ELSE '- '
                         END as jenkel,
                         c.nama,
                         
                         to_char(a.created_at, 'DD MonthYYYY hh:ii:ss') waktu_pesan,
                         a.doc_confirm
                        FROM public.tb_pemesanan a
                        LEFT JOIN public.tb_travel b ON a.id_travel = b.id
                        LEFT JOIN public.tb_penumpang c ON a.id_penumpang = c.id
                        WHERE a.status = false
                        AND   a.doc_confirm IS NOT NULL
                    "
                );
        return $data;

    }

   
}
