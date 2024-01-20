<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningBankDompet extends Model
{
    use HasFactory;
    protected $table = 'rekening_bank_dompet';
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('nomor_rekening','like','%'.$search.'%')
                // ->orWhere('nama_bank_dompet','like','%'.$search.'%')
                // ->orWhereHas('kantor',fn($query) =>
                //     $query->where('nama_kantor','like','%'.$search.'%')
                // )
        );
    }

    function bank_dompet()
    {
        return $this->belongsTo(BankDompet::class);
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
