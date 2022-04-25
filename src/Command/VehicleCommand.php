<?php
namespace App\Command;

use App\Manager\VehicleManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;


#[AsCommand(
    name: 'app:add-vehicles',
    description: 'Add Vehicles to Data Base.',
    hidden: false,
    aliases: ['app:add-vehicles']
)]
class VehicleCommand extends Command
{
    
    public function __construct(VehicleManager $vehicleManager)
    {
        parent::__construct();
        $this->vehicleManager = $vehicleManager;
    }
    protected function configure(): void
    {
        $this
        ->setHelp('This command allows you to add Vehicles to data base...')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        
        if($this->vehicleManager->addDataCSV())
        {
            $output->writeln('Vehicles successfully Added!');
        }
        return Command::SUCCESS;
    }
}