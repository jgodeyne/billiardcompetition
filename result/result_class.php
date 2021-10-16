<?php
include_once("../ppa/entity_class.php");


class Result extends Entity implements EntityInterface {
	
	private $points;
	private $innings;
	private $average;
	private $highest_run;
	private $matchpoints;
	private $bonuspoints;
	private $rankingpoints;
	private $player_id;
	private $match_id;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->setPoints(htmlspecialchars($post['points']));
		$this->setInnings(htmlspecialchars($post['innings']));
		$this->setAverage(htmlspecialchars($post['average']));
		$this->setHighestRun(htmlspecialchars($post['highest_run']));
		$this->setMatchpoints(htmlspecialchars($post['matchpoints']));
		$this->setBonuspoints(htmlspecialchars($post['bonuspoints']));
		$this->setRankingpoints(htmlspecialchars($post['rankingpoints']));
		$this->setPlayerId(htmlspecialchars($post['player_id']));
		$this->setMatchId(htmlspecialchars($post['match_id']));
	}
	
	/*
	 * Getters and Setters
	 *  
	 */
	public function getPoints()
	{
	    return $this->points;
	}

	public function setPoints($points)
	{
	    $this->points = $points;
	}
	public function getInnings()
	{
	    return $this->innings;
	}

	public function setInnings($innings)
	{
	    $this->innings = $innings;
	}
	public function getAverage()
	{
	    return $this->average;
	}

	public function setAverage($average)
	{
	    $this->average = $average;
	}
	
	public function getHighestRun()
	{
	    return $this->highest_run;
	}

	public function setHighestRun($highest_run)
	{
	    $this->highest_run = $highest_run;
	}
	public function getMatchPoints()
	{
	    return $this->matchpoints;
	}

	public function setMatchpoints($matchpoints)
	{
	    $this->matchpoints = $matchpoints;
	}
	public function getBonuspoints()
	{
	    return $this->bonuspoints;
	}

	public function setBonuspoints($bonuspoints)
	{
	    $this->bonuspoints = $bonuspoints;
	}

	public function getRankingpoints()
	{
	    return $this->rankingpoints;
	}

	public function setRankingpoints($rankingpoints)
	{
	    $this->rankingpoints = $rankingpoints;
	}

	public function getPlayerId()
	{
	    return $this->player_id;
	}

	public function setPlayerId($player_id)
	{
	    $this->player_id = $player_id;
	}

	public function getMatchId()
	{
	    return $this->match_id;
	}

	public function setMatchId($match_id)
	{
	    $this->match_id = $match_id;
	}
		
	
	public static function findByMatchIdAndPlayerId($match_id, $player_id) {
		$result = Result::findByCriteria("match_id = '" . $match_id . "' and player_id='" . $player_id . "'");
		return $result;
	}
	
	public static function findByPlayerId($player_id) {
		$result = Result::findAllByCriteria("player_id='" . $player_id . "'");
		return $result;
	}

}
?>