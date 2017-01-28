<?php

namespace SW\Helper\Util;


/**
 * Class Errors
 * @package AppBundle\Controller\Base
 */
trait ErrorsTrait
{
    /**
     * @param string $message
     */
    protected function NotFound($message = 'Not Found')
    {
        throw $this->createNotFoundException($message);
    }

    /**
     * @param $condition
     * @param string $message
     */
    protected function NotFoundUnless($condition, $message = 'Not Found')
    {
        if (!$condition) {
            $this->NotFound($message);
        }
    }

    /**
     * @param $condition
     * @param string $message
     */
    protected function NotFoundIf($condition, $message = 'Not Found')
    {
        if ($condition) {
            $this->NotFound($message);
        }
    }

    /**
     * @param string $message
     */
    protected function AccessDenied($message = 'Access Denied.')
    {
        throw $this->createAccessDeniedException($message);
    }

    /**
     * @param $condition
     * @param string $message
     */
    protected function AccessDeniedIf($condition, $message = 'Access Denied.')
    {
        if ($condition) {
            $this->AccessDenied($message);
        }
    }

    /**
     * @param $condition
     * @param string $message
     */
    protected function AccessDeniedUnless($condition, $message = 'Access Denied.')
    {
        if (!$condition) {
            $this->AccessDenied($message);
        }
    }

    /**
     * @param string $message
     */
    protected function Error($message = 'Error')
    {
        throw new \LogicException($message);
    }
}
