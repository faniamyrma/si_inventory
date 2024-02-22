<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KategoriController extends Controller
{
    public function index()
    {
        $rsetKategori = Kategori::latest()->paginate(10);

        return view('kategori.index', compact('rsetKategori'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $akategori = Kategori::all();
        return view('kategori.create', compact('akategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori'  => 'required',
            'jenis'     => 'required | in:M,A,BHP,BTHP',
        ]);

        Kategori::create([
            'kategori'  => $request->kategori,
            'jenis'  => $request->jenis,
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetKategori = Kategori::find($id);

        if ($rsetKategori) {
            return view('kategori.show', compact('rsetKategori'));
        } else {
            return redirect()->route('kategori.index')->with(['error' => 'Kategori tidak ditemukan']);
        }
    }

    public function edit(string $id)
    {
            $rsetKategori = Kategori::find($id);
            return view('kategori.edit', compact('rsetKategori'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'kategori' => 'required',
            'jenis' => 'required',       
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}