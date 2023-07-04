<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Cars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Cars>
 *
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Cars::class);
        $this->paginator = $paginator;
    }

    public function save(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cars $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSearch(SearchData $search): PaginationInterface
    {

        $query = $this
            ->createQueryBuilder('c')
            ->select('c', 'm', 'b', 't')
            ->join('c.type', 't')
            ->join('c.model', 'm')
            ->join('m.brand', 'b');

        if (!empty($search->priceMin)) {
            $query = $query
                ->andWhere('c.price >= :priceMin')
                ->setParameter('priceMin', $search->priceMin);
        }

        if (!empty($search->priceMax)) {
            $query = $query
                ->andWhere('c.price <= :priceMax')
                ->setParameter('priceMax', $search->priceMax);
        }

        if (!empty($search->kmMin)) {
            $query = $query
                ->andWhere('c.km >= :kmMin')
                ->setParameter('kmMin', $search->kmMin);
        }

        if (!empty($search->kmMax)) {
            $query = $query
                ->andWhere('c.km <= :kmMax')
                ->setParameter('kmMax', $search->kmMax);
        }

        if (!empty($search->brands)) {
            $query = $query
                ->andWhere('b.id IN (:brands)')
                ->setParameter('brands', $search->brands);
        }

        if (!empty($search->models)) {
            $query = $query
                ->andWhere('m.id IN (:models)')
                ->setParameter('models', $search->models);
        }

        if (!empty($search->types)) {
            $query = $query
                ->andWhere('t.id IN (:types)')
                ->setParameter('types', $search->types);
        }

        //return $query->getQuery()->getResult();

        $query = $query->getQuery();

        return $this->paginator->paginate(
            $query,
            $search->page,
            12
        );
    }

    //    /**
    //     * @return Cars[] Returns an array of Cars objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cars
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
