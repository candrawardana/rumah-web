<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibu extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'ibu';
    public $incrementing = false;
}
