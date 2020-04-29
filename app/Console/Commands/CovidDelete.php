<?php


namespace App\Console\Commands;


use App\Services\StatServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidDelete extends Command
{
    private $statService;
    protected $signature= 'covid:delete';
    public function __construct(StatServiceInterface $statService)
    {
        $this->statService=$statService;
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countriesList=$this->statService->getCountries()->pluck('name','id')->toArray();
        $country_id=array_search($this->choice('choice_country',array_values($countriesList)),$countriesList);
        $this->statService->delete($country_id);
        return 0;
    }
}
