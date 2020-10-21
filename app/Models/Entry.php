<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'mac_address'
    ];

    protected $dates = ['created_at'];

    public function bucket()
    {
        return $this->belongsTo(Bucket::class);
    }
}
