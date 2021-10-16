<?php
class TotalResult {
	private $playerId;
	private $playerName;
	private $nbrOfMatches;
	private $points;
	private $innings;
	private $average;
	private $highest_run;
	private $matchpoints;
	private $bonuspoints;
	private $rankingpoints;
	private $avgpct;

	public function getPlayerId() {
		return $this->playerId;
	}
	
	public function getPlayerName() {
		return $this->playerName;
	}
	
	public function getNbrOfMatches() {
		return $this->nbrOfMatches;
	}
	
	public function getPoints()
	{
	    return $this->points;
	}

	public function getInnings()
	{
	    return $this->innings;
	}

	public function getAverage()
	{
	    return $this->average;
	}

	public function getHighestRun()
	{
	    return $this->highest_run;
	}

	public function getMatchPoints()
	{
	    return $this->matchpoints;
	}

	public function getBonuspoints()
	{
	    return $this->bonuspoints;
	}

	public function getRankingpoints()
	{
	    return $this->rankingpoints;
	}
	
	public function getAvgPct() {
		return $this->avgpct;
	}
	
	public static function rankingList($competitionId) {
		$db = new Database();
		$db->connect();
		$query = "SELECT players.id as playerId"
			. ", name as playerName"
			. ", count(results.id) as nbrOfMatches"
			. ", SUM(points) as points"
			. ", SUM(innings) as innings"
			. ", SUM(points)/SUM(innings) as average"
			. ", MAX(highest_run) as highest_run"
			. ", SUM(matchpoints) as matchpoints"
			. ", SUM(bonuspoints) as bonuspoints"
			. ", SUM(rankingpoints) as rankingpoints"
			. ", (SUM(points)/SUM(innings))/min * 100 as avgpct"
			. " from players"
			. " left join (results) on (players.id=results.player_id)"
			. " where competition_id = " . $competitionId
			. " group by players.id"
			. " order by rankingpoints desc, avgpct desc";
		//error_log($query);
		$result = $db->query($query);
		$objects = null;
		while ($object = $db->fetchObject($result, get_called_class())) {
			$objects[]=$object;
		}
		$db->disconnect();
		return $objects;		
	}
	
	public static function rankingPlayer($playerId) {
		$db = new Database();
		$db->connect();
		$query = "SELECT players.id as playerId"
			. ", name as playerName"
			. ", count(results.id) as nbrOfMatches"
			. ", SUM(points) as points"
			. ", SUM(innings) as innings"
			. ", SUM(points)/SUM(innings) as average"
			. ", MAX(highest_run) as highest_run"
			. ", SUM(matchpoints) as matchpoints"
			. ", SUM(bonuspoints) as bonuspoints"
			. ", SUM(rankingpoints) as rankingpoints"
			. ", (SUM(points)/SUM(innings))/min * 100 as avgpct"
			. " from players"
			. " left join (results) on (players.id=results.player_id)"
			. " where players.id = " . $playerId
			. " group by players.id"
			. " order by results.rankingpoints desc";
		//error_log($query);
		$result = $db->query($query);
		$object = $db->fetchObject($result, get_called_class());
		$db->disconnect();
		return $object;		
	}
}