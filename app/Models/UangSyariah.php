<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class UangSyariah extends Model
{
    use HasFactory,Uuids;
    protected $connection = 'mysql2';
    protected $table = 'uangsyariah';
    public $incrementing = false;
    public $timestamps = false;
}
