<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banco extends Model
{
    use SoftDeletes;

    public $table = 'bancos';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
