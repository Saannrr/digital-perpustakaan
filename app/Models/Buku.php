<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['judul', 'total_pembaca', 'sampul', 'file_buku', 'slug', 'penulis', 'kategori_id', 'penerbit_id', 'user_id'];

    public static function getYearsData()
    {
        return self::selectRaw('YEAR(created_at) as year')
            ->groupBy('year')
            ->orderBy('year')
            ->get()
            ->pluck('year')
            ->toArray();
    }

    public static function getBooksByMonth($month, $year)
    {
        return self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
    }

    public static function getBooksByYear($year)
    {
        return self::whereYear('created_at', $year)
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function buku()
    {
        return $this->hasMany(DetailPeminjaman::class);
    }

    // mutator
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucfirst($value);
    }

    public function setPenulisAttribute($value)
    {
        $this->attributes['penulis'] = ucfirst($value);
    }
}
