@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>TAMBAH KATEGORI</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <!-- Field-field lainnya -->

                            <!-- <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <select class="form-control" name="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($akategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JENIS</label>
                                <select class="form-control" name="jenis">
                                    <option value="">Pilih jenis</option>
                                    @foreach ($akategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->jenis }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            Field-field lainnya -->

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori') }}" placeholder="Masukkan Kategori...">
                           
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="font-weight-bold">JENIS</label>
                                <select class="form-control" name="jenis" aria-label="Default select example">
                                    <option value="A">Alat</option>
                                    <option value="M">Modal</option>
                                    <option value="BHP">Barang Habis Pakai</option>
                                    <option value="BTHP">Barang Tidak Habis Pakai</option>
                                </select>
                               
                                <!-- error message untuk kategori -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
