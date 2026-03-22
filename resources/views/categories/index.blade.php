@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">🏷️ Data Kategori</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-success shadow">
            + Tambah Kategori
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow border-0 p-3">
                <h6 class="text-muted">Total Kategori</h6>
                <h2 class="fw-bold">{{ $categories->count() }}</h2>
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- CARD CATEGORY --}}
    <div class="row">

        @foreach($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 h-100 book-card text-center p-4">

                {{-- ICON --}}
                <h1>🏷️</h1>

                <div class="card-body">
                    <h5 class="fw-bold">{{ $category->nama_kategori }}</h5>
                    <p class="text-muted">Kategori buku</p>
                </div>

                <div class="card-footer bg-white border-0">

                    <a href="{{ route('categories.edit',$category->id) }}"
                       class="btn btn-warning btn-sm w-100 mb-2">
                       Edit
                    </a>

                    <form action="{{ route('categories.destroy',$category->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100"
                            onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>

                </div>

            </div>
        </div>
        @endforeach

    </div>

</div>

{{-- STYLE --}}
<style>
.book-card {
    transition: 0.3s;
    border-radius: 15px;
}

.book-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
</style>

@endsection