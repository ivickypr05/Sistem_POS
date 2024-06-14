<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invoice_nomor',
        'total_harga',
        'jumlah_bayar',
        'tanggal',
        'laba'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detail_transaction(): HasMany
    {
        return $this->hasMany(Transaction_detail::class, 'transaction_id', 'id');
    }
}
