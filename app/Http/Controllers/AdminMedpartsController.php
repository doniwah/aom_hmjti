<?php

namespace App\Http\Controllers;

use App\Models\Medpart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminMedpartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medparts = Medpart::all();
        return view('pages.admin.medpart.medparts',compact('medparts'));
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
        $validated = $request->validate([
            'nama_medpart' => 'required',
            'logo'=>'required|file|image|mimes:jpeg,jpg,png|max:1024',
        ]);
        $logo = $validated['logo'];
        $name = $validated['nama_medpart'];
        $filename = uniqid().".".$logo->extension();
        $dtUpload = new Medpart;
        $dtUpload->name = $name;
        $dtUpload->logo = $request->file('logo')->store('medpart','public');
        $save=$dtUpload->save();
        if ($save) {
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->route('admin.medpart');
        }else{
            toast('Data gagal ditambahkan!', 'error');
            return redirect()->route('admin.medpart');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medpart = Medpart::find($id);
        return view('pages.admin.medpart.editmedparts',compact('medpart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medparts = Medpart::findOrFail($id);

        $dataupdate = [
            'name' => $request->name,
        ];

        if ($request->hasFile('logo')) {
            $existingLogo = $medparts->logo;
            if (!empty($existingLogo)) {
                Storage::disk('local')->delete($existingLogo);
            }

            $picture = uniqid() . '.' . $request->logo->extension();
            $dataupdate['logo'] = $request->file('logo')->store('sponsor');
        }

        $save = $medparts->update($dataupdate);

        if ($save) {
            toast('Data berhasil diubah!', 'success');
            return redirect()->route('admin.medpart');
        } else {
            toast('Data gagal diubah!', 'error');
            return back()->withInput();
        }
    }
    public function destroy(string $id)
    {
        $delete = Medpart::destroy($id);
        if ($delete) {
            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('admin.medpart');
        }else{
            toast('Gagal', 'error');
            return redirect()->route('admin.medpart');
        }
    }
}
