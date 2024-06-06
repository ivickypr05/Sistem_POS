<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inproduct_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'inproduct_id',
        'kode_produk',
        'nama',
        'jumlah',
    ];


    public function inproduct(): BelongsTo
    {
        return $this->belongsTo(Inproduct::class, 'inproduct_id', 'id');
    }
}
