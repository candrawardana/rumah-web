<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;
    protected $primaryKey = "related_id";
    protected $table = 'dana';
    public $incrementing = false;
}
