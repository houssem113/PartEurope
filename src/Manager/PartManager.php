<?php

namespace App\Manager;

use App\Entity\Part;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;

class PartManager 
{
     
    public function __construct(EntityManagerInterface $entityManagerInterface ,VehicleRepository  $vehicleRepository )
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->vehicleRepository = $vehicleRepository;
    }   

    public function addData(): bool
    {
        $file = fopen('src/Documents/parts.csv', "r");
        if ($file == true)
        {  
            while (($getData = fgetcsv($file, 10000, ";")) !== FALSE)
            {
                $this->mapData($getData);
            }
            $this->entityManagerInterface->flush(); 
            fclose($file);
            return true;
        }
        return false ;
    }


    public function mapData(array $getData):void
    {
        $pieces = explode(",",$getData[3]);
        $parts = (new Part())
                ->setName($getData[1])
                ->setActive((int)$getData[2]);
        foreach ($pieces as $key => $value) {
            $vehicle = $this->vehicleRepository->findOneBy(['uuid'=>$value]);
            if($vehicle instanceof Vehicle){
                $parts->addVehicleId($vehicle); 
               }
        }   
        $this->entityManagerInterface->persist($parts);
    }


}