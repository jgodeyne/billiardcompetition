<?php
include_once("../ppa/entity_class.php");


class Competition extends Entity implements EntityInterface {
	
	private $name;
	private $rounds;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->setName(htmlspecialchars($post['name']));
		$this->setRounds(htmlspecialchars($post['rounds']));
	}
	
	/*
	 * Getters and Setters
	 *  
	 */
	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}
	
	public function getRounds() {
		return $this->rounds;
	}
	
	public function setRounds($rounds) {
		$this->rounds = $rounds;
	}
}
?>