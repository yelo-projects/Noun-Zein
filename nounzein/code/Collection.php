<?php

class Collection extends DataObject{

	static $db = array(
		'Name'	=>	'Varchar',
		'Content' => 'HTMLText'
	);
	static $has_many = array(
		'Images'	=>	'GalleryImage'
	);

	public function getCMSFields($params = null){
		$fields = $this->getCMSFields_forPopup($params);
		$fieldSet = new FieldSet();
		$fieldSet->push(new TabSet('Root','Root',new TabSet('Content')),'Root');
		$fieldSet->addFieldsToTab('Root.Content.Main', $fields);
		return $fieldSet;
	}

	public function getCMSFields_forPopup($params = null){
		$fields = new fieldSet();
		$fields->push(new TextField('Name','Name'));
		$images = new ImageDataObjectManager(
			$this,
			'Images',
			'GalleryImage',
			null,
			null,
			null,
			'CollectionID='.$this->ID
		);
		$images->setAddTitle('Image');
		$fields->push($images);
		$fields->push(new HTMLEditorField('Content','Description')); 
		return $fields;
	} 

	public function getWebSafeName(){
		return strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $this->Name));
	}

}
