<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'face'];

    /**
     * Get the faulty sensors for the sensor.
     * @return HasMany
     */
    public function temperatures(): HasMany
    {
        return $this->hasMany(Temperature::class);
    }
}
