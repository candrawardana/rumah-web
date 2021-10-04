<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'tabungan';
    public $incrementing = false;
    public $timestamps = false;
}
