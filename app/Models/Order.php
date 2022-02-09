<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    const PENDIENTE = 1; //Generado
    const RECIBIDO = 2; //Generado y pagado
    const ENVIADO = 3; //Pedido enviado pero no entregado al usuario
    const ENTREGADO = 4; //Pedido recibido por el cliente
    const ANULADO = 5; //Se genera pero no se paga y se cancela automaticamente.

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
    
    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
