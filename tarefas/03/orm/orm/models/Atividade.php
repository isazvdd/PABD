<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $table = 'atividade';
    protected $primaryKey = 'codigo';
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'dataInicio',
        'dataFim',
        'situacao',
        'dataConclusao',
    ];

    protected $casts = [
        'dataInicio' => 'date',
        'dataFim' => 'date',
        'dataConclusao' => 'date',
    ];

    public function projetos()
    {
        return $this->belongsToMany(Projeto::class, 'atividade_projeto', 'codAtividade', 'codProjeto');
    }
}
