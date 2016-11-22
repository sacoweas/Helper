<?php

namespace SW\Helper\Util;


use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class ClassFinder
 * @package SW\Helper\Helper
 */
class ClassFinder
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * ClassFinder constructor.
     * @param Finder|null $finder
     * @param Filesystem|null $filesystem
     */
    public function __construct(Finder $finder = null, Filesystem $filesystem = null)
    {
        $this->finder = $finder ?: new Finder();
        $this->filesystem = $filesystem ?: new Filesystem();
    }

    /**
     * @param $directory
     * @param $namespace
     * @return array
     */
    public function findClasses($directory, $namespace)
    {
        if (false === $this->filesystem->exists($directory)) {
            return array();
        }

        $classes = array();
        $this->finder->files();
        $this->finder->name('*.php');
        $this->finder->in($directory);

        foreach ($this->finder->getIterator() as $name) {
            $baseName = substr($name, strlen($directory)+1, -4);
            $baseClassName = str_replace('/', '\\', $baseName);
            $classes[] = $namespace.'\\'.$baseClassName;
        }

        return $classes;
    }

    /**
     * @param $directory
     * @param $namespace
     * @param $pattern
     * @return array
     */
    public function findClassesMatching($directory, $namespace, $pattern)
    {
        $pattern = sprintf('#%s#', str_replace('#', '\#', $pattern));
        $matches = function ($path) use ($pattern) { return preg_match($pattern, $path); };

        return array_values(array_filter($this->findClasses($directory, $namespace), $matches));
    }

    /**
     * @param array $classes
     * @param $interface
     * @return array
     */
    public function filterClassesImplementing(array $classes, $interface)
    {
        return array_filter($classes, function ($class) use ($interface) {
            return (new \ReflectionClass($class))->isSubclassOf($interface);
        });
    }
}
