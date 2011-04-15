<?php

class ImageGalleryAlbum extends DataObject
{
	static $db = array (
		'AlbumName' => 'Varchar(255)',
		'Description' => 'Text'
	);
	
	static $has_one = array (
		'CoverImage' => 'Image',
		'ImageGalleryPage' => 'ImageGalleryPage',
		'Folder' => 'Folder'
	);
	
	static $has_many = array (
		'GalleryItems' => 'ImageGalleryItem'
	);
	

	
	public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField('AlbumName', _t('ImageGalleryAlbum.ALBUMTITLE','Album Title')),
			new TextareaField('Description', _t('ImageGalleryAlbum.DESCRIPTION','Description')),
			new ImageField('CoverImage',_t('ImageGalleryAlbum.COVERIMAGE','Cover Image'))
		);
	}
	
	public function Link()
	{
		return $this->ImageGalleryPage()->Link('album/'.$this->Folder()->Name);
	}
	
	public function LinkingMode()
	{
		return Controller::curr()->urlParams['ID'] == $this->Folder()->Name ? "current" : "link";
	}
	
	public function ImageCount()
	{
		$images = DataObject::get("ImageGalleryItem","AlbumID = {$this->ID}"); 
		return $images ? $images->Count() : 0;
	}
	
	public function FormattedCoverImage()
	{
		return $this->CoverImage()->CroppedImage($this->ImageGalleryPage()->CoverImageWidth,$this->ImageGalleryPage()->CoverImageHeight);
	}
	
	function onBeforeWrite()
	{
		parent::onBeforeWrite();
		if(isset($_POST['AlbumName'])) {
		  $clean_name = SiteTree::generateURLSegment($_POST['AlbumName']);
			if($this->FolderID) {
				//$this->Folder()->setName($clean_name);//CODEM - remove this as it resets the url segment
				$this->Folder()->Title = $clean_name;
				$this->Folder()->write();
			}
			else {
				//CODEM alter this to be the URLSegement to match the image gallery page
				$folder = Folder::findOrMake('image-gallery/' . $this->ImageGalleryPage()->URLSegment . '/'.$clean_name);
				$this->FolderID = $folder->ID;
			}
		}
	}
	
	//CODEM change - test for a folder ID before deleting
	function onBeforeDelete()
	{
		parent::onBeforeDelete();
		$this->GalleryItems()->removeAll();
		if(!empty($this->Folder()->ID)) {
			$this->Folder()->delete();
		}
	}
	
	
}


?>