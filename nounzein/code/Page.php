<?php
class Page extends SiteTree {

	function Summary($maxWords=30){
		return $this->_summary($this->Content, $maxWords);
	}

	function getSiteState(){
		return SiteConfig::current_site_config()->SiteState;
	}

	function Random($type,$limit=2, $filter=NULL){
		$objects = DataObject::get($type, $filter);
		if($objects){
			$items = $objects->toArray();
			shuffle($items);
			$c = count($items);
			if($c){
				if($c>$limit){$items = array_slice($items, 0,$limit);}
				return new DataObjectSet($items);
			}
		}
	}

	function Feed($type='News',$filter = 'date ASC', $limit=4){
		return DataObject::get($type, NULL, $filter, NULL, $limit);
	}

	function News($limit=4){
		return $this->Feed('News', 'date ASC', $limit);
	}
	
	protected function _summary($value, $maxWords=50, $append='...', $appendSentence='..', $allowedTags = '<a>'){
		$data = strip_tags($value, $allowedTags);
		if( !$data ){return "";};

		$data = preg_replace('/[\r\n]+/',"\n",$data);

		$words = explode( ' ', $data );
		if(count($words)<=$maxWords){return nl2br($data);}
		$length = 0;
		$result = '';
		while($words && $length<=$maxWords){
			$result.=' '.array_shift($words);
			$length++;
		}
		trim($result);
		if( preg_match( '/<a[^>]*>/', $result ) && !preg_match( '/<\/a>/', $result ) ){$result .= '</a>';}
		$result.=(substr($result, strlen($result), 1)==='.') ? $appendSentence : $append;
		$result = nl2br($result);
		return $result;
	}

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();
	}

	function themedCSS($name){
		
	}
}