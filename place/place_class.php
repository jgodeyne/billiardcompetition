<?php
include_once("../ppa/entity_class.php");


class Place extends Entity implements EntityInterface {
	
	private $name;

	public function getProperties() {
		return get_object_vars($this);
	}
	
	public function setFromPost($post) {
		$this->setName(htmlspecialchars($post['name']));
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
}
?>