<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PDO;

/**
 * Class Note
 * @package AppBundle\Repository
 */
class Note extends EntityRepository
{
    /**
     * @param int $firstResult
     * @param int $maxResult
     * @param string $order
     * @return array
     */
    public function getIntervalNews($firstResult = 0, $maxResult = 10, $order = 'ASC')
    {
        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $query = $qb->select('n.*')
            ->from($this->getClassMetadata()->getTableName(), 'n')
            ->orderBy('n.publish_date_time', $order)
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResult);

        return $query->execute()->fetchAll();
    }

    /**
     * @return mixed
     */
    public function countNews(){

        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $query = $qb->select('count(n.id)')
            ->from($this->getClassMetadata()->getTableName(), 'n');
        return  $query->execute()->fetch(PDO::FETCH_COLUMN);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItemById($id){

        $qb = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $query = $qb->select('n.*')
            ->from($this->getClassMetadata()->getTableName(), 'n')
            ->where('n.id = :id')
            ->setParameter('id', $id);
        return  $query->execute()->fetch();
    }
}