<?php

class Collection extends DataObject implements PermissionProvider{

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

	protected function _providePermissionsArray($c=null){
		if(!$c){$c = $this->class;};
		$perms = array();
		$titles = array(
			'CREATE'=> 'Create'
		,	'VIEW'	=> 'View'
		,	'EDIT'=> 'Edit'
		,	'DELETE'=> 'Delete'
		,	'PUBLISH'=> 'Publish'
		);
		foreach ($titles as $key => $value) {
			$name = $c.'_'.$key;
			$niceName = ucfirst($c);
			$perms[$name] = array(
				'name' => _t(
					'Permission.'.$name,
					$value.' '.$niceName
				)
			,	'category' => _t(
					'Permission.CATEGORY_'.$c,
					$niceName
				)
			,	'help' => _t(
					'Permission.'.$name.'_HELP',
					'Allows the user to '.$value.' '.$niceName 
				)
			,	'sort' => 100
			);
		}
		return $perms;
	}

	public function providePermissions(){
		return $this->_providePermissionsArray($this->class);
	}

	public function canEdit(){
		return Permission::check($this->class.'_EDIT');
	}

	public function canCreate(){
		return Permission::check($this->class.'_CREATE');
	}

	public function canDelete(){
		return Permission::check($this->class.'_DELETE');
	}

	public function canPublish(){
		return Permission::check($this->class.'_PUBLISH');
	}

	public function canView(){
		return true;
		//return Permission::check($this->class.'_VIEW');
	}

}
