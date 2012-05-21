<?php
class Gallery extends Page{

	static $allowed_children = 'none';
	static $has_many = array ('Images' => 'GalleryImage');
	static $has_one = array('Cover'=>'GalleryImage');

	public function getCMSFields(){
		$f = parent::getCMSFields();
		$images = new ImageDataObjectManager(
			$this,
			'Images',
			'GalleryImage',
			null,
			null,
			null,
			'GalleryID='.$this->ID
		);
		$cover = new ImageUploadField('GalleryImage', 'Cover');
		$images->setAddTitle('Image');
		$f->addFieldToTab("Root.Content.Images", $images);
		$f->addFieldToTab("Root.Content.Images", $cover);
		return $f;
	}

	public function getCover(){
		$cover = $this->Cover();
		if(!$cover){$cover = $this->getFirstImage();}
		return $cover;
	}

	public function getFirstImage(){
		$images = $this->Images();
		if($images){
			return $images->First();
		}
	}

	public function getRandomImage(){
		$image = DataObject::get_one('GalleryImage', 'GalleryID="'.$this->ID.'"', true, 'RANDOM()');
		if($image){
			return $image;
		}
	}

	public function getTitleXML(){
		return strtolower(str_replace(' ','_',Convert::raw2xml($this->getTitle())));
	}

}

class Gallery_Controller extends Page_Controller{

}