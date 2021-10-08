<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Hafalan extends Model
{
    use HasFactory,Uuids;
    protected $primaryKey = 'h_id';
    protected $connection = 'mysql2';
    protected $table = 'hafalan';
    public $incrementing = false;
    public $timestamps = false;
}
