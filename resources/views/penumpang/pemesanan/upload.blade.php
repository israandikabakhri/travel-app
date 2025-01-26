@extends('layout.layout') 

@section('title_bar')
 Upload Bukti Bayar
@endsection

@section('content') 
        

        <div class="row">
              
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Upload Bukti Bayar</h4>
                    <p class="card-description"> Pembayaran Travel yang Anda Pilih </p>
                            
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" method="POST" accept="{{ url('/') }}/penumpang/riwayat/upload/{{ $id }}" enctype="multipart/form-data">
                       @csrf
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="file" class="file-upload-default">
                        <div class="input-group col-xs-12 d-flex align-items-center">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Bukti Bayar">
                          <span class="input-group-append ms-2">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="{{ url('/penumpang/riwayat') }}" class="btn btn-danger">Cancel</a>
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