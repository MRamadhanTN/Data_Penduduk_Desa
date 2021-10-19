<?php

namespace App\Http\Controllers;

use App\Exports\Resident\ResidentExport;
use App\Exports\Resident\ResidentTemplateExport;
use App\Imports\ResidentImport;
use App\Models\Birth;
use App\Models\Death;
use App\Models\District;
use App\Models\Family;
use App\Models\FamilyDetail;
use App\Models\Job;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Resident;
use App\Models\Village;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Resident::get();
        $details = FamilyDetail::get();
        $dies = Death::get();


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

        return view('pages.master.residents.resident', compact('residents','details','dies'));

    }


    public function resetFilter()
    {
        return redirect()->route('residents.index');
    }

    public function residentPrint()
    {
        $residentPrint = Resident::get();

        return view('pages.master.residents.print', compact('residentPrint',));
    }

    public function residentExport()
    {
        return Excel::download(new ResidentExport,'Penduduk.xlsx');
    }

    public function template()
    {
        return Excel::download(new ResidentTemplateExport,'Penduduk Template.xlsx');
    }

    public function residentImport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataPenduduk', $nameFile);

        Excel::import(new ResidentImport, public_path('/DataPenduduk/'.$nameFile));

		Alert::success('Success', 'Data Penduduk Berhasil Diimport!');

        return redirect()->route('residents.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residentCreate = Resident::get();
        $jobs = Job::get();
        $provinces = Province::get();
        $regencies = Regency::get();
        $districts = District::get();
        $villages = Village::get();
        return view('pages.master.residents.create', compact('residentCreate','jobs','provinces','regencies','districts','villages'));
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
            'category' => 'required',
        ]);

        $job = Job::find($request->job_id);
        $data['job'] = $job->name;

        $provinces = Province::find($request->provinces_id);
        $data['provinces'] = $provinces->name;

        $regencies = Regency::find($request->regencies_id);
        $data['regencies'] = $regencies->name;

        $districts = District::find($request->districts_id);
        $data['districts'] = $districts->name;

        $villages = Village::find($request->villages_id);
        $data['villages'] = $villages->name;

        $villages = Village::find($request->villages_id);
        $data['villages'] = $villages->name;

        Resident::create($data);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('residents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $residents = Resident::find($id);
        $details = FamilyDetail::where('resident_id', $id)->get();
        $dies = Death::get();

        return view('pages.master.residents.show', compact('residents','details','dies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $residentEdit = Resident::find($id);
        $jobs = Job::get();
        $provinces = Province::get();
        $regencies = Regency::get();
        $districts = District::get();
        $villages = Village::get();
        return view('pages.master.residents.edit', compact('residentEdit', 'jobs','provinces','regencies','districts','villages'));
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
            'category' => 'required',
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

        // update data kematian
        $dies = Death::where('resident_id', $id);
        $updies = [
            'name' => $request->name,
            'gender'=> $request->gender,
            'NIK' => $request->NIK,
            'place_birth' => $request->place_birth,
            'birth_date'=> $request->birth,
            'job' => $job->name,
            'religion' => $request->religion,
            'citizenship' => $request->kewarganegaraan,
        ];
        $dies->update($updies);

        // update data kelahiran
        $births = Birth::where('resident_id', $id);
        $upbirths = [
            'name' => $request->name,
            'gender' => $request->gender,
            'birth' => $request->birth,
            'place_birth' => $request->place_birth,
        ];
        $births->update($upbirths);

        // update data keluarga
        $families = Family::where('resident_id', $id);
        $upfamilies = [
            'NIK' => $request->NIK,
            'kepala_keluarga' => $request->name,
        ];
        $families->update($upfamilies);

        // update data detailkeluarga
        $details = FamilyDetail::where('resident_id', $id);
        $updetails = [
            'resident' => $request->name,
        ];
        $details->update($updetails);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('residents.index');
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
        ->showConfirmButton('<a href="resident/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $resident = Resident::select('NIK', 'id')->whereId($id)->firstOrFail();;
        $resident->deaths()->delete();

        $resident->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('residents.index');
    }

    public function konfirmasiAll()
    {
        alert()->warning('Peringatan !','Anda yakin akan menghapus semua data ? ')
        ->showConfirmButton('<a href="resident/deleteAll" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function deleteAllResident()
    {
        Resident::truncate();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return back()->with('berhasil','Data berhasil dihapus');
    }
}
