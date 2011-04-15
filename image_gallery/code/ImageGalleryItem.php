<?php

class ImageGalleryItem extends DataObject
{
	protected $ui;
	
	public static $delete_permission = "ADMIN";
	
	static $db = array (
		'Caption' => 'Text'
	);
	
	static $has_one = array (
		'ImageGalleryPage' => 'ImageGalleryPage',
		'Album' => 'ImageGalleryAlbum',
		'Image' => 'ImageGalleryImage',
		"LinkTo" => "SiteTree",
	);
	
		
	//CODEM - provide an option URL linking field - to link the image to another page rather than the main image
	public function getCMSFields_forPopup()
	{
		$fields = new FieldSet();
		$fields->push(new TextareaField('Caption', _t('ImageGalleryItem.CAPTION','Caption')));
		if($this->ImageGalleryPageID) {
			$fields->push(new DropdownField('AlbumID', _t('ImageGalleryItem.ALBUM','Album'), $this->ImageGalleryPage()->Albums()->toDropdownMap('ID','AlbumName')));
		}
		$fields->push(new ImageField('Image'));
		
		//CODEM
		$fields->push(
				new SimpleTreeDropdownField(
					"LinkToID", 
					'Link image to a page on your website',
					"SiteTree",
					"","Title",NULL,
					""
				)
		);
		//END CODEM
		
		return $fields;
	}
	
	
	//CODEM - test for image ID before deleting
	public function onBeforeDelete()
	{
		if(!empty($this->Image()->ID)) {
			$this->Image()->delete();
		}
		parent::onBeforeDelete();
	}
	
	public function onBeforeWrite()
	{
		parent::onBeforeWrite();
		
		if($image = $this->Image()) {
			if(isset($_POST['AlbumID']) && $album = DataObject::get_by_id("ImageGalleryAlbum", $_POST['AlbumID'])) {
				$image->setField("ParentID",$album->FolderID);
				$image->write();
			}
		}
	}
	
	public function Thumbnail()
	{
		return $this->Image()->CroppedImage($this->ImageGalleryPage()->ThumbnailSize,$this->ImageGalleryPage()->ThumbnailSize);
	}
	
	public function Large()
	{
		if($this->Image()->Landscape())
			return $this->Image()->SetWidth($this->ImageGalleryPage()->NormalSize);
		else
			return $this->Image()->SetHeight($this->ImageGalleryPage()->NormalSize);
	}
	
	public function setUI(ImageGalleryUI $ui)
	{
		$this->UI = $ui;
	}
	
	public function GalleryItem()
	{
		if($this->UI)
			return $this->renderWith(array($this->UI->item_template));
		return false;
	}
	
	public function canDelete() 
	{ 
		return Permission::check(self::$delete_permission); 
	}
}



?>