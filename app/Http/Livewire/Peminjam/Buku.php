<?php

namespace App\Http\Livewire\Peminjam;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Buku extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['pilihKategori', 'semuaKategori'];

    public $kategori_id, $pilih_kategori, $buku_id, $detail_buku, $search;

    public function pilihKategori($id)
    {
        $this->format();
        $this->kategori_id = $id;
        $this->pilih_kategori = true;
        $this->updatingSearch();
    }

    public function semuaKategori()
    {
        $this->format();
        $this->pilih_kategori = false;
        $this->updatingSearch();
    }

    public function detailBuku($id)
    {
        $this->format();
        $this->detail_buku = true;
        $this->buku_id = $id;
    }

    public function baca(ModelsBuku $buku)
    {
        if (auth()->user()) {
            if (auth()->user()->hasRole('peminjam')) {
                $buku->update(['total_pembaca' => $buku->total_pembaca + 1]);
                session()->flash('sukses', 'Anda sedang membaca buku ' . $buku->judul);
                return redirect()->route('buku.preview', $buku->id);
            } else {
                session()->flash('gagal', 'Role user anda bukan peminjam');
            }
        } else {
            session()->flash('gagal', 'Anda harus login terlebih dahulu');
            return redirect('/login');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->pilih_kategori) {
            $buku = $this->search ?
                ModelsBuku::latest()->where('judul', 'like', '%' . $this->search . '%')->where('kategori_id', $this->kategori_id)->paginate(12) :
                ModelsBuku::latest()->where('kategori_id', $this->kategori_id)->paginate(12);
            $title = Kategori::find($this->kategori_id)->nama;
        } elseif ($this->detail_buku) {
            $buku = ModelsBuku::find($this->buku_id);
            $title = 'Detail Buku';
        } else {
            $buku = $this->search ?
                ModelsBuku::latest()->where('judul', 'like', '%' . $this->search . '%')->paginate(12) :
                ModelsBuku::latest()->paginate(12);
            $title = 'Semua Buku';
        }

        return view('livewire.peminjam.buku', compact('buku', 'title'));
    }

    public function format()
    {
        $this->detail_buku = false;
        $this->pilih_kategori = false;
        unset($this->buku_id);
        unset($this->kategori_id);
    }
}
