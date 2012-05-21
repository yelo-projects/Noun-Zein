<?php
class HomePage extends Page {

	function getImages(){
		return DataObject::get('GalleryImage',NULL,SQL_RANDOM,NULL);
	}

	function getCollections(){
		return DataObject::get('Collection');
	}

	function getIsStripe(){
		if(isset($_GET['stripe'])){
			return 1;
		}
		return 0;
	}
		
}
class HomePage_Controller extends Page_Controller {

}
