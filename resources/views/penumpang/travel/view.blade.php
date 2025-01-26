@extends('layout.layout') 

@section('title_bar')
 Pilih Jadwal
@endsection

@section('content') 
      
        
          <div class="row">
              
              
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pilih Jadwal Travel</h4>
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Tujuan </th>
                            <th> Waktu </th>
                            <th> Sisa Kouta </th>
                            <th> Harga Tiket </th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($travels as $d)
                          <tr>
                            <td>{{ $d->tujuan_travel }}</td>
                            <td>{{ date('d F Y', strtotime($d->tgl)) }} {{ $d->waktu }}</td>
                            <td>{{ $d->sisa_kuota }}</td>
                            <td>Rp. {{ number_format($d->harga_tiket) }},-</td>
                            <td>

                              <form id="pilih-form-{{ $d->id }}" action="{{ route('penumpang.home.pilih', $d->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('PUT')
                                  <button type="button" class="btn btn-primary" onclick="confirmPilihIni({{ $d->id }})">
                                      <i class="icon-check menu-icon"></i> Pilih Ini
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