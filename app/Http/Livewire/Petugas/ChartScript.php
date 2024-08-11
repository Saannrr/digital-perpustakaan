<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartScript extends Component
{
    public $bulan_tahun;

    protected $listeners = ['ubahBulanTahun'];

    public function mount()
    {
        $this->bulan_tahun = date('Y-m');
    }

    public function ubahBulanTahun()
    {
        // Update the reports when the month or year changes
    }

    public function render()
    {
        $bulan = substr($this->bulan_tahun, -2);
        $tahun = substr($this->bulan_tahun, 0, 4);

        $reads_per_day = Buku::select(DB::raw('count(*) as count, DATE(read_at) as date'))
            ->whereMonth('read_at', $bulan)
            ->whereYear('read_at', $tahun)
            ->groupBy(DB::raw('DATE(read_at)'))
            ->get();

        $hari_per_bulan = Carbon::parse($this->bulan_tahun)->daysInMonth;

        $tanggal_pengembalian = [];
        $count = [];

        for ($i = 1; $i <= $hari_per_bulan; $i++) {
            $date = sprintf('%04d-%02d-%02d', $tahun, $bulan, $i);
            $found = $reads_per_day->firstWhere('date', $date);

            if ($found) {
                $tanggal_pengembalian[$i] = $i;
                $count[$i] = $found->count;
            } else {
                $tanggal_pengembalian[$i] = $i;
                $count[$i] = 0;
            }
        }

        return view('livewire.petugas.chart-script', compact('count', 'tanggal_pengembalian'));
    }
}
