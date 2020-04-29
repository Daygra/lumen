<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Countries extends Model
{
    protected $table='countries';
    protected $fillable=['name'];
    public function stats() :HasOne
    {
        return $this->hasOne(CovidStat::class);
    }
}
