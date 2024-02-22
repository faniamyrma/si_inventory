<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Barangkeluar;
use App\Models\Kategori;

class BarangkeluarController extends Controller
{
    public function index()
    {
        $rsetBarangkeluar = Barangkeluar::with('barang')->latest()->paginate(10);

        return view('barangkeluar.index', compact('rsetBarangkeluar'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $abarang = Barang::all();
        return view('barangkeluar.create',compact('abarang'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_keluar' => 'required',
            'qty_keluar' => 'required|numeric',
            'barang_id' => 'required|not_in:blank',
        ]);

        Barangkeluar::create([
            'tgl_keluar'             => $request->tgl_keluar,
            'qty_keluar'             => $request->qty_keluar,
            'barang_id'                => $request->barang_id,    
        ]);

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Barang keluar Berhasil Disimpan!']);
    }

    public function show(string $id)
    {
        $rsetBarangkeluar = Barangkeluar::find($id);
        return view('barangkeluar.show', compact('rsetBarangkeluar'));
    }

    public function edit(string $id)
    {
        $abarang = Barang::all();
        $rsetBarangkeluar = Barangkeluar::find($id);
        $selectedBarang = Barang::find($rsetBarangkeluar->Barang_id);

        return view('barangkeluar.edit', compact('rsetBarangkeluar', 'abarang', 'selectedBarang'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'tgl_keluar'    => 'required',
            'qty_keluar'    => 'required',
            'barang_id'     => 'required|not_in:blank',
        ]);

        $rsetBarangkeluar = Barangkeluar::find($id);

        $rsetBarangkeluar->update([
            'tgl_keluar'    => $request->tgl_keluar,
            'qty_keluar'    => $request->qty_keluar,
            'barang_id'     => $request->barang_id
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $rsetBarangkeluar = Barangkeluar::find($id);
        //delete post
        $rsetBarangkeluar->delete();

        //redirect to index
        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
