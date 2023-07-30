<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Ambil kode kategori dari tabel kategori berdasarkan category_id
            $categoryCode = Category::find($product->category_id)->kd_category;
            $product->kd_produk = $categoryCode . '-' . mt_rand(10000000, 99999999); // Gabungkan dengan angka acak
        });
    }

    function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
