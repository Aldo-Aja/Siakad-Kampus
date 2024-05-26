<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Added this line
use App\Models\ProgramStudy; // Added this line
use Illuminate\Support\Facades\File; // Added this line
use App\Http\Requests\mahasiswa\MahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_mahasiswa = Mahasiswa::with('program_study')->get();

        return view('mahasiswa.mahasiswa.index', compact('data_mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        if($request->validated()) {
            $photo = $request->file('photo')->store(
                'mahasiswa/photo', 'public'
            );
            Mahasiswa::create($request->except('photo') + ['photo' => $photo]);
        }

        return redirect()->route('admin.mahasiswa.index')->with([
            'message' => 'berhasil dibuat !', // Updated success message
            'alert-type' => 'success'
        ]);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $program_studies = ProgramStudy::get(['id', 'nama_prody']);

        return view('mahasiswa.mahasiswa.edit', compact('mahasiswa','program_studies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        if($request->validated()) {
            if($request->photo) {
                File::delete('storage/'. $mahasiswa->photo);
                $photo = $request->file('photo')->store(
                    'mahasiswa/photo', 'public'
                );
                $mahasiswa->update($request->except('photo') + ['photo' => $photo]);
            } else {
                $mahasiswa->update($request->validated());
            }
        }

        return redirect()->route('admin.mahasiswa.index')->with([
            'message' => 'berhasil diganti !', // Updated success message
            'alert-type' => 'info'
        ]);
    }
}