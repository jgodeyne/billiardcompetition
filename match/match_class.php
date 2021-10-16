<?php
include_once("../ppa/entity_class.php");
include_once '../common/date_functions.php';

class Match extends Entity implements EntityInterface {
	
	private $date;
	private $place;
	private $round;
	private $player_1_id;
	private $player_2_id;
	private $competition_id;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->setDate(htmlspecialchars($post['date']));
		$this->setPlace(htmlspecialchars($post['place']));
		$this->setRound(htmlspecialchars($post['round']));
		$this->setPlayer1Id(htmlspecialchars($post['player_1_id']));
		$this->setPlayer2Id(htmlspecialchars($post['player_2_id']));
		$this->setCompetitionId(htmlspecialchars($post['competition_id']));
	}
	
	/*
	 * Getters and Setters
	 *  
	 */
	public function getDate()
	{
	    return convertUSToEuroDate($this->date);
	}

	public function setDate($date)
	{
	    $this->date = convertEuroToUSDate($date);
	}
	public function getPlace()
	{
	    return $this->place;
	}

	public function setPlace($place)
	{
	    $this->place = $place;
	}
	public function getRound()
	{
	    return $this->round;
	}

	public function setRound($round)
	{
	    $this->round = $round;
	}
	public function getPlayer1Id()
	{
	    return $this->player_1_id;
	}

	public function setPlayer1Id($player_1_id)
	{
	    $this->player_1_id = $player_1_id;
	}
	public function getPlayer2Id()
	{
	    return $this->player_2_id;
	}

	public function setPlayer2Id($player_2_id)
	{
	    $this->player_2_id = $player_2_id;
	}
	public function getCompetitionId()
	{
	    return $this->competition_id;
	}

	public function setCompetitionId($competition_id)
	{
	    $this->competition_id = $competition_id;
	}
	
	public static function findMatchesForThisWeek($competition_id)
	{
		$enddate = strtotime("Sunday"); //next Sunday
		$startdate = strtotime("-1 week", $enddate);
		$matches = Match::findAllByCriteriaOrdened("competition_id=" . $competition_id 
						. " and date>='" . date("Y-m-d", $startdate) 
						. "' and date<='" . date("Y-m-d", $enddate) ."'"
						, "date asc, place, player_1_id");
		return $matches;
	}

	public static function findByRound($competitionId, $round)
	{
		$matches = Match::findAllByCriteriaOrdened("competition_id=" . $competitionId 
					. " and round = " . $round, "date asc, place, player_1_id");
		return $matches;
	}
	
	public static function findByPlayer($player_id)
	{
		$matches = Match::findAllByCriteriaOrdened("player_1_id = " . $player_id ." or player_2_id = " 
						. $player_id, "date asc, place, player_1_id");
		return $matches;
	}
}
?>