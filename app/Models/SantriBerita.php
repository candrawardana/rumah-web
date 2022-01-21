<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class SantriBerita extends Model
{
    use HasFactory,Uuids;
    protected $table = 'santri_berita';
    public $incrementing = false;
}
