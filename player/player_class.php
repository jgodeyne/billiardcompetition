<?php
include_once("../ppa/entity_class.php");


class Player extends Entity implements EntityInterface {
	
	private $lic;
	private $name;
	private $club;
	private $tsp;
	private $min;
	private $max;
	private $competition_id;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->setLic(htmlspecialchars($post['lic']));
		$this->setName(htmlspecialchars($post['name']));
		$this->setClub(htmlspecialchars($post['club']));
		$this->setTsp(htmlspecialchars($post['tsp']));
		$this->setMin(htmlspecialchars($post['min']));
		$this->setMax(htmlspecialchars($post['max']));
		$this->setCompetitionId(htmlspecialchars($post['competition_id']));
	}
	
	/*
	 * Getters and Setters
	 *  
	 */
	public function getLic()
	{
	    return $this->lic;
	}

	public function setLic($lic)
	{
	    $this->lic = $lic;
	}
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
	public function getClub()
	{
	    return $this->club;
	}

	public function setClub($club)
	{
	    $this->club = $club;
	}
	public function getTsp()
	{
	    return $this->tsp;
	}

	public function setTsp($tsp)
	{
	    $this->tsp = $tsp;
	}
	
	public function getMin()
	{
	    return $this->min; //str_replace(".", ",", $this->min);
	}

	public function setMin($min)
	{
	    $this->min = str_replace(",", ".", $min);
	}
	
	public function getMax()
	{
	    return $this->max; //str_replace(".", ",", $this->max);
	}

	public function setMax($max)
	{
	    $this->max = str_replace(",", ".", $max);
	}
	
	public function getCompetitionId()
	{
	    return $this->competition_id;
	}

	public function setCompetitionId($competition_id)
	{
	    $this->competition_id = $competition_id;
	}
}
?>