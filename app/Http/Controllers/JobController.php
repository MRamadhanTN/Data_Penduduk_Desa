<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Exports\Job\JobExport;
use App\Exports\Job\JobTemplateExport;
use App\Imports\JobImport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::get();
        return view('pages.master.jobs.job', compact('jobs'));
    }

    public function jobExport()
    {
        return Excel::download(new JobExport,'Pekerjaan.xlsx');
    }
    public function template()
    {
        return Excel::download(new JobTemplateExport,'Pekerjaan Template.xlsx');
    }

    public function jobImportExcel(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataPekerjaan', $nameFile);

        Excel::import(new JobImport, public_path('/DataPekerjaan/'.$nameFile));

        Alert::success('Success', 'Data Pekerjaan Berhasil Diimport!');
        return redirect()->route('jobs.index');
    }

    public function printJob()
    {
        $jobPrint = Job::get();
        return view('pages.master.jobs.print', compact('jobPrint'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobCreate = Job::get();
        return view(compact('jobCreate'));
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
            'name' => 'required|max:225'
        ]);

        Job::create($data);
        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
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
        $jobEdit = Job::find($id);
        return view('pages.master.jobs.edit', compact('jobEdit'));
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
        $job = Job::find($id);
        $data = $request->validate([
            'name' => 'nullable|max:225'
        ]);

        $job->update($data);

        Alert::success('Success', 'Data berhasil diedit');
        return redirect()->route('jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $job = Job::find($id);
        // $job->delete($id);


        // return back();
    }

    public function konfirmasi($id)
    {
        alert()->warning('Peringatan !','Anda yakin akan menghapus data ? ')
        ->showConfirmButton('<a href="job/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $job = Job::select('name', 'id')->whereId($id)->firstOrFail();
        $job->delete($id);

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }

    public function konfirmasiAll()
    {
        alert()->warning('Peringatan !','Anda yakin akan menghapus semua data ? ')
        ->showConfirmButton('<a href="job/deleteAll" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function deleteAll()
    {
        Job::truncate();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return back();
    }
}
