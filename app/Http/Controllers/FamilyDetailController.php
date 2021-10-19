<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\FamilyDetail;
use App\Models\Resident;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FamilyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'hubungan' => 'required',
            'resident_id' => 'required',
            'family_id' => 'required',
        ]);

        // Merge
        $residents = Resident::find($request->resident_id);

        $family = Family::find($request->family_id);
        $data['resident'] = $residents->name;
        $data['no_kk'] = $family->no_kk;
        $data['kepala_keluarga'] = $family->kepala_keluarga ;

        FamilyDetail::create($data);
        $update['family_id'] = $family->id;
        $update['no_kk'] = $family->no_kk;
        $update['kepala_keluarga'] = $request->hubungan;
        $residents->update($update);

        Alert::success('Success', 'Data berhasil ditambahkan');
        return redirect()->route('familyDetails.show', $request->family_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = FamilyDetail::get();
        $family = Family::findOrFail($id);
        $residents = Resident::doesntHave('families')->doesntHave('detailsFamilies')->get();
        return view('pages.penduduk.detail keluarga.create', compact('details','family','residents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function confirm($id)
    {
         alert()->warning('Peringatan !','Anda yakin akan menghapus data ? ')
        ->showConfirmButton('<a href="familyDetail/' . $id . '/delete" class="text-white text-decoration-none">Hapus</a>', '#3085d6')->toHtml()
        ->showCancelButton('Batal', '#aaa')->reverseButtons();

        return back();
    }

    public function delete($id)
    {
        $detail = FamilyDetail::select('resident_id', 'id')->find($id)->firstOrFail();

        $delFamily = Resident::where('family_id',$detail->family_id)->get();
        $del = [
            'family_id' => NULL,
            'kepala_keluarga' => NULL,
            'no_kk' => NULL,
        ];
        foreach ($delFamily as $deaja) {
            $deaja->update($del);
        }

        $detail->births()->delete();
        $detail->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }

    public function deleteAllFamilyDetail()
    {
        $details = FamilyDetail::whereNotNull('id')->delete();

        $details->births()->delete();
        $details->delete();

        Alert::success('Success', 'Semua data berhasil dihapus');
        return back()->with('berhasil','Data berhasil dihapus');
    }
}
