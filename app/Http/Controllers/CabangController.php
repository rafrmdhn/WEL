<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabang = Cabang::latest()->paginate(10);
        return view('cabang.index', compact('cabang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_cabang' => 'required|unique:cabangs|max:10',
            'nama_cabang' => 'required|max:255',
        ]);

        Cabang::create($validated);

        return redirect()->route('cabang.index')->with('success', 'Data cabang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cabang $cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabang $cabang)
    {
        return view('cabang.edit', compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabang $cabang)
    {
        $validated = $request->validate([
            'kode_cabang' => ['required', 'max:10', Rule::unique('cabangs')->ignore($cabang->id)],
            'nama_cabang' => 'required|max:255',
        ]);

        $cabang->update($validated);

        return redirect()->route('cabang.index')->with('success', 'Data cabang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabang $cabang)
    {
        try {
            $cabang->delete();
            return redirect()->route('cabang.index')->with('success', 'Data cabang berhasil dihapus.');
        } catch (QueryException $e) {
            // Menangkap error foreign key constraint
            return redirect()->route('cabang.index')->with('error', 'Data cabang tidak dapat dihapus karena masih digunakan oleh data pegawai.');
        }
    }
}
