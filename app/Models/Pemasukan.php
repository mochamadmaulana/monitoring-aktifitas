<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('jenis','like','%'.$search.'%')
                ->orWhere('nama_bank_dompet','like','%'.$search.'%')
                // ->orWhereHas('kantor',fn($query) =>
                //     $query->where('nama_kantor','like','%'.$search.'%')
                // )
        );
    }
    function rekening_bank_dompet()
    {
        return $this->belongsTo(RekeningBankDompet::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
