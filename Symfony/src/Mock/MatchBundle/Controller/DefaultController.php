<?php

namespace Mock\MatchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mock\UserBundle\Entity\MockOauth;
use Mock\MatchBundle\Entity\Matchup;
use JMS\SecurityExtraBundle\Annotation\Secure;


class DefaultController extends Controller
{ 
   /**
     * Lists all MatchupSettings entities.
     *
     * @Route("matchup", name="matchup")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
		$request = $this->getRequest();
		$user = $this->get('security.context')->getToken()->getUser();
		$league = $user->league;
		$week = $request->request->get('week');
		$left_team_key = $request->request->get('left_team_key');
		$right_team_key = $request->request->get('right_team_key');
		$key = $this->container->getParameter('oauth_key');
		$secret = $this->container->getParameter('oauth_secret');
		if($league and $week and $left_team_key and $right_team_key){
			$user = $this->get('security.context')->getToken()->getUser();
			$o = new MockOauth($key, $secret);
			$o->refreshAccesstoken($user->getAccessToken(), $user->getAccessTokenSecret(), $user->getOauthSessionHandle(), '');
		
			$matchup = new Matchup($key, $secret, $o->access_token, $o->access_token_secret);		
			$matchup->buildMatchup($league, $week, $left_team_key, $right_team_key);
			$matchup->buildScoreboard();
	        return $this->render('MockMatchBundle:Default:index.html.twig', array(
								'teams' => $matchup->teams, 
								'categories' => $matchup->categories, 
								'scoreboard' => $matchup->scoreboard,
								'weeks' => $matchup->weeks,
								'total' => $matchup->total,
								'left_team_key' => $left_team_key,
								'right_team_key' => $right_team_key,
								'selected_week' => $week 
								)
							);
		} elseif ($league) {
			$user = $this->get('security.context')->getToken()->getUser();
			$o = new MockOauth($key, $secret);
			$o->refreshAccesstoken($user->getAccessToken(), $user->getAccessTokenSecret(), $user->getOauthSessionHandle(), '');
		
			$matchup = new Matchup($key, $secret, $o->access_token, $o->access_token_secret);		
			$matchup->buildMatchup($league, 1, $league.'.t.1', $league.'.t.1');
			$matchup->buildScoreboard();
			
			return $this->render('MockMatchBundle:Default:index.html.twig', array(
								'teams' => $matchup->teams, 
								'categories' => $matchup->categories, 
								'scoreboard' => $matchup->scoreboard,
								'weeks' => $matchup->weeks,
								'total' => $matchup->total,
								'left_team_key' => $league.'.t.1',
								'right_team_key' => $league.'.t.1',
								'selected_week' => 1
								)
							);
		} else {
				
			return $this->redirect('/matchup/settings');
		}
    }
   /**
     * Lists all MatchupSettings entities.
     *
     * @Route("matchup/settings", name="matchup_settings")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function settingsAction(){
		$request = $this->getRequest();
		$league = $request->request->get('league');
		$user = $this->get('security.context')->getToken()->getUser();
		if($league){
			$em = $this->getDoctrine()->getEntityManager();
			$existing_user = $em->getRepository('MockUserBundle:User')->findOneByUsername($user->getUsername());
			$existing_user->league = $league;
			$em->flush();
			return $this->redirect('/matchup');
			
		}
		$key = $this->container->getParameter('oauth_key');
		$secret = $this->container->getParameter('oauth_secret');
		$o = new MockOauth($key, $secret);
		$o->refreshAccesstoken($user->getAccessToken(), $user->getAccessTokenSecret(), $user->getOauthSessionHandle(), '');
		$matchup = new Matchup($key, $secret, $o->access_token, $o->access_token_secret);		
		$matchup->getLeagues();
		return $this->render('MockMatchBundle:Default:settings.html.twig', array(
							'leagues' => $matchup->leagues, 
							'selected_league' => $user->league, 
							)
						);
	}
}
