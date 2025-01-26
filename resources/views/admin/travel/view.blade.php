@extends('layout.layout') 

@section('title_bar')
 Kelola Data Travel
@endsection

@section('content') 
          

          <div class="row">
              
              
             <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Kelola Data Travel</h4>
                    <a href="{{ url('/admin/home/add') }}" class="btn btn-success"><i class="icon-plus menu-icon"></i> Tambah Travel</a>
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
                            <th> Tanggal </th>
                            <th> Waktu </th>
                            <th> Kouta </th>
                            <th> Sisa Kouta </th>
                            <th> Harga Tiket </th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($travels as $d)
                          <tr>
                            <td>{{ $d->tujuan_travel }}</td>
                            <td>{{ date('d F Y', strtotime($d->tgl)) }}</td>
                            <td>{{ $d->waktu }}</td>
                            <td>{{ $d->kouta }}</td>
                            <td>
                                @if($d->sisa_kuota > 0)
                                <label class="badge badge-success"> Terisa {{ $d->sisa_kuota }} </label>
                                @else
                                <label class="badge badge-danger">Habis</label>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($d->harga_tiket) }},-</td>
                            <td>
                              <a href="{{ url('/admin/home/penumpang') }}/{{ $d->id }}" class="btn btn-primary"><i class="icon-head menu-icon"></i> Detail Penumpang</a>
                              <a href="{{ url('/admin/home/update') }}/{{ $d->id }}" class="btn btn-warning"><i class="icon-eye menu-icon"></i> Edit</a>

                              <form id="delete-form-{{ $d->id }}" action="{{ route('admin.home.delete', $d->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $d->id }})">
                                      <i class="icon-trash menu-icon"></i> Hapus
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