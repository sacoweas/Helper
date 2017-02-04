<?php

namespace SW\Helper\Controller;

use SW\Helper\Util\ErrorsTrait;
use SW\Helper\Util\DoctrineTrait;
use SW\Helper\Util\SessionTrait;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use FOS\RestBundle\Controller\FOSRestController as BaseController;

/**
 * Class Controller
 * @package SW\Helper\Controller
 */
class Controller extends BaseController
{
    use ErrorsTrait, DoctrineTrait, SessionTrait;

    /**
     * @var
     */
    private $expression;

    protected function handleForm(Form $form, Request $request)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        }
    }

    /**
     * @return mixed
     */
    protected function mailer()
    {
        if (!$this->has('mailer')) {
            $this->Error('The mailer is not registered in your application.');
        }
        return $this->get('mailer');
    }

    /**
     * @return mixed
     */
    protected function security()
    {
        if (!$this->has('security.context')) {
            $this->Error('The security.context is not registered in your application.');
        }
        return $this->get('security.context');
    }

    /**
     * @return mixed
     */
    protected function kernel()
    {
        if (!$this->has('kernel')) {
            $this->Error('The kernel is not registered in your application.');
        }
        return $this->get('kernel');
    }

    /**
     * @return mixed
     */
    protected function getWebBundlesDir()
    {
        return $this->getRootDir() . '/../web/bundles';
    }

    /**
     * @return mixed
     */
    protected function getRootDir()
    {
        return $this->kernel()->getRootDir();
    }

    public function getExpresion()
    {
        if (null === $this->expression) {
            $this->expression = new ExpressionLanguage();
        }
        return $this->expression;
    }
}
