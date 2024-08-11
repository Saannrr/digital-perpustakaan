<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // count
        $count_buku = Buku::count();
        $count_user = User::role('peminjam')->count();
        $count_buku_terbaca = Buku::sum('total_pembaca');

        // terbaru
        $buku = Buku::limit(5)->latest()->get();
        $user = User::role('peminjam')->limit(5)->latest()->get();
        $buku_terbaca = Buku::orderBy('total_pembaca', 'desc')->limit(5)->get();

        return view('petugas/dashboard/index',
            compact(
                'count_buku', 'count_user', 'buku', 'user', 'count_buku_terbaca', 'buku_terbaca'
            )
        );
    }
}
