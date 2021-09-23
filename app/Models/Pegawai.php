<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'pegawai';
    public $incrementing = false;

    protected $hidden = [
        'p_password'
    ];
}
