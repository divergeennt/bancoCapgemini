<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    public $table = 'clientes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    // protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'nome',
        'cpf',
        'email',
        'telefone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'cpf' => 'string',
        'email' => 'string',
        'telefone'=> 'string'
    ];
}
