<?php
declare(strict_types=1);

namespace App\Disk\Framework\Repository;

use App\{{boundedContext}}\Domain\Entity\Disk as DomainDisk;
use App\{{boundedContext}}\Domain\Repository\DiskRepositoryContract;
use App\{{boundedContext}}\Framework\Entity\Disk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Disk>
*
* @method DomainDisk|null find($id, $lockMode = null, $lockVersion = null)
* @method DomainDisk|null findOneBy(array $criteria, array $orderBy = null)
* @method DomainDisk[]    findAll()
* @method DomainDisk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
final class DiskRepository extends ServiceEntityRepository implements DiskRepositoryContract
{
public function __construct(ManagerRegistry $registry,)
{
parent::__construct($registry, Disk::class);
}

public function add(DomainDisk $domainDisk): void
{
// TODO: Implement add() method.
}

public function remove(DomainDisk $domainDisk, bool $flush = false): void
{
// TODO: Implement remove() method.
}
}
