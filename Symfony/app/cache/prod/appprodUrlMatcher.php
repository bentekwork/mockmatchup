<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = urldecode($pathinfo);

        // MockMobileBundle_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\MobileBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'MockMobileBundle_homepage'));
        }

        // MockUserBundle_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\UserBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'MockUserBundle_homepage'));
        }

        // MockMatchBundle_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\MatchBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'MockMatchBundle_homepage'));
        }

        // matchup_home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'matchup_home');
            }
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::homeAction',  '_route' => 'matchup_home',);
        }

        // user_login
        if ($pathinfo === '/signin') {
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::loginAction',  '_route' => 'user_login',);
        }

        // user_register
        if ($pathinfo === '/signup') {
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::registerAction',  '_route' => 'user_register',);
        }

        // user
        if ($pathinfo === '/user') {
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::indexAction',  '_route' => 'user',);
        }

        // user_show
        if (0 === strpos($pathinfo, '/user') && preg_match('#^/user/(?P<id>[^/]+?)/show$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::showAction',)), array('_route' => 'user_show'));
        }

        // user_new
        if ($pathinfo === '/user/new') {
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::newAction',  '_route' => 'user_new',);
        }

        // user_create
        if ($pathinfo === '/user/create') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_user_create;
            }
            return array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::createAction',  '_route' => 'user_create',);
        }
        not_user_create:

        // user_edit
        if (0 === strpos($pathinfo, '/user') && preg_match('#^/user/(?P<id>[^/]+?)/edit$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::editAction',)), array('_route' => 'user_edit'));
        }

        // user_update
        if (0 === strpos($pathinfo, '/user') && preg_match('#^/user/(?P<id>[^/]+?)/update$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_user_update;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::updateAction',)), array('_route' => 'user_update'));
        }
        not_user_update:

        // user_delete
        if (0 === strpos($pathinfo, '/user') && preg_match('#^/user/(?P<id>[^/]+?)/delete$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_user_delete;
            }
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Mock\\UserBundle\\Controller\\UserController::deleteAction',)), array('_route' => 'user_delete'));
        }
        not_user_delete:

        // matchup
        if ($pathinfo === '/matchup') {
            return array (  '_controller' => 'Mock\\MatchBundle\\Controller\\DefaultController::indexAction',  '_route' => 'matchup',);
        }

        // matchup_settings
        if ($pathinfo === '/matchup/settings') {
            return array (  '_controller' => 'Mock\\MatchBundle\\Controller\\DefaultController::settingsAction',  '_route' => 'matchup_settings',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
