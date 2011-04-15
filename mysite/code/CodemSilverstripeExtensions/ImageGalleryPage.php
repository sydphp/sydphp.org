<?php
/**
 * Codem_ImageGalleryPage
 * @note extension to ImageGalleryPage
 */
class Codem_ImageGalleryPage extends ImageGalleryPage {

	static $hide_ancestor = "ImageGalleryPage";
	
	protected $base_folder_name = "image-gallery";
	
	private $folder_checked = FALSE;
	
	//options for this extension
	static $db = array();
	
	static $defaults = array (
		'CoverImageWidth' => '100',
		'CoverImageHeight' => '100',
		'ThumbnailSize' => '90',
		'Square' => '1',
		'NormalSize' => '700',
		'MediaPerPage' => '30',
		'MediaPerLine' => '6',
		'UploadLimit' => '20'
	);
	
	/**
	 * __construct()
	 * @note overrides constructor and sets gallery defaults
	 */
	public function __construct($record = null, $isSingleton = false) {
		parent::__construct($record, $isSingleton);
		$this->setGalleryDefaults();
	}
	
	/**
	 * getCMSFields() add a field to allow for image cycling enablement
	 */
	public function getCMSFields($cms = NULL) {
		return parent::getCMSFields($cms);
	}
	
	public function setGalleryDefaults() {
		//given the defaults provided by the child, set them
		$defaults = $this->getGalleryDefaults();
		foreach($defaults as $k=>$v) {
			$this->$k = $v;
		}
		//force galleria as the UI, always
		$this->GalleryUI = 'Galleria';
	}
	
	protected function getGalleryDefaults() {
		return self::$defaults;
	}
	
	/**
	 * Items()
	 * @note override parent::Items to provide correct sorting and avoid loading album id 0
	 */
	protected function Items($limit = NULL) {
		if(is_null($limit) && $this->MediaPerPage) {
			if(!isset($_REQUEST['start']) || !is_numeric( $_REQUEST['start'])) {
				$_REQUEST['start'] = 0;
			}
			$limit = $_REQUEST['start'] . "," . $this->MediaPerPage;
		}
		
		$files = DataObject::get(
			$this->getItemClass(),
			(($current_album = $this->CurrentAlbum()) ? "AlbumID = {$current_album->ID} AND" : "") . " ImageGalleryPageID = {$this->ID} AND AlbumID <> 0",
			"SortOrder ASC",
			"",
			$limit
		);
		
		return $files;
	}

	/**
	 * GalleryItems
	 * @note override gallery provided by ImageGalleryPage - force widths to the configured width always
	 */
	public function GalleryItems($limit = NULL, $items = NULL, $bypass = TRUE) {
		
		//var_dump($this);
		
		
		if($items === NULL) {
			$items = $this->Items($limit);
		}
		
		$this->includeUI();
		if($items) {
			foreach($items as $item) {
				//don't crop from the middle if square. silly.
				$thumbImg = $item->Image()->BoundIntoBox($this->ThumbnailSize, $this->ThumbnailSize);
				if($thumbImg) {
					$item->ThumbnailURL = $thumbImg->URL;
					$item->ThumbnailWidth = $this->Square ? $this->ThumbnailSize : $thumbImg->getWidth();
					$item->ThumbnailHeight = $this->ThumbnailSize;
					//always force thumb image to width
					$normalImg = $item->Image()->SetWidth($this->NormalSize);
					$item->ViewLink = $normalImg->URL;
					
					//item link page
					$item->PageLink = "";
					if($pageLink = $this->getLinkToPage($item->LinkToID)) {
						$item->PageLink = $pageLink->AbsoluteLink();
					}
					$item->setUI($this->UI);
				}
			}
			return $this->UI->updateItems($items);
		}
		return FALSE;
	}
	
	protected function getLinkToPage($id) {
		$pageLink = FALSE;
		if($id > 0) {
			$query = new SQLQuery();
			$query->select('*');
			$query->from('SiteTree');
			$query->where('ID = ' . $id);
		
			$result = $query->execute();
			
			if($result->valid()) {
				$pageLink = new SiteTree($result->current());
			}
			
		}
		return $pageLink;
	}
	
	/**
	 * checkFolder()
	 * @note overrides the standard image gallery page checkFolder handling
	 * @note runs through all folders - if not on disk then create them on disk, if on disk but not in database then remove them
	 */
	function checkFolder() {
		
		if($this->folder_checked) {
			return FALSE;
		}
		
		try {
			
			$this->folder_checked = TRUE;
			
			//create or find the image-gallery root folder
			$galleries = Folder::findOrMake($this->base_folder_name);
			$galleries->Title = 'Image Gallery';
			$galleries->write();
			//the root folder for Image Gallery Pages is the root gallery id
			$this->RootFolderID = $galleries->ID;
			//create or update this page
			$this->write();
			
			//create or update the folder for this page based on the URL Segment
			$folder = Folder::findOrMake($this->base_folder_name . '/' . $this->URLSegment);
			$folder->Title = $this->Title;
			$folder->write();
			
			//require a default album for this page
			$this->setDefaultAlbum();
			
			/*
			//now check that all albums and folders exist and are in sync
			$this->cleanUpAlbums();
			
			//clean out old crappy folders
			$this->cleanUpFolders();
				
			//now run through the assets directory and grab each directory path
			//does it exist as a Folder in the database ? if not, delete it
			$this->cleanOrphanedDirectories();
			*/
			
			//respond to the requestor
			FormResponse::add( "\$( 'Form_EditForm' ).getPageFromServer( $this->ID );" );
			
		} catch (Exception $e) {}
		
		return TRUE;
		
	}
	
	/**
	 * setDefaultAlbum() sets default album for this page
	 * @see ImageGalleryAlbum::onBeforeWrite()
	 */
	protected function setDefaultAlbum() {
		$class = $this->albumClass;
		$album = new $class();
		$album->AlbumName = "Default Album";
		$relative_path = $this->base_folder_name . '/' . $this->URLSegment . '/' . SiteTree::generateURLSegment($album->AlbumName);
		if(!$this->path_exists($relative_path)) {
			$album->ImageGalleryPageID = $this->ID;
			$album->ParentID = $this->RootFolderID;
			$folder = Folder::findOrMake($relative_path);
			$folder->Title = $album->AlbumName;
			$folder->write();
			$album->FolderID = $folder->ID;
			$album->write();
			$result = TRUE;
		} else {
			$result = FALSE;
		}
		return $result;
	}
	
	protected function get_full_path($path) {
		return BASE_PATH . "/" . ASSETS_DIR . "/" . $path;
	}
	
	protected function path_exists($path, $prefix = "") {
		$absolute_path = $this->get_full_path($path);
		$exists = file_exists($absolute_path);
		return $exists;
	}
	
	private function deleteFolder($record, $path) {
		$folder = DB::query("DELETE FROM File WHERE ID = " . Convert::raw2sql($record['ID']));
		if($folder && is_writable($path)) {
			rmdir($path);
		}
	}
	
	/**
	 * folderCreate() given a folder path, check if it exists, if not create it
	 */
	private function folderCreate($folderPath) {
		$full = BASE_PATH . "/" . $folderPath;
		if(!file_exists($full)) {
			return mkdir($full, 0775, TRUE);
		}
		return FALSE;
	}
	
	private function deleteAlbum($id) {
		//print "deleting album {$id}\n";
		$album = DB::query("DELETE FROM {$this->albumClass} WHERE ID = " . Convert::raw2sql($id));
		if($album) {
			$items = DB::query("DELETE FROM {$this->itemClass} WHERE AlbumID = " . Convert::raw2sql($id));
			//print "deleting items in album {$id}\n";
			return $album && $items;
		}
		return FALSE;
	}
	
	function getAlbumByFolderName($file_name) {
		$query = "SELECT f.*, i.ID AS AlbumID,\n"
			. " COUNT(ig.ID) AS ItemCount\n"
			. " FROM File f\n"
			. " LEFT JOIN {$this->albumClass} i ON i.FolderID = f.ID\n"
			. " LEFT JOIN {$this->itemClass} ig ON ig.AlbumID = i.ID\n"
			. " WHERE f.ClassName = 'Folder'\n"
			. " AND f.FileName = '" . Convert::raw2sql($file_name) . "'\n"
			. " GROUP BY f.ID";
		return DB::query($query);
	}
	
	function getAllAlbums() {
		return DB::query("SELECT i.*, f.id AS FolderFileID, f.Title AS FolderFileTitle, f.FileName AS FolderFileName,\n"
			. " COUNT(ig.ID) AS ItemCount\n"
			. " FROM {$this->albumClass} i\n"
			. " LEFT JOIN File f ON (f.ID = i.FolderID AND f.ClassName = 'Folder')\n"
			. " LEFT JOIN {$this->itemClass} ig ON ig.AlbumID = i.ID\n"
			. " GROUP BY i.ID\n"
			. " ORDER BY i.ID");
	}
	
	function getAllFolders() {
		return DB::query("SELECT i.ID AS AlbumID, f.ID AS FolderFileID, f.Title AS FolderFileTitle, f.FileName AS FolderFileName,\n"
			. " COUNT(ig.ID) AS ItemCount\n"
			. " FROM File f\n"
			. " LEFT JOIN {$this->albumClass} i ON i.FolderID = f.ID\n"
			. " LEFT JOIN {$this->itemClass} ig ON ig.AlbumID = i.ID\n"
			. " WHERE f.ClassName = 'Folder'\n"
			. " AND f.Filename LIKE '%/{$this->base_folder_name}/%'\n"
			. " GROUP BY f.ID\n"
			. " ORDER BY f.ID");
	}
	
	/**
	 * cleanOrphanedDirectories() scan through image-gallery directories and remove them if they do not exist in the database
	 */
	private function cleanOrphanedDirectories() {
		$gallery_dir = $this->base_folder_name;
		$exclusions = array("_resampled");
		$base = realpath(ASSETS_PATH . "/" . $gallery_dir);
		$itr = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base), RecursiveIteratorIterator::SELF_FIRST);
		while($itr->valid()) {
			if($itr->isDir() && ! $itr->isDot() && !in_array($itr->getFilename(), $exclusions)) {
				$folder_file_name = ASSETS_DIR . "/" . $gallery_dir . "/" . $itr->getsubPathName() . "/";
				$a = $this->getAlbumByFolderName($folder_file_name);
				if($a->numRecords() > 0) {
					foreach($a as $record) {
						if(file_exists($itr->getPathName()) && is_dir($itr->getPathName())) {
							//check if the directory actually exists
							$d = new DirectoryIterator($itr->getPathName());
							$file_count = 0;
							while($d->valid()) {
								if(!$d->isDot()) {
									$file_count++;
								}
								$d->next();
							}
							if(isset($record['ID']) && $itr->isWritable() && $record['ItemCount'] == 0 && $file_count == 0 && is_null($record['AlbumID'])) {
								//only delete from disk and database if we can (first off)
								// 1. no AlbumID, ItemCount = 0 and path does not contain any files
								$this->deleteFolder($record, $itr->getPathName());
							}
						}
					}
				} else {
					//exists on disk but not in database - leave as-is for now
				}
			}
			$itr->next();
		}
		return TRUE;
	}
	
	/**
	 * cleanUpAlbums()
	 * @note retrieves all albums and checks if they are orphaned (i.e if the FolderID no longer exists in the File table
	 */
	private function cleanUpAlbums() {
		$albums = $this->getAllAlbums();
		if(!empty($albums)) {
			foreach($albums as $album) {
				//is this an orphaned album ?
				if(is_null($album['FolderFileID'])) {
					//delete it from the database if so
					$this->deleteAlbum($album['ID']);
				}
			}
		}
	}
	
	private function cleanUpFolders() {
		$folders = $this->getAllFolders();
		if(!empty($folders)) {
			foreach($folders as $folder) {
				//does it exist on disk ?
				if(!$this->path_exists($folder['FolderFileName'])) {
					//path does not exist on the file system
					$this->deleteFolder($folder['FolderFileID'], $this->get_full_path($folder['FolderFileName']));
					if(!is_null($folder['AlbumID'])) {
						$this->deleteAlbum($folder['AlbumID']);
					}
				}
			}
		}
	}
	
	/**
	 * normalImg() override ImageGalleryPage normalImg handling
	 * @note if the image is less than the configured normal width set in the admin, then use the original image size
	 * @param $item
	 */
	protected function normalImg($item) {
		$width = $item->Image()->getWidth();
		$height = $item->Image()->getHeight();
		if($item->Image()->Landscape()) {
			if($width < $this->NormalSize) {
				//var_dump("SetSize - Landscape:" . $this->NormalSize . ":" . $width);
				return $item->Image()->SetSize($width, $height);
			} else {
				//var_dump("SetWidth - Landscape:" . $this->NormalSize . ":" . $width);
				return $item->Image()->SetWidth($this->NormalSize);
			}
		} else {
			if($height < $this->NormalSize) {
				//var_dump("SetSize - Portrait:" . $this->NormalSize . ":" . $height);
				return $item->Image()->SetSize($width, $height);
			} else {
				//var_dump("SetHeight - Portrait:" . $this->NormalSize . ":" . $height);
				return $item->Image()->SetHeight($this->NormalSize);
			}
		}
	}
}

class Codem_ImageGalleryPage_Controller extends ImageGalleryPage_Controller {
	public function init() {
		parent::init();
		Requirements::block('image_gallery/gallery_ui/galleria/css/galleria.css');
		Requirements::block('image_gallery/css/ImageGallery.css');
		Requirements::block('image_gallery/gallery_ui/galleria/javascript/galleria.settings.js');
		Requirements::block('image_gallery/gallery_ui/galleria/javascript/jquery.galleria.js');
		Requirements::block('image_gallery/javascript/imagegallery_init.js');
		
	}
}
?>