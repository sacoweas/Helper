<?php

namespace SW\Helper\Util;


use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Session
 * @package SW\HelperBundle\Helper
 */
trait SessionTrait
{
    /**
     * @param $id
     * @return mixed
     */
    abstract protected function get($id);

    /**
     * @return Session
     */
    protected function session()
    {
        return $this->get('session');
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function hasSession($key)
    {
        return $this->session()->has($key);
    }

    /**
     * @return array
     */
    protected function allSession()
    {
        return $this->session()->all();
    }

    /**
     * @param string $key
     * @return mixed
     */
    protected function getSession($key)
    {
        return $this->session()->get($key);
    }

    /**
     * @param string $key
     * @param $data
     * @return void
     */
    protected function setSession($key, $data)
    {
        $this->session()->set($key, $data);
    }
}
