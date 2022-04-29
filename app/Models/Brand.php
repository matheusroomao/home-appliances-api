<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function getCreatedAtAttribute()
    {
        $date = new DateTime($this->attributes['created_at']);
        return $date->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        $date = new DateTime($this->attributes['updated_at']);
        return $date->format('d/m/Y H:i:s');
    }

    // RELATIONSHIPS
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
