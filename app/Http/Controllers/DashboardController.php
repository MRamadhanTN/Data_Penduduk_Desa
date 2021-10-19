<?php

namespace App\Http\Controllers;

use App\Models\Birth;
use App\Models\Death;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $residents = Resident::get();
        $tetaps = Resident::where('category', 'Penduduk Tetap')->get();
        $comes = Resident::where('category', 'Penduduk Datang')->get();
        $transfers = Resident::where('category', 'Penduduk Pindah')->get();
        $births = Birth::get();
        $dies = Death::get();
        $users = User::get();

        $update = Resident::orderByDesc('id')->take(10)->limit(3)->get();

        $month = [
            'Jan' => Resident::whereMonth('created_at', 1)->count(),
            'Feb' => Resident::whereMonth('created_at', 2)->count(),
            'Mar' => Resident::whereMonth('created_at', 3)->count(),
            'Apr' => Resident::whereMonth('created_at', 4)->count(),
            'May' => Resident::whereMonth('created_at', 5)->count(),
            'Jun' => Resident::whereMonth('created_at', 6)->count(),
            'Jul' => Resident::whereMonth('created_at', 7)->count(),
            'Aug' => Resident::whereMonth('created_at', 8)->count(),
            'Sep' => Resident::whereMonth('created_at', 9)->count(),
            'Oct' => Resident::whereMonth('created_at', 10)->count(),
            'Nov' => Resident::whereMonth('created_at', 11)->count(),
            'Dec' => Resident::whereMonth('created_at', 12)->count(),
        ];

        $penduduk_tetap = [
            'Jan' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 1)->count(),
            'Feb' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 2)->count(),
            'Mar' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 3)->count(),
            'Apr' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 4)->count(),
            'May' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 5)->count(),
            'Jun' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 6)->count(),
            'Jul' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 7)->count(),
            'Aug' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 8)->count(),
            'Sep' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 9)->count(),
            'Oct' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 10)->count(),
            'Nov' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 11)->count(),
            'Dec' => Resident::where('category','Penduduk Tetap')->whereMonth('created_at', 12)->count(),
        ];

        $penduduk_datang = [
            'Jan' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 1)->count(),
            'Feb' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 2)->count(),
            'Mar' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 3)->count(),
            'Apr' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 4)->count(),
            'May' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 5)->count(),
            'Jun' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 6)->count(),
            'Jul' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 7)->count(),
            'Aug' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 8)->count(),
            'Sep' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 9)->count(),
            'Oct' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 10)->count(),
            'Nov' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 11)->count(),
            'Dec' => Resident::where('category','Penduduk Datang')->whereMonth('created_at', 12)->count(),
        ];

        $penduduk_pindah = [
            'Jan' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 1)->count(),
            'Feb' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 2)->count(),
            'Mar' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 3)->count(),
            'Apr' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 4)->count(),
            'May' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 5)->count(),
            'Jun' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 6)->count(),
            'Jul' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 7)->count(),
            'Aug' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 8)->count(),
            'Sep' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 9)->count(),
            'Oct' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 10)->count(),
            'Nov' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 11)->count(),
            'Dec' => Resident::where('category','Penduduk Pindah')->whereMonth('created_at', 12)->count(),
        ];

        return view('pages.dashboard', compact('residents','births','dies','users','tetaps','comes','transfers','month', 'penduduk_tetap', 'penduduk_datang', 'penduduk_pindah','update'));
    }
}
