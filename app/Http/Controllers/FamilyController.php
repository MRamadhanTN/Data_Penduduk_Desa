<?php

namespace App\Http\Controllers;

use App\Exports\Family\FamilyExport;
use App\Exports\Family\FamilyTemplateExport;
use App\Imports\Family\FamilyImport;
use App\Models\Family;
use App\Models\FamilyDetail;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::get();
        $Detail = FamilyDetail::orderBy('hubungan')->get();
        return view('pages.penduduk.keluarga.family', compact('families','Detail'));
    }

    public function familyPrint()
    {
        $familyPrint = Family::get();

        return view('pages.penduduk.keluarga.print', compact('familyPrint'));
    }

    public function familyExport()
    {
        return Excel::download(new FamilyExport,'Keluarga.xlsx');
    }

    public function template()
    {
        return Excel::download(new FamilyTemplateExport,'Keluarga Template.xlsx');
    }

    public function familyImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataKeluarga', $nameFile);

        Excel::import(new FamilyImport, public_path('/DataKeluarga/'.$nameFile));

		Alert::success('Success', 'Data Penduduk Berhasil Diimport!');

        return redirect()->route('families.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $family = Family::get();
        $residents = Resident::doesntHave('families')->where('gender','Pria')->whereNotIn('status',['Pelajar'])->get();
        return view('pages.penduduk.keluarga.create',compact('family','residents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required',
            'no_kk' => 'required|min:16|max:16|unique:families,no_kk',
        ]);

        $residents = Resident::find($request->resident_id);
        $data['NIK'] = $residents->NIK;
        $data['kepala_keluarga'] = $residents->name;

        $family = Family::create($data);

        $update['family_id'] = $family->id;
        $update['no_kk'] = $request->no_kk;
        $update['kepala_keluarga'] = 'Kepala Keluarga';
        $residents->update($update);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('families.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $families = Family::find($id);
        $residents = Resident::doesntHave('families')->where('gender','Pria')->whereNotIn('status',['Pelajar'])->get();

        return view('pages.penduduk.keluarga.edit', compact('families', 'residents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $family = Family::find($id);
        $data = $request->validate([
            'resident_id' => 'required',
            'no_kk' => 'required|min:16|max:16|unique:families,no_kk,'.$family->id.'',
        ]);

        $resident = Resident::find($request->resident_id);
        $data['NIK'] = $resident->NIK;
        $data['kepala_keluarga']=$resident->name;
        $family->update($data);

        $replace = Resident::find($request->replace);
        $reupdate['family_id'] = NULL;
        $reupdate['kepala_keluarga'] = NULL;
        $reupdate['no_kk'] = NULL;
        $replace->update($reupdate);

        $update['family_id'] = $family->id;
        $update['no_kk'] = $request->no_kk;
        $update['kepala_keluarga'] = 'Kepala Keluarga';
        $resident->update($update);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('families.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function konfirmasi($id)
    {
        alert()->warning('Peringatan !','Anda yakin akan menghapus data ? ')
        ->showConfirmButton('<a href="family/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $family = Family::select('no_kk', 'id')->whereId($id)->firstOrFail();

        $delFamily = Resident::where('family_id',$id)->get();
        $del = [
            'family_id' => NULL,
            'kepala_keluarga' => NULL,
            'no_kk' => NULL,
        ];
        foreach ($delFamily as $deaja) {
            $deaja->update($del);
        }

        $family->details()->delete();
        $family->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }

    public function deleteAllFamily()
    {
        $families = Family::whereNotNull('id')->firstOrFail();

        $families->delete();
        $families->details()->delete();

        // $delFamily = Resident::all();
        // $del = [
        //     'family_id' => NULL,
        //     'kepala_keluarga' => NULL,
        //     'no_kk' => NULL,
        // ];
        // foreach ($delFamily as $deaja) {
        //     $deaja->update($del);
        // }

        Alert::success('Success', 'Semua data berhasil dihapus');
        return back();
    }
}
