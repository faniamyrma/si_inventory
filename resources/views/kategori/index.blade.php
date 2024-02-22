@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>DAFTAR KATEGORI BARANG</h2>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>KATEGORI</th>
                            <th>JENIS</th>
                            <th style="width: 15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 0 @endphp
                        @foreach ($rsetKategori as $kategori)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $kategori->kategori }}</td>
                                <td>{{ $kategori->jenis }}</td>
                                
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                        <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($rsetKategori->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">Data kategori belum tersedia!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $rsetKategori->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
