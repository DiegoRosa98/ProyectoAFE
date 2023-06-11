<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    // table name
    protected $table = "roles";

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
     * Method for retrieving all roles' paginated list
     */
    public function getRoles() {
        return Roles::where('estado', 1)->paginate(5);
    }

    /**
     * Method for retrieving all roles' no paginated list
     */
    public function getAllRoles() {
        return Roles::where('estado', 1);
    }

    /**
     * Method for retrieving an especific roles
     */
    public function getRoleById($id) {
        return Roles::find($id);
    }
}
