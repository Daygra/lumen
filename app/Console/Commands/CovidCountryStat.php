<?php


namespace App\Console\Commands;


use App\Services\StatServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidCountryStat extends Command
{
    private $statService;
    protected $signature = 'covid:countryStat';


    public function __construct(StatServiceInterface $statService)
    {
        $this->statService = $statService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countriesList=$this->statService->getCountries()->pluck('name','id')->toArray();
        $country_id=array_search($this->choice('choice_country',array_values($countriesList)),$countriesList);
        $stat=$this->statService->getByCountry($country_id);
        $data[] = [
            'country' => $stat->countries->name,
            'ill' => $stat->ill_num,
            'dead' => $stat->dead_num,
            'good' => $stat->good_num,
            'updated_at' => date('H:i:s d.m.Y', strtotime($stat->updated_at))
        ];
        $this->table(
            ['Country name', 'Ill', 'Dead', 'Good', 'Updated'],
            $data
        );
        return 0;
    }
}
