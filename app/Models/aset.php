<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aset extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_perangkat';
    public $incrementing = false;
    protected $keyType = 'string';
}
