<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class SantriKegiatan extends Model
{
    use HasFactory,Uuids;
    protected $table = 'santri_kegiatan';
    public $incrementing = false;
}