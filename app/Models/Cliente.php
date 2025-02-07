<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes'; 
    protected $primaryKey = 'ci';
    protected $fillable = ['ci','nombre','puntos']; 
    public $timestamps = false;
    public function factura(){
        return $this->hasMany(Factura::class);
    }
    public function intercambio(){
        return $this->hasMany(Intercambios::class, 'cliente_ci');
    }
}
