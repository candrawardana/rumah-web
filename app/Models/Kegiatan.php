<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'kegiatan';
    public $incrementing = false;
}
