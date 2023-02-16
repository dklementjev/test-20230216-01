<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Country>
 *
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function save(Country $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Country $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById(?string $id): ?Country
    {
        if (empty($id)) {
            return null;
        }

        return $this->createQueryBuilder("c")
            ->andWhere("c.id=:id")
            ->setParameter("id", $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getByTaxIDPrefix(?string $prefix): ?Country
    {
        if (empty($prefix)) {
            return null;
        }

        return $this->createQueryBuilder("c")
            ->andWhere("c.taxIDPrefix=:tax_id_prefix")
            ->setParameter("tax_id_prefix", $prefix)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
