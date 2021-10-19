<?php

namespace App\Http\Controllers;

use App\Exports\Death\DeathExport;
use App\Exports\Death\DeathTemplateExport;
use App\Imports\Death\DeathImport;
use App\Models\Death;
use App\Models\Resident;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class DieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Death::get();

        if (request()->get('religion') && request()->get('religion') != null ) {
            $data=$data->where('religion','=',request()->get('religion'));
        }

        if (request()->get('gender') && request()->get('gender') != null ) {
            $data=$data->where('gender','=',request()->get('gender'));
        }

        if (request()->get('kewarganegaraan') && request()->get('kewarganegaraan') != null ) {
            $data=$data->where('kewarganegaraan','=',request()->get('kewarganegaraan'));
        }

        $dies = $data->all();

        return view('pages.penduduk.kematian.die', compact('dies'));
    }

    public function resetFilter()
    {
        return redirect()->route('dies.index');
    }

    public function diePrint()
    {
        $diePrint = Death::get();

        return view('pages.penduduk.kematian.print', compact('diePrint'));
    }

    public function deathExport()
    {
        return Excel::download(new DeathExport,'Kematian.xlsx');
    }

     public function template()
    {
        return Excel::download(new DeathTemplateExport,'Kematian Template.xlsx');
    }

    public function dieImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataKematian', $nameFile);

        Excel::import(new DeathImport, public_path('/DataKematian/'.$nameFile));

        Alert::success('Success', 'Data Kematian Berhasil Diimport!');
        return redirect()->route('dies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dieCreate = Death::get();
        $residents = Resident::doesntHave('deaths')->get();
        return view('pages.penduduk.kematian.create', compact('dieCreate','residents'));
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
            'place' => 'required|max:225',
            'date' => 'required',
            'time' => 'required',
            'age' => 'required',
            'penyebab' => 'nullable',
        ]);

        $residents = Resident::find($request->resident_id);
         $data['NIK'] = $residents->NIK;
         $data['name'] = $residents->name;
         $data['gender'] = $residents->gender;
         $data['place_birth'] = $residents->place_birth;
         $data['birth_date'] = $residents->birth;
         $data['job'] = $residents->job;
         $data['religion'] = $residents->religion;
         $data['citizenship'] = $residents->kewarganegaraan;

        Death::create($data);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('dies.index');
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
        $dieEdit = Death::find($id);
        $residents = Resident::doesntHave('deaths')->get();

        return view('pages.penduduk.kematian.edit', compact('dieEdit','residents'));
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
        $die = Death::find($id);
        $data = $request->all();
        $request->validate([
            'resident_id' => 'required',
            'place' => 'required|max:225',
            'date' => 'required',
            'time' => 'required',
            'age' => 'required',
            'penyebab' => 'nullable',
        ]);

        $residents = Resident::find($request->resident_id);
        $data['name'] = $residents->name;
        $data['NIK'] = $residents->NIK;
        $data['gender'] = $residents->gender;
        $data['place_birth'] = $residents->place_birth;
        $data['date_birth'] = $residents->birth;
        $data['job'] = $residents->job;
        $data['religion'] = $residents->religion;
        $data['citizenship'] = $residents->kewarganegaraan;

        $die->update($data);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('dies.index');
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
        alert()->warning('Peringatan !','Anda yakin akan menghapus semua data ? ')
        ->showConfirmButton('<a href="die/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $die = Death::select('NIK', 'id')->whereId($id)->firstOrFail();;

        $die->delete();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return redirect()->route('dies.index');
    }

    public function konfirmasiAll()
    {
        alert()->warning('Peringatan !','Anda yakin akan menghapus semua data ? ')
        ->showConfirmButton('<a href="die/deleteAll" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function deleteAllDeath()
    {
        Death::truncate();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return back()->with('berhasil','Data berhasil dihapus');
    }
}
