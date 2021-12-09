<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    public function getImages()
    {
        return $this->hasMany(ImagemImovel::class, 'id_imoveis');
    }

    public function getBairro()
    {
        return $this->belongsTo(Bairro::class, 'id_bairros');
    }

    public function getEstado()
    {
        return $this->belongsTo(Estado::class, 'id_estados');
    }

    public function tipoImovel()
    {
        return $this->belongsTo(TipoImovel::class, 'id_tipo_imovel');
    }
}
