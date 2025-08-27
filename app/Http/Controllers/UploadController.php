<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = Upload::latest()->paginate(10);
        return view('upload.index', compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);

        $file = $request->file('file');

        try {
            $path = $file->store('excel_uploads', 'public');
            
            Excel::import(new PegawaiImport, storage_path('app/public/' . $path));

            Upload::create([
                'original_filename' => $file->getClientOriginalName(),
                'stored_filename'   => basename($path),
                'file_path'         => $path,
                'file_size'         => $file->getSize(),
                'status'            => 'completed',
            ]);

            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diimpor dari Excel.');
        
        } catch (ValidationException $e) {
            $failures = $e->failures();
            return back()->with('import_errors', $failures);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
