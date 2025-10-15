<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function toArray()
    {
        return [
            'id'     => $this->id,
            'nombre' => $this->name,
            'precio' => $this->price,
            'creado' => $this->created_at ? $this->created_at->format('Y-m-d') : null,
        ];
    }
}

