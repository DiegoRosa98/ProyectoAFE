<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoTarjeta extends Model
{
    use HasFactory;
    // table name
    protected $table = "tipo_tarjeta";

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'estado', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = ['id'];

    /**
     * Method for retrieving all CardTypes' list
     */
    public function getCardTypes() {
        return TipoTarjeta::all();
    }

    /**
     * Method for retrieving an especific CardType
     */
    public function getCardTypeById($id) {
        return TipoTarjeta::find($id);
    }
}
