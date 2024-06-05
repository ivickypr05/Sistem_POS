<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inproduct_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function inproduct(): BelongsTo
    {
        return $this->belongsTo(Inproduct::class, 'iproduct_id', 'id');
    }
}
