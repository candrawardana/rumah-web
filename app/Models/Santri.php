<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'santri';
    public $incrementing = false;

    protected $hidden = [
        's_password'
    ];
}
