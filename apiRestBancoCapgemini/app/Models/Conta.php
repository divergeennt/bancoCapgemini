<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use SoftDeletes;

    public $table = 'conta_corrente';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
