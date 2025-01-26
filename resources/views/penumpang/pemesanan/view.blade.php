@extends('layout.layout') 

@section('title_bar')
 Riwayat Pemesanan Tiket
@endsection

@section('content') 
      
        
          <div class="row">
              
              
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Riwayat Pemesanan Tiket</h4>
                    </p>
                          
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Tujuan </th>
                            <th> Waktu </th>
                            <th> Harga Tiket </th>
                            <th> Status </th>
                            <th> Bukti Pembeyaran </th>
                            <th> Cetak Invoice </th>
                            <th> Waktu Pesan </th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($datas as $d)
                          <tr>
                            <td>{{ $d->tujuan_travel }}</td>
                            <td>{{ date('d F Y', strtotime($d->tgl)) }} {{ $d->waktu }}</td>
                            <td>Rp. {{ number_format($d->harga_tiket) }},-</td>
                            <td>
                                @if($d->status == "Belum Bayar") 
                                 <label class="badge badge-danger">{{ $d->status }}</label>
                                @else   
                                 <label class="badge badge-success">{{ $d->status }}</label>  
                                @endif
                            </td>
                            <td>
                                @if($d->doc_confirm == "Belum Upload") 
                                 <a href="{{ url('penumpang/riwayat/upload') }}/{{ $d->id }}" class="btn btn-danger btn-sm">{{ $d->doc_confirm }}</a>
                                @else   
                                 <label class="badge badge-success">{{ $d->doc_confirm }}</label> 
                                @endif
                            </td>
                            <td>
                                @if($d->status != "Belum Bayar" && $d->doc_confirm != "Belum Upload") 
                                 <a href="{{ url('penumpang/riwayat/invoice') }}/{{ $d->id }}" target="_blank" class="btn btn-success btn-sm">Cetak Invoice</a>
                                @else   
                                 <label class="badge badge-success">Invoice Tidak Tersedia</label> 
                                @endif
                            </td>
                            <td>{{ $d->waktu_pesan }}</td>
                          </tr>
                          @endforeach


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

             
            </div>


@endsection



@section('css')
@endsection


@section('js')
@endsection