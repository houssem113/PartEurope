<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Vehicle $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Vehicle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findSearch($search)
    {   
        //dd($search->query->get('q'));
        $query = $this
            ->createQueryBuilder('p');
        if (!empty($search->query->get('q'))) {
             $query
                ->andWhere('p.bikeProducer LIKE :q')
                ->setParameter('q', "%{$search->query->get('q')}%");
        }
        if (!empty($search->query->get('year'))) {
             $query
                ->andWhere('p.year = :val ')
                ->setParameter('val', "{$search->query->get('year')}");
        }
        if (!empty($search->query->get('bikeProducer'))) {
             $query
                ->andWhere('p.bikeProducer LIKE :val2')
                ->setParameter('val2', "%{$search->query->get('bikeProducer')}%");
        }
        $res = $query->getQuery();
        return $res->getResult();
    }

    
    
}
