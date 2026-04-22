<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return response()->json(['status' => true, 'message' => 'Berhasil mengambil data', 'data' => Book::all()]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer|min:1900',
            'stock' => 'required|integer|min:0',
        ]);
        $book = Book::create($request->all());
        return response()->json(['status' => true, 'message' => 'Buku berhasil ditambahkan', 'data' => $book], 201);
    }

    public function show($id) {
        $book = Book::find($id);
        if (!$book) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan', 'data' => null], 404);
        return response()->json(['status' => true, 'message' => 'Pesan', 'data' => $book]);
    }

    public function update(Request $request, $id) {
        $book = Book::find($id);
        if (!$book) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan', 'data' => null], 404);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer|min:1900',
            'stock' => 'required|integer|min:0',
        ]);
        $book->update($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil diupdate', 'data' => $book]);
    }

    public function destroy($id) {
        $book = Book::find($id);
        if (!$book) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan', 'data' => null], 404);
        $book->delete();
        return response()->json(['status' => true, 'message' => 'Data berhasil dihapus', 'data' => null]);
    }
}
