<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

use Laravel\Sanctum\PersonalAccessToken;

class MasukSanctum extends PersonalAccessToken
{
    use HasFactory,Uuids;
    protected $table = 'personal_access_tokens';

    public $incrementing = true;

    protected $primaryKey = "id";
    protected $keyType = "string";
    protected $fillable = [
        'name',"token"
    ];
}
