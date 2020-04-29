<?php


namespace App\Console\Commands;


use App\Services\StatServiceInterface;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CovidList extends Command
{
    private $statService;
    protected $signature= 'covid:list';
    public function __construct(StatServiceInterface $statService)
    {
        $this->statService=$statService;
        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stats=$this->statService->list();
        foreach ($stats as $stat) {
            $data[]=$this->statService->StatList($stat);
        }
        $this->table(array_keys($data[0]), $data);
        return 0;
    }

}
