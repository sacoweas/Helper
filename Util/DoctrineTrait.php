<?php

namespace SW\Helper\Util;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Doctrine
 * @package SW\HelperBundle\Helper
 */
trait DoctrineTrait
{
    /**
     * @return Registry
     */
    abstract protected function getDoctrine();

    /**
     * @param $object
     * @param null $manager
     * @return ObjectRepository
     */
    protected function getRepository($object, $manager = null)
    {
        return $this->getDoctrineManager($manager)->getRepository(is_object($object) ? get_class($object) : $object);
    }

    /**
     * @param null $manager
     * @return ObjectManager
     */
    protected function em($manager = null)
    {
        return $this->getDoctrineManager($manager);
    }

    /**
     * @param null $manager
     * @return ObjectManager
     */
    protected function getDoctrineManager($manager = null)
    {
        return $this->getDoctrine()->getManager($manager);
    }

    /**
     * @param $object
     * @param bool $flush
     * @param null $manager
     * @return boolean
     */
    protected function persist($object, $flush = false, $manager = null)
    {
        if (null === $object) {
            return false;
        }

        $this->getDoctrineManager($manager)->persist($object);

        if ($flush) {
            $this->flush($manager);
        }

        return true;
    }

    /**
     * @param null $manager
     * @return void
     */
    protected function flush($manager = null)
    {
        $this->getDoctrineManager($manager)->flush();
    }

    /**
     * @param $object
     * @param null $manager
     * @return void
     */
    protected function update($object, $manager = null)
    {
        $this->persist($object, true, $manager);
    }

    /**
     * @param $object
     * @param null $manager
     * @return mixed
     */
    protected function merge($object, $manager = null)
    {
        return $this->getDoctrineManager($manager)->merge($object);
    }

    /**
     * @param $object
     * @param null $manager
     * @return void
     */
    protected function detach($object, $manager = null)
    {
        $this->getDoctrineManager($manager)->detach($object);
    }

    /**
     * @param $object
     * @param bool $flush
     * @param null $manager
     * @return boolean
     */
    protected function remove($object, $flush = false, $manager = null)
    {
        if (null === $object) {
            return false;
        }

        $this->getDoctrineManager($manager)->remove($object);

        if ($flush) {
            $this->flush($manager);
        }

        return true;
    }
}
