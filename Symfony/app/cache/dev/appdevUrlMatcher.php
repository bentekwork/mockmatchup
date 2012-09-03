<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        // _wdt
        if (preg_match('#^/_wdt/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]+?)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?P<token>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]+?)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

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