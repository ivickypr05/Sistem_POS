<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'kode_produk',
        'nama',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'subtotal'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}
