<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesalahan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'kesalahan';
    public $incrementing = false;
    public $timestamps = false;
}
