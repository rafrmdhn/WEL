<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Pegawai::with(['cabang', 'jabatan']);

        $query->when($search, function ($q, $search) {
            $q->where('nama_pegawai', 'like', "%{$search}%")
              ->orWhere('kode_pegawai', 'like', "%{$search}%")
            
            ->orWhereHas('cabang', function ($query) use ($search) {
                $query->where('nama_cabang', 'like', "%{$search}%");
            })
            
            ->orWhereHas('jabatan', function ($query) use ($search) {
                $query->where('nama_jabatan', 'like', "%{$search}%");
            });
        });

        $pegawai = $query->latest()->paginate(10)->appends(['search' => $search]);

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cabang = Cabang::all();
        $jabatan = Jabatan::all();
        return view('pegawai.create', compact('cabang', 'jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pegawai' => 'required|unique:pegawais,kode_pegawai|max:10',
            'nama_pegawai' => 'required|max:255',
            'kode_cabang' => 'required|exists:cabangs,kode_cabang', 
            'kode_jabatan' => 'required|exists:jabatans,kode_jabatan',
            'tanggal_mulai_kontrak' => 'required|date',
            'tanggal_habis_kontrak' => 'required|date|after_or_equal:tanggal_mulai_kontrak',
        ]);

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $cabang = Cabang::all();
        $jabatan = Jabatan::all();
        return view('pegawai.edit', compact('pegawai', 'cabang', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'kode_pegawai' => ['required', 'max:10', Rule::unique('pegawais', 'kode_pegawai')->ignore($pegawai->kode_pegawai, 'kode_pegawai')],
            'nama_pegawai' => 'required|max:255',
            'kode_cabang' => 'required|exists:cabangs,kode_cabang',
            'kode_jabatan' => 'required|exists:jabatans,kode_jabatan',
            'tanggal_mulai_kontrak' => 'required|date',
            'tanggal_habis_kontrak' => 'required|date',
        ]);

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
