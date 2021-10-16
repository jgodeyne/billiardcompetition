<?php
include_once("ppa/entity_class.php");


class Player extends Entity implements EntityInterface {
	
	public $lic;
	public $name;
	public $club;
	public $tsp;
	public $min;
	public $max;
	public $competition_id;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->lic=htmlspecialchars($post['lic']);
		$this->name=htmlspecialchars($post['name']);
		$this->club=htmlspecialchars($post['club']);
		$this->tsp=htmlspecialchars($post['tsp']);
		$this->min=htmlspecialchars($post['min']);
		$this->max=htmlspecialchars($post['max']);
		$this->competition_id=htmlspecialchars($post['competition_id']);
	}
}
