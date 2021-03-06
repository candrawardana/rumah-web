<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $primaryKey = 's_nis';
    protected $table = 'santri';
    public $incrementing = false;
    public $timestamps = false;
    protected $hidden = [
        's_password',
    ];
}
