<?php

namespace App\Models;

use App\Enums\FaceList;
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
    protected $fillable = ['number', 'face', 'temperature', 'created_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * Get the faulty sensors for the sensor.
     * @return HasMany
     */
    public function faultySensors(): HasMany
    {
        return $this->hasMany(FaultySensor::class);
    }

    /**
     * @var string[]
     */
    /*protected $casts = [
        'face' => FaceList::class,
    ];*/
}
