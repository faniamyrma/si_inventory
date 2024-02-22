<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Barangmasuk;
use App\Models\Kategori;

class BarangMasukController extends Controller
{
    public function index()
    {
        $rsetBarangmasuk = Barangmasuk::with('barang')->latest()->paginate(10);

        return view('barangmasuk.index', compact('rsetBarangmasuk'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $abarang = Barang::all();
        return view('barangmasuk.create',compact('abarang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required|numeric',
            'barang_id' => 'required|not_in:blank',
        ]);

        Barangmasuk::create([
            'tgl_masuk'             => $request->tgl_masuk,
            'qty_masuk'             => $request->qty_masuk,
            'barang_id'           => $request->barang_id,   
        ]);

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetBarangmasuk = Barangmasuk::find($id);
        return view('barangmasuk.show', compact('rsetBarangmasuk'));
    }

    public function edit(string $id)
    {
        $abarang = Barang::all();
        $rsetBarangmasuk = Barangmasuk::find($id);
        $selectedBarang = Barang::find($rsetBarangmasuk->barang_id);

        return view('barangmasuk.edit', compact('rsetBarangmasuk', 'abarang', 'selectedBarang'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_masuk'    => 'required',
            'qty_masuk'    => 'required',
            'barang_id'     => 'required|not_in:blank',
        ]);

        $rsetBarangmasuk = Barangmasuk::find($id);

        $rsetBarangmasuk->update([
            'tgl_masuk'    => $request->tgl_masuk,
            'qty_masuk'    => $request->qty_masuk,
            'barang_id'     => $request->barang_id
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $rsetBarangmasuk = Barangmasuk::find($id);

        //delete post
        $rsetBarangmasuk->delete();

        //redirect to index
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
