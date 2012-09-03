<?php

namespace Mock\MatchBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Mock\UserBundle\Entity\MockOauth;

class Matchup 
{
	
	public $season;
	public $league;
	public $left_team_name;
	public $right_team_logo;
	public $week;
	public $categories;
	public $scores;
	public $access_token;
	public $access_token_secret;
	
  function __construct($key, $secret, $access_token, $access_token_secret) {
	//lookup most of the object from match_settings
    $this->key = $key;
    $this->secret = $secret;
    $this->access_token = $access_token;
    $this->access_token_secret = $access_token_secret;

  }

  function buildMatchup($league, $week, $left_team_key, $right_team_key){
	$matchup = new MockOauth($this->key, $this->secret);
	$league_request = $matchup->getRequest($this->access_token, $this->access_token_secret, 'http://fantasysports.yahooapis.com/fantasy/v2/league/'.$league.';out=teams,settings');
	$left_request = $matchup->getRequest($this->access_token, $this->access_token_secret, 'http://fantasysports.yahooapis.com/fantasy/v2/team/'.$left_team_key.'/stats;type=week;week='.$week.'');
	$right_request = $matchup->getRequest($this->access_token, $this->access_token_secret, 'http://fantasysports.yahooapis.com/fantasy/v2/team/'.$right_team_key.'/stats;type=week;week='.$week.'');	
	if($league_request and $left_request and $right_request){
		$teams_xml = simplexml_load_string($league_request);
		$left_xml = simplexml_load_string($left_request);
		$right_xml = simplexml_load_string($right_request);
		for($i=0; $i <= (string)$teams_xml->league->current_week; $i++){
			$weeks[] = array('num' => $i, 'named' => 'Week '.$i); 
		}
		$this->weeks = $weeks;
		foreach($teams_xml->league->teams->team as $team){
			$teams[] = array(
				'name' => (string) $team->name,
				'logo' => (string) $team->team_logos->team_logo->url,
				'team_key' => (string) $team->team_key,
			);
		}
		$this->teams = $teams;
		foreach($teams_xml->league->settings->stat_categories->stats->stat as $category){
			if($category->is_only_display_stat != 1){
				$categories[(string) $category->stat_id] = array(
					'cat_name' => (string) $category->display_name,
					'sort_order' => (string) $category->sort_order
				);
			}
		}
		$this->categories = $categories;
		foreach($left_xml->team->team_stats->stats->stat as $left_stat){
			$left_stats[(string)$left_stat->stat_id] = array(
				'left_value' => (string) $left_stat->value
			);
		}
		$this->left_stats = $left_stats;
		foreach($right_xml->team->team_stats->stats->stat as $right_stat){
			$right_stats[(string) $right_stat->stat_id] = array(
				'right_value' => (string) $right_stat->value
			);
		}
		$this->right_stats = $right_stats;
	} else {
		return false;
	}
	
  }
  function buildScoreboard(){
	foreach($this->categories as $key => $cat){
		$scoreboard[$key]['cat_name'] = $cat['cat_name'];
		$scoreboard[$key]['sort_order'] = $cat['sort_order'];

		foreach($this->left_stats as $lkey => $lstat){
			if($lkey == $key){
				$scoreboard[$key]['left_stat'] = $lstat['left_value']; 
			}
		}
		foreach($this->right_stats as $rkey => $rstat){
			if($rkey == $key){
				$scoreboard[$key]['right_stat'] = $rstat['right_value']; 
			}
		}
		if($scoreboard[$key]['right_stat'] > $scoreboard[$key]['left_stat']){		
			$scoreboard[$key]['stat_winner'] = ($scoreboard[$key]['sort_order'] == 0) ? 'left_team' : 'right_team';
		} elseif($scoreboard[$key]['right_stat'] == $scoreboard[$key]['left_stat']) {
			$scoreboard[$key]['stat_winner'] = 'tie';			
		} else {
			$scoreboard[$key]['stat_winner'] = ($scoreboard[$key]['sort_order'] == 0) ? 'right_team' : 'left_team';
		}
	}
	$totals = array();
	$totals['left_team'] = 0;
    $totals['right_team'] = 0;
	foreach($scoreboard as $s){
		if($s['stat_winner'] == 'left_team'){
			$totals['left_team']++;
		}
		if($s['stat_winner'] == 'right_team'){
			$totals['right_team']++;
		}
	}
	$this->total = $totals;
	$this->scoreboard = $scoreboard;
  }
  function getLeagues() {
	
	$matchup = new MockOauth($this->key, $this->secret);
	$lrequest = $matchup->getRequest($this->access_token, $this->access_token_secret, 'http://fantasysports.yahooapis.com/fantasy/v2/users;use_login=1/games/leagues');
	$l_xml = simplexml_load_string($lrequest);
	foreach($l_xml->users->user->games->game as $game){
		$leagues[] = array(
			'league_key' => (string) $game->leagues->league->league_key,
			'season' => (string) $game->season,
		);
	}
	$this->leagues = $leagues;
  }

}