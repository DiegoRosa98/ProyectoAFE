<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;
    // table name
    protected $table = "banco";

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
     * Method for retrieving all banks' list
     */
    public function getBanks() {
        return Banco::where('estado', 1)->paginate(5);
    }

    /**
     * Method for retrieving an especific bank
     */
    public function getBankById($id) {
        return Banco::find($id);
    }
}
