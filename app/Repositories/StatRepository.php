<?php


namespace App\Repositories;


use App\Models\Countries;
use App\Models\CovidStat;
use Illuminate\Database\Eloquent\Collection;

class StatRepository implements StatRepositoryInterface
{
    private $countries;
    private $covidStat;
    public function __construct()
    {
        $this->countries=app()->make(Countries::class);
        $this->covidStat=app()->make(CovidStat::class);

    }


    public function saveStat(array $data,CovidStat $stat = NULL){
        $country=$this->countries->find($data['country_id']);
        if(!$country){
            throw new \InvalidArgumentException('Country does not exists');
        }
        if( !($country->stats()->get()->isEmpty())&&$stat == NULL) {
            throw new \InvalidArgumentException('Country covid data exists, try to use "covid:update"');
        }
        !is_null($stat)?:$stat = new CovidStat();
        $stat->ill_num=$data['ill'];
        $stat->good_num=$data['good'];
        $stat->dead_num=$data['dead'];
        $stat->countries()->associate($country);
        $stat->save();

    }

    public function getAllStats(): ?Collection
    {
        return $this->covidStat->all();
    }

    public function getStatByCountryId(int $id):?CovidStat
    {
        return $this->covidStat->where('countries_id', '=', $id)->first();
    }

    public function getCountries(): Collection
    {
        return $this->countries->all(['name','id']);
    }
    public function deleteStat(CovidStat $stat)
    {
        try {
            $stat->delete($stat);
        } catch (\Exception $e) {
        }
    }
}
