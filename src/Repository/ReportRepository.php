<?php
namespace App\Repository;

use App\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findByFilters(?int $placeId, ?\DateTimeInterface $startDate, ?\DateTimeInterface $endDate): array
    {
        $qb = $this->createQueryBuilder('r');

        if ($placeId) {
            $qb->andWhere('r.place = :placeId')
               ->setParameter('placeId', $placeId);
        }

        if ($startDate) {
            $qb->andWhere('r.exportDateTime >= :startDate')
               ->setParameter('startDate', $startDate->format('Y-m-d 00:00:00'));
        }

        if ($endDate) {
            $qb->andWhere('r.exportDateTime <= :endDate')
               ->setParameter('endDate', $endDate->format('Y-m-d 23:59:59'));
        }

        return $qb->orderBy('r.exportDateTime', 'DESC')
                  ->getQuery()
                  ->getResult();
    }
}