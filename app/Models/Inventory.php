<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;

class Inventory extends Model
{
    use HasFactory;
    function relationshipwithsize(){
        return $this->hasone(Size::class, 'id', 'size_id');
    }
    function relationshipwithcolor(){
        return $this->hasone(Color::class, 'id', 'color_id');
    }
}
