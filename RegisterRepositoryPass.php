<?php

namespace SW\Helper;


use SW\Helper\Util\ClassFinder;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterRepositoryPass
 * @package SW\HelperBundle\DependencyInjection\Compiler
 */
class RegisterRepositoryPass implements CompilerPassInterface
{
    /**
     * @var BundleInterface
     */
    private $bundle;

    /**
     * @var ClassFinder
     */
    private $classFinder;

    /**
     * RegisterRepositoryCompilerPass constructor.
     * @param BundleInterface $bundle
     * @param null $classFinder
     */
    public function __construct(BundleInterface $bundle, ClassFinder $classFinder = null)
    {
        $this->bundle = $bundle;
        $this->classFinder = $classFinder ?: new ClassFinder;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('doctrine')) {
            return;
        }

        $directory = $this->bundle->getPath().'/Entity';
        $namespace = $this->bundle->getNamespace().'\Entity';

        $classes = $this->classFinder->findClassesMatching(
            $directory, $namespace, '(?<!Repository)$'
        );

        foreach ($classes as $class) {
            if (0 === !strpos($class, $this->bundle->getNamespace())) {
                continue;
            }

            $ref = new \ReflectionClass($class);
            $id = sprintf('%s_repository', Container::underscore($ref->getShortName()));

            if ($container->hasDefinition($id)) {
                continue;
            }

            $definition = new Definition();
            $definition->setClass(ObjectRepository::class);
            $definition->setFactory([new Reference('doctrine'), 'getRepository']);
            $definition->setArguments([$class]);

            $container->setDefinition($id, $definition);
        }
    }
}
