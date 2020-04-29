<?php


namespace App\Repositories;


use App\Models\CovidStat;
use Illuminate\Database\Eloquent\Collection;


interface StatRepositoryInterface
{
    public function saveStat(array $data,CovidStat $stat = NULL);
    public function getStatByCountryId(int $id):?CovidStat;
    public function getCountries():?Collection;
    public function getAllStats(): ?Collection;
    public function deleteStat(CovidStat $stat);
}
