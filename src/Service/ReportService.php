<?php
namespace App\Service;

use App\Entity\Report;
use App\Entity\User;
use App\Entity\Place;
use Doctrine\ORM\EntityManagerInterface;

class ReportService
{
    public function __construct(private EntityManagerInterface $em) {}

    public function addReport(string $name, User $user, Place $place, \DateTimeInterface $exportDateTime): Report
    {
        $report = new Report();
        $report->setName($name)
               ->setUser($user)
               ->setPlace($place)
               ->setExportDateTime($exportDateTime);

        $this->em->persist($report);
        $this->em->flush();

        return $report;
    }
}