<?php

namespace SW\Helper\Controller;

use SW\Helper\Util\ErrorsTrait;
use SW\Helper\Util\DoctrineTrait;
use SW\Helper\Util\SessionTrait;
use FOS\RestBundle\Controller\FOSRestController as BaseController;

/**
 * Class Controller
 * @package SW\Helper\Controller
 */
class Controller extends BaseController
{
    use ErrorsTrait, DoctrineTrait, SessionTrait;
}
