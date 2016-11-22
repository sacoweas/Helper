<?php

namespace SW\Helper\Repository;

/**
 * Class Repository
 * @package SW\Helper\Repository
 */
trait RepositoryTrait
{
    /**
     * @return mixed
     */
    public function create()
    {
        $className = $this->getClassName();

        return new $className();
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function save($entity)
    {
        $this->persist($entity, true);

        return $this;
    }

    /**
     * @param $entity
     * @param bool $flush
     * @return mixed
     */
    public function persist($entity, $flush = false)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $this;
    }

    /**
     * @param $entity
     * @param bool $flush
     * @return void
     */
    public function remove($entity, $flush = false)
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return void
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
