<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'productos';
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';
    protected $fillable = [
        'codigo',
        'nombre',
        'precio',
        'fecha_de_publicacion',
        'producto_tipo',
        'editoriale_id',
    ];
    public function editorial()
    {
        return $this->belongsTo(Editoriale::class, 'editoriale_id');
    }

    public function stocks()
    {
        return $this->hasOne(Stock::class, 'producto_codigo', 'codigo');
    }

    public function libros()
    {
        return $this->hasOne(Libro::class, 'producto_codigo', 'codigo');
    }
    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'producto_genero', 'producto_codigo', 'genero_id');
    }
    public function revistas()
    {
        return $this->hasOne(Revista::class, 'producto_codigo','codigo');
    }
    public function enciclopedia()
    {
        return $this->hasOne(Enciclopedia::class, 'producto_codigo','codigo');
    }
    public function venta_Producto(){
        return $this->hasOne(Venta_Producto::class);
    }
    public function compras(){
        return $this->belongsToMany(Compra::class, 'producto_compra','producto_codigo','compra_nro')
        ->withPivot('cantidad', 'precio_unitario'); // Especifica los campos de la tabla pivote         
    }
    public function promocion_detalle(){
        return $this->belongsToMany(Promocion_detalles::class,'promocion_detalle_producto', 'producto_codigo', 'codigo')
        ->withPivot('porcentaje', 'cantidad');
;
    }
    public function intercambios(){
        return $this->belongsToMany(Intercambios::class, 'intercambio_producto','producto_codigo', 'intercambio_nro')
        ->withPivot('cantidad');;
    }
}
