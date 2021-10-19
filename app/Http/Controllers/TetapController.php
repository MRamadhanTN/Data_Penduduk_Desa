<?php

namespace App\Http\Controllers;

use App\Exports\Tetap\TetapExport;
use App\Exports\Tetap\TetapTemplateExport;
use App\Imports\TetapImport;
use App\Models\Death;
use App\Models\District;
use App\Models\Family;
use App\Models\Job;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Resident;
use App\Models\Village;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class TetapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Resident::where('category','Penduduk Tetap')->get();
        $dies = Death::get();

        $econ = Family::get();
        foreach ($econ as $family) {
            $families = $family;
        }

        if (request()->get('religion') && request()->get('religion') != null ) {
            $data=$data->where('religion','=',request()->get('religion'));
        }

        if (request()->get('gender') && request()->get('gender') != null ) {
            $data=$data->where('gender','=',request()->get('gender'));
        }

        if (request()->get('status') && request()->get('status') != null ) {
            $data=$data->where('status','=',request()->get('status'));
        }

        if (request()->get('kewarganegaraan') && request()->get('kewarganegaraan') != null ) {
            $data=$data->where('kewarganegaraan','=',request()->get('kewarganegaraan'));
        }

        if (request()->get('education') && request()->get('education') != null ) {
            $data=$data->where('education','=',request()->get('education'));
        }

        if (request()->get('blood_group') && request()->get('blood_group') != null ) {
            $data=$data->where('blood_group','=',request()->get('blood_group'));
        }

        $residents = $data->all();

        if ($econ->count()==0) {
            return view('pages.penduduk.penduduk tetap.tetap', compact('residents','econ','dies'));
        } else {
            return view('pages.penduduk.penduduk tetap.tetap', compact('residents','families','econ','dies'));
        }
    }

    public function resetFilter()
    {
        return redirect()->route('tetaps.index');
    }

    public function tetapPrint()
    {
        $tetapPrint = Resident::where('category','Penduduk Tetap')->get();

        return view('pages.penduduk.penduduk tetap.print', compact('tetapPrint',));
    }

    public function tetapExport()
    {
        return Excel::download(new TetapExport,'Penduduk_Tetap.xlsx');
    }
    public function template()
    {
        return Excel::download(new TetapTemplateExport,'Penduduk_Tetap_Template.xlsx');
    }

    public function tetapImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataPendudukTetap', $nameFile);

        Excel::import(new TetapImport, public_path('/DataPendudukTetap/'.$nameFile));

		Alert::success('Success', 'Data Penduduk Berhasil Diimport!');

        return redirect()->route('tetaps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $residentTetaps = Resident::find($id);
        $jobs = Job::get();
        $provinces = Province::get();
        $regencies = Regency::get();
        $districts = District::get();
        $villages = Village::get();
        return view('pages.penduduk.penduduk tetap.edit', compact('residentTetaps','jobs','provinces','regencies','districts','villages'));
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
        $resident = Resident::find($id);
        $data = $request->all();

        $request->validate([
            'NIK' => 'required|min:16|max:16',
            'name' => 'required|max:225',
            'place_birth' => 'required|max:225',
            'birth' => 'required|date',
            'job_id' => 'required',
            'job'  => 'nullable',
            'gender' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'address' => 'required',
            'provinces_id' => 'required',
            'provinces' => 'nullable',
            'regencies_id' => 'required',
            'regencies' => 'nullable',
            'districts_id' => 'required',
            'districts' => 'nullable',
            'villages_id' => 'required',
            'villages' => 'nullable',
            'religion' => 'required',
            'blood_group' => 'nullable',
            'status' => 'required',
            'education' => 'nullable',
            'kewarganegaraan' => 'required',
        ]);

        $job = Job::find($request->job_id);
        $data['job'] = $job->name;

        $provinces = Province::find($request->provinces_id);
        if ($request->provinces_id) {
            $data['provinces'] = $provinces->name;
        }

        $regencies = Regency::find($request->regencies_id);
        if ($request->provinces_id) {
            $data['regencies'] = $regencies->name;
        }

        $districts = District::find($request->districts_id);
        if ($request->provinces_id) {
            $data['districts'] = $districts->name;
        }

        $villages = Village::find($request->villages_id);
        if ($request->provinces_id) {
            $data['villages'] = $villages->name;
        }

        $resident->update($data);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('tetaps.index');
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
}
