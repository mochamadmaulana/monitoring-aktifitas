<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekening';
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('nomor_rekening','like','%'.$search.'%')
                ->orWhereHas('pemilik',fn($query) =>
                    $query->where('nama_lengkap','like','%'.$search.'%')
                )
                ->orWhereHas('bank_dompet',fn($query) =>
                    $query->where('jenis','like','%'.$search.'%')
                        ->orwhere('nama','like','%'.$search.'%')
                )
        );
    }
    function pemilik()
    {
        return $this->belongsTo(User::class,'pemilik_id','id');
    }
    function bank_dompet()
    {
        return $this->belongsTo(BankDompet::class);
    }
    function pemasukan_rekening()
    {
        return $this->hasMany(PemasukanRekening::class);
    }
}
