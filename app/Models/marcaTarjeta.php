<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaTarjeta extends Model
{
    use HasFactory;
    // table name
    protected $table = "marca_tarjeta";

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
     * Method for retrieving all CardBrands' list
     */
    public function getCardBrands() {
        return MarcaTarjeta::all();
    }

    /**
     * Method for retrieving an especific CardBrand
     */
    public function getCardBrandById($id) {
        return MarcaTarjeta::find($id);
    }
}
