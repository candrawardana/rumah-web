<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Kesalahan extends Model
{
    use HasFactory,Uuids;
    protected $connection = 'mysql2';
    protected $table = 'kesalahan';
    public $incrementing = false;
    public $timestamps = false;
}
