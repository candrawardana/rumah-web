<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Kegiatan extends Model
{
    use HasFactory,Uuids;
    protected $primaryKey = 'kg_id';
    protected $connection = 'mysql2';
    protected $table = 'kegiatan';
    public $incrementing = false;
    public $timestamps = false;
}
