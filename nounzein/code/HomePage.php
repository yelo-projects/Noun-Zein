<?php
class HomePage extends Page {

	public static $db = array(
		'Before' => 'HTMLText'
	);

	function getImages(){
		return DataObject::get('GalleryImage',NULL,SQL_RANDOM,NULL);
	}

	function getIsStripe(){
		if(isset($_GET['stripe'])){
			return 1;
		}
		return 0;
	}

	function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Content.Main", new HTMLEditorField('Before','Before'),'Content'); 
		return $fields;
	}
		
}
class HomePage_Controller extends Page_Controller {

}
