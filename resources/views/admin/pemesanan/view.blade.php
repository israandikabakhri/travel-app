@extends('layout.layout') 

@section('title_bar')
 Konfirmasi Pembayaran
@endsection

@section('content') 
      
        
          <div class="row">
              
              
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Konfirmasi Pembayaran</h4>
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
                            <th> Waktu Berangkat </th>
                            <th> Penumpang </th>
                            <th> Harga Tiket </th>
                            <th> Waktu Booking </th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($datas as $d)
                          <tr>
                            <td>{{ $d->tujuan_travel }}</td>
                            <td>{{ $d->waktu_berangkat }}</td>
                            <td>{{ $d->jenkel }} {{ $d->nama }}</td>
                            <td>Rp. {{ number_format($d->harga_tiket) }},-</td>
                            <td>{{ $d->waktu_pesan }}</td>
                            <td>
                              <a href="{{ asset('storage/' . $d->doc_confirm) }}" target="_blank" class="btn btn-primary"><i class="icon-eye menu-icon"></i> Lihat Bukti</a>


                              <form id="konfirmasi-form-{{ $d->id_pemesanan }}" action="{{ route('admin.pemesanan.konfirmasi', $d->id_pemesanan) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <button type="button" class="btn btn-success" onclick="confirmPembayaran({{ $d->id_pemesanan }})">
                                      <i class="icon-check menu-icon"></i> Hapus
                                  </button>
                              </form>

                            </td>
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