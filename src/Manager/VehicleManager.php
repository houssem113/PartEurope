<?php

namespace App\Manager;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Shuchkin\SimpleXLSX;

class VehicleManager 
{


    public function __construct(EntityManagerInterface $em )
    {
        $this->em = $em;
    }


    public function addDataCSV(): bool
    {
        if ( $xlsx = SimpleXLSX::parse('src/Documents/vehicles.xlsx') ) {
            foreach($xlsx->rows() as $key => $row)
            {
                if($key > 0 ){
                $this->mapData($row);
                } 
            }
            $this->em->flush();
            return true;
        } else {
                echo SimpleXLSX::parseError();
                return false;
            }
    }

    public function mapData(array $row): void
    {
        $vehicle = (new Vehicle())
                    ->setUuid($row['0'])
                    ->setBikeProducer((String)$row['1'])
                    ->setSeries($row['2'])
                    ->setSize($row['3'])
                    ->setConfiguration($row['4'])
                    ->setBikeModel($row['5'])
                    ->setSalesName($row['6'])
                    ->setYear((int)$row['7'])
                    ->setCylinder($row['8'])
                    ->setTypeofDrive($row['9'])
                    ->setEngineOutput($row['10'])
                    ->setCountry($row['11'])
                    ->setCategory1($row['12'])
                    ->setCategory2($row['13']);
                    $this->em->persist($vehicle);
    }

}