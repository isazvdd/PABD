<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projeto';
    protected $primaryKey = 'codigo';
    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'depto',
        'responsavel',
        'dataInicio',
        'dataFim',
        'situacao',
        'dataConclusao',
        'equipe',
    ];

    protected $casts = [
        'dataInicio' => 'date',
        'dataFim' => 'date',
        'dataConclusao' => 'date',
    ];

    public function atividades()
    {
        return $this->belongsToMany(Atividade::class, 'atividade_projeto', 'codProjeto', 'codAtividade');
    }
}
