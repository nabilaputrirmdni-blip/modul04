<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');
        $categories = Category::all();
        // search
        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        // filter kategori
        if (!empty($request->category_id)) {
        $query->where('category_id', $request->category_id);
        }
        $books = $query->get();
        $totalBooks = Book::count();
        $totalPerCategory = Book::selectRaw('category_id, COUNT(*) as total')
                        ->groupBy('category_id')
                        ->pluck('total', 'category_id');
        // KIRIM categories ke view
        return view('books.index', compact('books','categories', 'totalBooks', 'totalPerCategory'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $file = $request->file('gambar');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $namaFile);

            $data['gambar'] = $namaFile;
        }

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success','Data berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $file = $request->file('gambar');
            $namaFile = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $namaFile);

            $data['gambar'] = $namaFile;
        } else {
            $data['gambar'] = $book->gambar;
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                ->with('success','Data berhasil dihapus');
    }
}
