<?php
namespace App\Command;

use App\Manager\PartManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use League\Csv\Reader;

#[AsCommand(
    name: 'app:add-parts',
    description: 'Add parts to Data Base.',
    hidden: false,
    aliases: ['app:add-parts']
)]
class PartCommand extends Command
{   
    private $partManager;
    public function __construct(PartManager $partManager)
    {
        parent::__construct();
        $this->partManager = $partManager;
    }

    protected function configure(): void
    {
        $this
        ->setHelp('This command allows you to add Parts to data base...')
    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   
        
        if ($this->partManager->addData()) 
        {
            $output->writeln('Part successfully Added!');
        }       
        return Command::SUCCESS;
    }
}