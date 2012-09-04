<?php

namespace Mock\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mock\UserBundle\Entity\User;
use Mock\UserBundle\Entity\MockOauth;
use Mock\UserBundle\Entity\LightOpenID;
use Mock\UserBundle\Form\UserType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
	
	/**
     * Lists all MatchupSettings entities.
     *
     * @Route("/", name="matchup_home")
     * @Secure(roles="ROLE_USER")
     */
    public function homeAction()
    {
	
		return $this->redirect('/matchup');
		
	}
	/**
     * Login form to authenticate using yahoo's credentials
     *
     * @Route("signin", name="user_login")
     * @Template()
     */
    public function loginAction(){
		$key = $this->container->getParameter('oauth_key');
		$secret = $this->container->getParameter('oauth_secret');
   		$request = $this->getRequest();
		$identifier = $request->request->get('openid_identifier');
		$existing_user = '';
		
		//first check for current session if there is one redirect to matchup
		if($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')){
			return $this->redirect('/matchup');
		}
	
		//2nd check if user is in the db.
		if($identifier){
			$em = $this->getDoctrine()->getEntityManager();
			$existing_user = $em->getRepository('MockUserBundle:User')->findOneByUsername($identifier);
		} 
		$openid_domain = $this->container->getParameter('oauth_domain');
		$openid = new LightOpenID($openid_domain, $key);
		//3rd if the user does exist in db attempt to authenticate them with yahoo
		if($existing_user or (is_object($openid) and !$identifier and $openid->mode)){
		 	if($identifier and !$openid->mode){
				$openid->identity = $identifier;
				$openid->required = array('contact/email', 'person/guid');
	            $openid->optional = array('namePerson', 'namePerson/friendly');
				$url = $openid->authUrl(false, false); 
				//print_r($openid->authUrl());
				return $this->redirect($url);
			}
			else if($openid->mode == 'cancel') {
				$form = 'Cancelled';
			} else {
				$attributes = $openid->getAttributes();
				$em = $this->getDoctrine()->getEntityManager();
				$existing_user = $em->getRepository('MockUserBundle:User')->findOneByUsername($attributes['openid_ax_value_email']);
				
				// create the authentication token
				$token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($existing_user, null, 'main', $existing_user->getRoles());
				// give it to the security context
				$this->container->get('security.context')->setToken($token);
				return $this->redirect('/matchup');
			} 
	   } elseif(!$identifier) {
			$message = '';
			return array('message' => $message);
			
	   } else {
			$message = 'You have not yet registered.  Please register first';
			return array('message' => $message); 
	   }
	}
    /**
     * Register form to authenticate using yahoo's credentials
     *
     * @Route("signup", name="user_register")
     * @Template()
     */
    public function registerAction(){
		$key = $this->container->getParameter('oauth_key');
		$secret = $this->container->getParameter('oauth_secret');
   		$request = $this->getRequest();
		$identifier = $request->request->get('openid_identifier');
		$openid_domain = $this->container->getParameter('oauth_domain');
		$openid = new LightOpenID($openid_domain, $key);
	   	$form = 'balls';
	 	if($identifier && !$openid->mode){
			$openid->identity = $identifier;
			$openid->required = array('contact/email', 'person/guid');
            $openid->optional = array('namePerson', 'namePerson/friendly');
			$url = $openid->authUrl(false, true); 
			//print_r($openid->authUrl());
			return $this->redirect($url);
		}
		else if($openid->mode == 'cancel') {
			$form = 'Cancelled';
		} elseif (!$identifier && $openid->mode) {
			$attributes = $openid->getAttributes();
			//Create User in DB or Lookup User in DB (Maybe refresh and existing token -- maybe not needed...)
			$em = $this->getDoctrine()->getEntityManager();
			$existing_user = $em->getRepository('MockUserBundle:User')->findOneByUsername($attributes['openid_ax_value_email']);
			//Get access token
			$o = new MockOauth($key, $secret);
			$o->getAccesstoken($attributes['openid_oauth_request_token']);
			
			//Save it to the new/existing user for later refreshing.
			if($existing_user){
				$existing_user->setAccessToken($o->access_token);
				$existing_user->setAccessTokenSecret($o->access_token_secret);
				$existing_user->setVerifier($o->verifier);
				$existing_user->setOauthSessionHandle($o->oauth_session_handle);
				$em->flush();
				// create the authentication token
				$token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($existing_user, null, 'main', $existing_user->getRoles());
				// give it to the security context
				$this->container->get('security.context')->setToken($token);
			} else {
				$new_user = new User();
				$new_user->setUsername($attributes['openid_ax_value_email']);
				$new_user->setSalt($attributes['openid_ax_value_email']);
				$new_user->setPassword($attributes['openid_ax_value_email']);
				$new_user->setAccessToken($o->access_token);
				$new_user->setAccessTokenSecret($o->access_token_secret);
				$new_user->setGuid($o->xoauth_yahoo_guid);
				$new_user->setVerifier($attributes['openid_ax_value_email']);
				$new_user->setOauthSessionHandle($o->oauth_session_handle);
				$em->persist($new_user);
	            $em->flush();
				// create the authentication token
				$token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($new_user, null, 'main', $new_user->getRoles());
				// give it to the security context
				$this->container->get('security.context')->setToken($token);
			}
			//TODO redirect the user somewhere preferably the app itself which currently doesn't exist
			return $this->redirect('/matchup');
			
			
		} else{
			return array('form' => $form);
		}
	}
     /**
     * Lists all User entities.
     *
     * @Route("user", name="user")
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('MockUserBundle:User')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("user/{id}/show", name="user_show")
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MockUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("user/new", name="user_new")
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createForm(new UserType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new User entity.
     *
     * @Route("user/create", name="user_create")
     * @Method("post")
     * @Secure(roles="ROLE_ADMIN")
     * @Template("MockUserBundle:User:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new User();
        $request = $this->getRequest();
        $form    = $this->createForm(new UserType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("user/{id}/edit", name="user_edit")
     * @Secure(roles="ROLE_ADMIN")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MockUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing User entity.
     *
     * @Route("user/{id}/update", name="user_update")
     * @Method("post")
     * @Secure(roles="ROLE_ADMIN")
     * @Template("MockUserBundle:User:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('MockUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm   = $this->createForm(new UserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a User entity.
     *
     * @Route("user/{id}/delete", name="user_delete")
     * @Secure(roles="ROLE_ADMIN")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('MockUserBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
