<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'room_amount',
        'bathroom_amount',
        'type_consignement',
        'rental_value',
        'sale_value'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
