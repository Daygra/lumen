<?php


namespace App\Console\Commands;


use App\Services\StatServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidUpdate extends Command
{
    private $statService;
    protected $signature = 'covid:update {ill} {dead} {good}';


    public function __construct(StatServiceInterface $statService)
    {
        $this->statService = $statService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countriesList=$this->statService->getCountries()->pluck('name','id')->toArray();
        $country_id=array_search($this->choice('choice_country',array_values($countriesList)),$countriesList);
        $ill=$input->getArgument('ill');
        $dead=$input->getArgument('dead');
        $good=$input->getArgument('good');
        $data=compact('country_id','ill','dead','good');
        try {
            $this->statService->update($data);
            $output->writeln("data_saved");
        }catch (\InvalidArgumentException $exception){
            $output->writeln("ERROR:".$exception->getMessage());
        }
        return 0;
    }

}



