<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'produk_id',
        'project_id',
    ];
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    
    public function project()
    {
        return $this->belongsTo(Proyek::class, 'project_id');
    }
}