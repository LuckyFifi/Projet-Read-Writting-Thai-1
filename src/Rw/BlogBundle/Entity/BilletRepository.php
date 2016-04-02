<?php

namespace Rw\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BilletRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BilletRepository extends EntityRepository
{
	public function myFindAll()
	{
		$queryBuilder = $this->createQueryBuilder('a')
			->leftJoin('a.comments', 'com')
			->addSelect('com')
		;
		$queryBuilder
			->orderBy('a.date', 'DESC')
		;
		// On récupère la Query à partir du QueryBuilder
		$query = $queryBuilder->getQuery();
		// On récupère les résultats à partir de la Query
		$results = $query->getResult();
		// On retourne ces résultats
		return $results;
	}
}
