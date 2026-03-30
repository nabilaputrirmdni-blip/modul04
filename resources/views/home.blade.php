<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        /* HERO */
        .hero {
            background: url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da') center/cover;
            height: 250px;
            border-radius: 15px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .hero::before {
            content: "";
            position: absolute;
            background: rgba(0,0,0,0.6);
            width: 100%;
            height: 100%;
            border-radius: 15px;
        }

        .hero-content {
            position: relative;
            text-align: center;
        }

        /* CARD */
        .book-card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .book-img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD Books Laravel</a>

        <div class="ms-auto d-flex align-items-center">

            <a href="{{ route('home') }}" class="text-white me-3 text-decoration-none">Home</a>
            <a href="{{ route('books.index') }}" class="text-white me-3 text-decoration-none">Books</a>
            <a href="{{ route('categories.index') }}" class="text-white me-3 text-decoration-none">Categories</a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link text-white p-0 text-decoration-none">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero mb-4">
        <div class="hero-content">
            <h2 class="fw-bold">Sistem Perpustakaan</h2>
            <p>Kelola buku Anda dengan mudah</p>
        </div>
    </div>

    <!-- TITLE -->
    <h4 class="text-center fw-bold mb-4">Koleksi Buku</h4>

    <!-- BOOK LIST -->
    <div class="row">

        @foreach($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card book-card shadow-sm">

                {{-- GAMBAR --}}
                @if($book->gambar && file_exists(public_path('images/'.$book->gambar)))
                    <img src="{{ asset('images/'.$book->gambar) }}" 
                    class="book-img">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" 
                    class="book-img">
                @endif

                <div class="card-body text-center">
                    <h6 class="fw-bold">{{ $book->judul }}</h6>

                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">
                        Detail
                    </a>
                </div>

            </div>
        </div>
        @endforeach

    </div>

</div>

</body>
</html>