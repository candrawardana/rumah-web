<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class BeritaKoperasi extends Model
{
    use HasFactory,Uuids;
    protected $table = 'berita_koperasi';
    public $incrementing = false;
}
