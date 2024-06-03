<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_toko',
        'total_item'
    ];

    public function inproduct_detail(): HasMany
    {
        return $this->hasMany(Inproduct_detail::class, 'inproduct_id', 'id');
    }
}
