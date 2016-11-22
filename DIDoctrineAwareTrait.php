<?php

namespace SW\Helper;

use SW\HelperBundle\Helper\DoctrineTrait;
use Doctrine\Bundle\DoctrineBundle\Registry;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class DIDoctrineAwareTrait
 * @package AppBundle\DependencyInjection
 */
trait DIDoctrineAwareTrait
{
    use DoctrineTrait;

    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     *
     * @DI\InjectParams({
     *     "doctrine" = @DI\Inject("doctrine")
     * })
     *
     * Sets doctrine.
     *
     * @param Registry|null $doctrine a RegistryInterface instance or null
     */
    public function setDoctrine(Registry $doctrine = null)
    {
        $this->doctrine = $doctrine;
    }

    protected function getDoctrine()
    {
        return $this->doctrine;
    }
}
