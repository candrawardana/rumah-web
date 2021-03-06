<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Pengumuman extends Model
{
    use HasFactory,Uuids;
    protected $primaryKey = 'pg_id';
    protected $connection = 'mysql2';
    protected $table = 'pengumuman';
    public $incrementing = false;
    public $timestamps = false;
}
