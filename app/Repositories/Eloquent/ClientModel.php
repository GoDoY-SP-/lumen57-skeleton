<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientModel
 * Model de Client usando Eloquent
 * @package App\Repositories\Eloquent
 * @autor Danilo D. de Godoy <danilo.doring@gmail.com>
 */
class ClientModel extends Model
{
    /**
     * Nome da tabela para persistência
     * @var string
     */
    protected $table = 'clients';

    /**
     * Desativar created_at e updated_at para gravação automática
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atributos do modelo para persistência
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];
}