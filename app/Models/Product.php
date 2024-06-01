<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_produk',
        'nama',
        'stok',
        'harga_beli',
        'harga_jual',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    // public function supplier(): HasMany
    // {
    //     return $this->hasMany(Supplier::class, 'supplier_id', 'id');
    // }
}
