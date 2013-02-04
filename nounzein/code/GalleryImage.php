<?php
class GalleryImage extends Image{
	
	static $has_one = array('Gallery'=>'Gallery','Collection'=>'Collection');
        
	static $summary_fields = array(
		'Name',
		'Title',
	);
        
	static $searchable_fields = array(
		'Name',
		'Title',
	);
	
	static $_Title;

	public function nameToTitle($title=null){
		if(!$title){$title = $this->Name;};
		if(!$this->_Title){
			preg_match('/(?:\d{0,3}-?)([\s\w-.]*?)\.(?:jpg|jpeg|png|gif)/i', $title,$t);
			$this->_Title = str_replace('-',' ',$t[1]);
		}
		return $this->_Title;
	}

	public function TitleXML(){
		$title = $this->nameToTitle();
		return strtolower(str_replace(' ','_',Convert::raw2xml($title)));
	}

	public function getCollectionWebSafeName(){
		if($c = $this->Collection()){return $c->getWebSafeName();}
		return 'no_collection';
	}

	public function SetFixedSize($width, $height) {
		return $this->getFormattedImage('SetReSize', $width, $height);
	}

	public function generateSetFixedSize(GD $gd, $width, $height) {
		return $gd->resize($width, $height);
	}

	public function SetWidthIfNotSame($width) {
        if($width == $this->getWidth()){
            return $this;
        }
        return parent::SetWidth($width);
    }

	public function SetWidthIfLarger($width) {
        if($width >= $this->getWidth()){
            return $this;
        }
        return parent::SetWidth($width);
    }

    public function SetHeightIfNotSame($height) {
        if($height == $this->getHeight()){
            return $this;
        }
        return parent::SetHeight($height);
    }

    public function SetHeightIfLarger($height) {
        if($height >= $this->getHeight()){
            return $this;
        }
        return parent::SetHeight($height);
    }

    public function SetSizeIfNotSame($width, $height) {
        if($width == $this->getWidth() && $height == $this->getHeight()){
            return $this;
        }
        return parent::SetSize($width, $height);
    }

    public function SetSizeIfLarger($width, $height) {
        if($width >= $this->getWidth() && $height >= $this->getHeight()){
            return $this;
        }
        return parent::SetSize($width, $height);
    }

    public function SetRatioSizeIfNotSame($width, $height) {
        if($width == $this->getWidth() && $height == $this->getHeight()){
            return $this;
        }
        return parent::SetRatioSize($width, $height);
    }

    public function SetRatioSizeIfLarger($width, $height) {
        if($width >= $this->getWidth() && $height >= $this->getHeight()){
            return $this;
        }
        return parent::SetRatioSize($width, $height);
    }

    public function getFormattedImageIfNotSame($format, $arg1 = null, $arg2 = null) {
        if($this->ID && $this->Filename && Director::fileExists($this->Filename)) {
            $size = getimagesize(Director::baseFolder() . '/' . $this->getField('Filename'));
            $preserveOriginal = false;
            switch(strtolower($format)){
                case 'croppedimage':
                    $preserveOriginal = ($arg1 == $size[0] && $arg2 == $size[1]);
                    break;
            }
            if($preserveOriginal){
                return $this;
            } else {
                return parent::getFormattedImage($format, $arg1, $arg2);
            }
        }
    }

	public function SetRandomCroppedSize($min=100,$max=300,$inc=100){
		$w = $this->getWidth();
		$h = $this->getHeight();
		//round($gd->getHeight()/($gd->getWidth()/$width)
		//if($h>$w){
			$hN = $this->_getRandomSize($min,$max,$inc);
			$wP = round($w * ($hN/$h));
			if($wP>$hN){
				$target = $hN;
			}
			else{
				$target = $wP;
			}
			$wN = 0;
			while($wN<$target){$wN+=$inc;}
			//$wN = $this->_getRandomSize($min,$wP,$inc);
		//}
		/**
		else{
			$wN = $this->_getRandomSize($min,$max,$inc);
			$hP = round($w/$h/$wN);
			$hN = $this->_getRandomSize($min,$hP,$inc);
		}
		**/
		return $this->CroppedImage($wN,$hN);
	}


	public function SetRandomSize($min=100,$max=200,$inc=50){
		$w = $this->getWidth();
		$h = $this->getHeight();
		if($h>$w){
			return $this->SetRandomHeight($min, $max, $inc);
		}
		return $this->SetRandomWidth($min, $max, $inc);
	}

	public function SetRandomWidth($min=50,$max=200,$inc=50){
		$size = $this->_getRandomSize($min, $max, $inc);
		return $this->SetWidthIfNotSame($size);
	}

	public function SetRandomHeight($min=50,$max=200,$inc=50){
		$height = $this->_getRandomSize($min, $max, $inc);
		return $this->SetHeightIfNotSame($height);
	}

	protected function _getRandomSize($min=100,$max=300,$inc=100){
		if($max<$min+$inc){return $min;}
		$range = range($min, $max, $inc);
		$rnd = rand(0, count($range)-1);
		$size = $range[$rnd];
		//if(!$size){$size = $inc;}
		return $size;
	}

	public function SetBestSize($size){
		$w = $this->getWidth();
		$h = $this->getHeight();
		if($h>$w){
			return $this->SetHeightIfLarger($size);
		}
		return $this->SetWidthIfLarger($size);
	}

	public function getParentTitle(){
		if($this->Gallery()){
			return $this->Gallery()->getTitle();
		}
	}

	public function getParentTitleXML(){
		if($this->Gallery()){
			return $this->Gallery()->getTitleXML();
		}
	}
}
