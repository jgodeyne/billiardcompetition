<?php
include_once("ppa/entity_class.php");


class Place extends Entity implements EntityInterface {
	
	public $name;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->name=htmlspecialchars($post['name']);
	}
}
