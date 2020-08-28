<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transacoes extends Model
{
    //	transacoes


    public $table = 'transacoes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'banco_id',
        'cliente_id',
        'conta_corrente_id',
        'data',
        'valor',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'banco_id' => 'integer',
        'cliente_id' => 'integer',
        'conta_corrente_id' => 'integer',
        'data' => 'date',
        'valor' => 'float',
        'tipo' => 'string',
    ];
}
