<?php

namespace App\Http\Controllers;

use App\Exports\Birth\BirthExport;
use App\Exports\Birth\BirthTemplateExport;
use App\Imports\Birth\BirthImport;
use App\Models\Birth;
use App\Models\Death;
use App\Models\FamilyDetail;
use App\Models\Family;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BirthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Birth::get();
        $dies = Death::get();

        if (request()->get('gender') && request()->get('gender') != null ) {
            $data=$data->where('gender','=',request()->get('gender'));
        }

        $births = $data->all();

        return view('pages.penduduk.kelahiran.birth', compact('births','dies'));
    }

    public function resetFilter()
    {
        return redirect()->route('births.index');
    }

    public function birthPrint()
    {
        $birthPrint = Birth::get();

        return view('pages.penduduk.kelahiran.print', compact('birthPrint',));
    }

    public function birthExport()
    {
        return Excel::download(new BirthExport,'Kelahiran.xlsx');
    }

    public function template()
    {
        return Excel::download(new BirthTemplateExport,'Kelahiran Template.xlsx');
    }

    public function birthImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataKelahiran', $nameFile);

        Excel::import(new BirthImport, public_path('/DataKelahiran/'.$nameFile));

		Alert::success('Success', 'Data Penduduk Berhasil Diimport!');

        return redirect()->route('births.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $birthCreate = Birth::doesntHave('detail')->get();
        $residents = Resident::doesntHave('families')->doesntHave('births')->doesntHave('detailsFamilies')->get();
        $families = Family::get();
        $details = FamilyDetail::where('hubungan', 'Ibu')->get();
        return view('pages.penduduk.kelahiran.create', compact('birthCreate','residents','families','details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'resident_id' => 'required',
            'weight' => 'required',
            'width' => 'required',
            'father' => 'nullable',
            'mother' => 'required',
        ]);

        // Merge Data Penduduk di Data Kelahiran
        $residents = Resident::find($request->resident_id);
        $data['name'] = $residents->name;
        $data['gender'] = $residents->gender;
        $data['birth'] = $residents->birth;
        $data['place_birth'] = $residents->place_birth;

        // Fitur Anak Yatim
        $families = Family::find($request->father);
        if ($request->father=='Tidak ada') {
            $data['father'] = 'Tidak ada';
        } else {
            $data['father'] = $families->kepala_keluarga;
            $data['family_id'] = $families->id;
        }

        // Merge data Ibu dari table FamilyDetail
        $details = FamilyDetail::find($request->mother);
        $data['mother'] = $details->resident;
        $data['detail_id'] = $details->id;

        FamilyDetail::create([
            'resident_id' => $request->resident_id,
            'family_id' => $request->father,
            'hubungan' => 'Anak',
            'no_kk' => $families->no_kk,
            'kepala_keluarga' => $families->kepala_keluarga,
            'resident' => $residents->name,
        ]);

        // Update data di Resident
        $update['family_id'] = $families->id;
        $update['no_kk'] = $families->no_kk;
        $update['kepala_keluarga'] = 'Anak';
        $residents->update($update);

        Birth::create($data);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('births.index');
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
        $birthEdit = Birth::find($id);
        $residents = Resident::doesntHave('families')->doesntHave('births')->doesntHave('detailsFamilies')->get();
        $families = Family::doesntHave('births')->get();
        $details = FamilyDetail::doesntHave('births')->where('hubungan', 'Ibu')->get();

        return view('pages.penduduk.kelahiran.edit', compact('birthEdit','residents','families','details'));
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
        $birth = Birth::find($id);
        // $resident = Resident::find($request->resident_id);
        // $family = Family::find($request->family_id);
        // $detail = FamilyDetail::find($request->detail_id);

        $data = $request->all();
        $request->validate([
            'resident_id' => 'required',
            'weight' => 'required',
            'width' => 'required',
            'father' => 'nullable',
            'mother' => 'required',
        ]);

        $residents = Resident::find($request->resident_id);
        $data['name'] = $residents->name;
        $data['gender'] = $residents->gender;
        $data['birth'] = $residents->birth;

        $families = Family::find($request->father);
        $data['father'] = $families->kepala_keluarga;
        $data['family_id'] = $families->id;

        $details = FamilyDetail::find($request->mother);
        $data['mother'] = $details->resident;
        $data['detail_id'] = $details->id;

        FamilyDetail::update([
            'resident_id' => $request->resident_id,
            'family_id' => $request->father,
            'hubungan' => 'Anak',
            'no_kk' => $families->no_kk,
            'kepala_keluarga' => $families->kepala_keluarga,
            'resident' => $residents->name,
        ]);

        $birth->update($data);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('births.index');
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
        ->showConfirmButton('<a href="birth/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $resident = Birth::select('name', 'id')->find($id)->firstOrFail();

        FamilyDetail::where('resident_id',$resident->resident_id)->delete();

        $resident->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('births.index');
    }

    public function deleteAllBirth()
    {
        $births = Birth::get();
        $births->delete();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return redirect()->route('births.index');
    }
}
