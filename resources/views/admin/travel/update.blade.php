@extends('layout.layout') 

@section('title_bar')
 Update Data Travel
@endsection

@section('content') 
        

        
        <div class="row">
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tambah Data</h4>
                    <p class="card-description"> Menambahkan Data Travel Baru </p>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" method="POST" accept="{{ url('/') }}/admin/home/update">
                       @csrf
                       @method('PUT')
                      <div class="form-group">
                        <label for="Tujuan">Tujuan</label>
                        <input type="text" class="form-control form-control-sm" name="tujuan_travel" id="Tujuan" required placeholder="Masukkan Tujuan.." value="{{ $data->tujuan_travel }}">
                      </div>
                      <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" class="form-control form-control-sm" name="tgl" id="Tanggal" required placeholder="Masukkan Tanggal.." value="{{ $data->tgl }}">
                      </div>
                      <div class="form-group">
                        <label for="Waktu">Waktu</label>
                        <input type="time" class="form-control form-control-sm" name="waktu" id="Waktu" required placeholder="Masukkan Waktu.." value="{{ $data->waktu }}">
                      </div>
                      <div class="form-group">
                        <label for="Kouta">Kouta</label>
                        <input type="number" class="form-control form-control-sm" name="kouta" id="Kouta" required placeholder="Masukkan Kouta.." value="{{ $data->kouta }}">
                      </div>
                      <div class="form-group">
                        <label for="Hargatiket">Harga Tiket</label>
                        <input type="number" class="form-control form-control-sm" name="harga_tiket" required id="Hargatiket" placeholder="Masukkan Harga Tiket.." value="{{ $data->harga_tiket }}">
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="{{ url('/admin/home') }}" class="btn btn-danger">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
              
            
            </div>

            
@endsection



@section('css')
@endsection


@section('js')
@endsection