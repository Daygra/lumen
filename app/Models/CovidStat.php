<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CovidStat extends Model
{

    protected $table='covid_stat';
    public function countries():BelongsTo
    {
        return $this->belongsTo(Countries::class);
    }
}
