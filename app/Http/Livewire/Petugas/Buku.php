<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Buku as ModelsBuku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Rak;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $create, $edit, $delete, $show;
    public $kategori, $penerbit;
    public $kategori_id, $penerbit_id;
    public $judul, $penulis, $sampul, $file_buku, $buku_id, $total_pembaca, $search;

    protected $rules = [
        'judul' => 'required',
        'penulis' => 'required',
        'sampul' => 'required|image|max:1024',
        'file_buku' => 'required|mimes:pdf|max:1000024',
        'kategori_id' => 'required|numeric|min:1',
        'penerbit_id' => 'required|numeric|min:1',
    ];

    protected $validationAttributes = [
        'kategori_id' => 'kategori',
        'penerbit_id' => 'penerbit',
    ];

//    public function pilihKategori()
//    {
//        $this->rak = Rak::where('kategori_id', $this->kategori_id)->get();
//    }

    public function create()
    {
        $this->format();

        $this->create = true;
        $this->kategori = Kategori::all();
        $this->penerbit = Penerbit::all();
    }

    public function store()
    {
        $this->validate();

        $this->sampul = $this->sampul->store('buku', 'public');

        ModelsBuku::create([
            'sampul' => $this->sampul,
            'file_buku' => $this->file_buku,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'total_pembaca' => $this->total_pembaca,
            'kategori_id' => $this->kategori_id,
            'penerbit_id' => $this->penerbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        session()->flash('sukses', 'Data berhasil ditambahkan.');
        $this->format();
    }

    public function show(ModelsBuku $buku)
    {
        $this->format();

        $this->show = true;
        $this->judul = $buku->judul;
        $this->sampul = $buku->sampul;
        $this->file_buku = $buku->file_buku;
        $this->penulis = $buku->penulis;
        $this->total_pembaca = $buku->total_pembaca;
        $this->kategori = $buku->kategori->nama;
        $this->penerbit = $buku->penerbit->nama;
    }

    public function edit(ModelsBuku $buku)
    {
        $this->format();

        $this->edit = true;
        $this->buku_id = $buku->id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->kategori_id = $buku->kategori_id;
        $this->penerbit_id = $buku->penerbit_id;
        $this->kategori = Kategori::all();
        $this->penerbit = Penerbit::all();
    }

    public function update(ModelsBuku $buku)
    {
        $validasi = [
            'judul' => 'required',
            'penulis' => 'required',
            'kategori_id' => 'required|numeric|min:1',
            'penerbit_id' => 'required|numeric|min:1',
        ];

        if ($this->sampul) {
            $validasi['sampul'] = 'required|image|max:1024';
        }

        if ($this->file_buku) {
            $validasi['file_buku'] = 'required|mimes:pdf|max:1000024';
        }

        $this->validate($validasi);

        if ($this->sampul) {
            Storage::disk('public')->delete($buku->sampul);
            $this->sampul = $this->sampul->store('buku/cover', 'public');
        } else {
            $this->sampul = $buku->sampul;
        }

        if ($this->file_buku) {
            Storage::disk('public')->delete($buku->file_buku);
            $this->file_buku = $this->file_buku->store('buku/file-buku', 'public');
        } else {
            $this->file_buku = $buku->file_buku;
        }

        $buku->update([
            'sampul' => $this->sampul,
            'file_buku' => $this->file_buku,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'kategori_id' => $this->kategori_id,
            'penerbit_id' => $this->penerbit_id,
            'slug' => Str::slug($this->judul)
        ]);

        session()->flash('sukses', 'Data berhasil diubah.');
        $this->format();
    }

    public function delete(ModelsBuku $buku)
    {
        $this->format();

        $this->delete = true;
        $this->buku_id = $buku->id;
    }

    public function destroy(ModelsBuku $buku)
    {
        Storage::disk('public')->delete($buku->sampul);
        $buku->delete();

        session()->flash('sukses', 'Data berhasil dihapus.');
        $this->format();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->search) {
            $buku = ModelsBuku::latest()->where('judul', 'like', '%'. $this->search .'%')->paginate(5);
        } else {
            $buku = ModelsBuku::latest()->paginate(5);
        }

        return view('livewire.petugas.buku', compact('buku'));
    }

    public function format()
    {
        unset($this->create);
        unset($this->delete);
        unset($this->edit);
        unset($this->show);
        unset($this->buku_id);
        unset($this->judul);
        unset($this->sampul);
        unset($this->file_buku);
        unset($this->total_pembaca);
        unset($this->penulis);
        unset($this->kategori);
        unset($this->penerbit);
        unset($this->penerbit_id);
        unset($this->kategori_id);
    }
}
