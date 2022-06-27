<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Temperature extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['temperature', 'faulty', 'created_at', 'sensor_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     *
     * @return BelongsTo
     */
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    /**
     * Get temperatures collection for last hour
     * @param $face
     * @return Collection
     */
    public static function getTemperaturesByFace($face)
    {
        return Temperature::with('sensor')
            ->whereHas('sensor', function (Builder $query) use($face){
                $query->where('face', '=', $face);
            })->whereBetween('created_at', [now()->subMinutes(60), now()])
            ->get()
            ->avg('temperature');
    }

    /**
     * Get data throughout the week
     * @param int $faulty
     * @return array
     */
    public static function weeklyData($faulty = 0): array
    {
        $currentDateTime = Carbon::now();
        $endDateTime = $currentDateTime->subDays(7)->format('Y-m-d H:i:s');

        return DB::select("SELECT
                              s.id,
                              s.face,
                              AVG(t.temperature) as avgValue,
                              date(t.created_at) as date,
                              hour(t.created_at) as hour
                            FROM
                              temperatures t INNER JOIN sensors s ON s.id = t.sensor_id
                            WHERE t.created_at > :date
                                AND t.faulty = :faulty
                            GROUP BY
                              date(t.created_at), s.face, HOUR(t.created_at), s.id
                            ORDER BY date(t.created_at)", ['date' => $endDateTime, 'faulty' => $faulty]);
    }
}
