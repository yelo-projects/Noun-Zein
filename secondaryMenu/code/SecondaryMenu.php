<?php

class SecondaryMenu extends DataObject{

	static $db = array(
		'Title'	=>	'Varchar'
	);

	static $belongs_many_many = array(
		'Pages'	=>	'SiteTree'
	);

}
