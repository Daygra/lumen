<?php


namespace App\Services;


use App\Models\Countries;
use App\Models\CovidStat;
use App\Repositories\StatRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StatService implements StatServiceInterface
{
    private $statRepository;
    public function __construct(StatRepositoryInterface $statRepository)
    {
        $this->statRepository=$statRepository;
    }

    public function add(array $data): void
    {
        $this->statRepository->saveStat($data);
    }

    public function list(): ?Collection
    {
        return $this->statRepository->getAllStats();
    }

    public function update(array $data): void
    {
      $stat=$this->statRepository->getStatByCountryId($data['country_id']);
      $this->statRepository->saveStat($data,$stat);
    }

    public function delete(int $id): void
    {
       $stat=$this->statRepository->getStatByCountryId($id);
       $this->statRepository->deleteStat($stat);
    }

    public function getByCountry(int $countryId): ?CovidStat
    {
        return $this->statRepository->getStatByCountryId($countryId);
    }
    public function getCountries(): ?Collection
    {
        return $this->statRepository->getCountries();
    }

    public function showStatList($stat)
    {

    }
}
