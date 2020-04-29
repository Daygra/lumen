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
            $data[] = [
                'country' => $stat->countries->name,
                'ill' => $stat->ill_num,
                'dead' => $stat->dead_num,
                'good' => $stat->good_num,
                'updated_at' => date('H:i:s d.m.Y', strtotime($stat->updated_at))
            ];
        }
        $this->table(
            ['Country name', 'Ill', 'Dead', 'Good', 'Updated'],
            $data
        );
        return 0;
    }

}
