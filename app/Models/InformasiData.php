<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiData extends Model
{
    use HasFactory;
    protected $table = 'informasi_data';
    public $incrementing = false;
}
