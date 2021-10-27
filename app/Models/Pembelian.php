<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Pembelian extends Model
{
    use HasFactory,Uuids;
    protected $table = 'pembelian_koperasi';
    public $incrementing = false;
    public $timestamps = false;
}
