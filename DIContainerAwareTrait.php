<?php

namespace SW\Helper;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;

trait DIContainerAwareTrait
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     *
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container")
     * })
     *
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function has($id)
    {
        return $this->container->has($id);
    }

    /**
     * @param $id
     * @param int $invalidBehavior
     * @return mixed
     */
    protected function get($id, $invalidBehavior = ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->container->get($id, $invalidBehavior);
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getParameter($name)
    {
        return $this->container->getParameter($name);
    }
}
