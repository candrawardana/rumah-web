<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class WaliOrangTua extends Model
{
    use HasFactory,Uuids;
    protected $table = 'wali_orang_tua';
    public $incrementing = false;
}
