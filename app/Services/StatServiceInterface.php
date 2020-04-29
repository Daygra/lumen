<?php


namespace App\Services;


use App\Models\CovidStat;
use Illuminate\Database\Eloquent\Collection;

interface StatServiceInterface
{
    public function add(array $data): void ;
    public function list():?Collection;
    public function update(array $data): void ;
    public function delete(int $id):void ;
    public function getByCountry(int $countryId):?CovidStat;
    public function getCountries(): ?Collection;
    public function StatList($stat);
}
