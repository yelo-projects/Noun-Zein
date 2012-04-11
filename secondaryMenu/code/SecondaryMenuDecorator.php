<?php

class SecondaryMenuDecorator extends DataObjectDecorator{

	protected $menus;

	function extraStatics($class = null) {
		return array(
			'many_many' => array(
				'MenusNames'	=>	'SecondaryMenu'
			)
		);
	}

	function updateCMSFields(FieldSet &$fields) {
		$fields->addFieldToTab('Root.Behaviour', new TagField('MenusNames', 'Menus Names (menus where this page will appear, regardless of the previous settings)'));
	}

	public function CustomMenu($name, $level=1){
		$menu = DataObject::get_one('SecondaryMenu','Title=\''.$name.'\'');
		if(!$menu){return null;}
		$result = $menu->Pages();
		if($result){
				$parent = $this->owner->data();
				$stack = array($parent);
				if($parent) {
					while($parent = $parent->Parent) {
						array_unshift($stack, $parent);
					}
				}

				if(isset($stack[$level-2])) $result = $stack[$level-2]->Children();

				$visible = array();

				if(isset($result)) {
					foreach($result as $page) {
						if($page->canView()) {
							$visible[] = $page;
						}
					}
				return new DataObjectSet($visible);
			}
		};
		return null;
	}
}
