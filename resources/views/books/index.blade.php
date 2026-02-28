@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Data Book</h3>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah</a>
</div>

{{-- FORM SEARCH --}}
<form method="GET" action="{{ route('books.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <input type="text" name="search" 
                   class="form-control"
                   placeholder="Cari judul..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary">Cari</button>
        </div>

        <div class="mb-3">
            <strong>Total Buku per Kategori:</strong>
            <ul>
                @foreach($categories as $category)
                    <li>
                        {{ $category->nama_kategori }} :
                        {{ $totalPerCategory[$category->id] ?? 0 }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</form>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
<div class="alert alert-info">
    Total Buku: <strong>{{ $totalBooks }}</strong>
</div>
@endif

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $key => $book)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>
                        <span class="badge bg-info">{{ $book->stok }}</span>
                    </td>
                    <td>
                        <a href="{{ route('books.edit',$book->id) }}" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('books.destroy',$book->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
