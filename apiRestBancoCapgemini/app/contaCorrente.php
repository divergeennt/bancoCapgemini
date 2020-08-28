<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contaCorrente extends Model
{
    //	conta_correntes

    public $table = 'conta_correntes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'banco_id',
        'cliente_id',
        'agencia',
        'conta',
        'saldo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'banco_id' => 'integer',
        'cliente_id' => 'integer',
        'agencia' => 'string',
        'conta' => 'string',
        'saldo' => 'float'
    ];
}
