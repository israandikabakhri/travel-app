@extends('layout.layout') 

@section('title_bar')
 Daftar Penumpang
@endsection

@section('content') 
        

        <div class="row">
              
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Daftar Penumpang</h4>
                    <p class="card-description"> 
                      Tujuan <b>{{ $datas[0]->tujuan_travel }}</b> dengan Waktu Keberangkatan 
                             <b>{{ $datas[0]->waktu_berangkat }}</b> 
                             @if($sisa_kouta > 0)
                              <label class="badge badge-danger">Tersisa {{ $sisa_kouta }} Kouta</label>
                             @else
                               <label class="badge badge-danger">Kouta Habis</label>
                             @endif
                    </p>
                    <a href="{{ url('/') }}/admin/home" class="btn btn-warning btn-sm"> < Kembali</a>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Waktu Pemesanan</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($datas as $data)
                          <tr>
                            <td>{{ $data->jenkel }} {{ $data->nama }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>
                                @if($data->status == "Menunggu Pembayaran") 
                                 <label class="badge badge-danger">{{ $data->status }}</label>
                                @else   
                                 <label class="badge badge-success">{{ $data->status }}</label>  
                                @endif
                            </td>
                            <td>{{ $data->waktu_pesan }}</td>
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