<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class HafalanBaru extends Model
{
    use HasFactory,Uuids;
    protected $primaryKey = 'hb_id';
    protected $connection = 'mysql2';
    protected $table = 'hafalanbaru';
    public $incrementing = false;
    public $timestamps = false;
}
