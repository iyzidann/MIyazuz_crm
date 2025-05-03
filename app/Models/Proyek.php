<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = [
        'lead_id',
        'produk_id',
        'status',
    ];

    public $timestamps = true;

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
