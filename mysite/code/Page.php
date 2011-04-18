<?php
class Page extends SiteTree {
	
	public static $db = array(
		'Blurb'=>'Text',
		'BlurbLink' => 'Text',
		'Banner'=>'Text',
		"FeaturedPage" => "Boolean",
	);
	
	public static $defaults = array(
		"FeaturedPage" => 0,
	);
	
	public static $has_one = array(
		'Banner' => 'Image' 
	);
	
	public function getCMSFields($cms = NULL) {
		$fields = parent::getCMSFields($cms);
		
		
		$fields->addFieldToTab('Root.Content.FeatureContent', new CheckboxField('FeaturedPage', 'Is this a featured page'));
		$fields->addFieldToTab('Root.Content.FeatureContent', new TextAreaField('Blurb', 'Content'));
		$fields->addFieldToTab('Root.Content.FeatureContent', new SimpleTreeDropdownField('BlurbLink', 'Content link page'));
		$fields->addFieldToTab('Root.Content.FeatureContent', new ImageField('Banner', 'Image', null, null, null, "assets/Banners/"));
		
		if(is_a($this, 'RegisterableEvent')) {
			$fields->addFieldToTab("Root.Content.Presenters", new DataObjectManager(
				$this,
				'RegisterableEventPresenter',
				'RegisterableEventPresenter',
				array(
					'Name' => 'Presenter Name',
					'Topic' => 'Topic',
					'Company' => 'Position/Organisation',
					"URL" => "Presenter URL",
					'Confirmed' => 'Confirmed?',
				),
				'getCMSFields_forPopup'
			));
		}
		
		return $fields;
	}
	
	/**
	 * Metatags()
	 * @note override core meta, remove generator and replace with codem
	 */
	public function MetaTags($includeTitle = true) {
		$tags = "";
		if($includeTitle === true || $includeTitle == 'true') {
			$tags .= "<title>" . Convert::raw2xml(($this->MetaTitle)
				? $this->MetaTitle
				: $this->Title) . "</title>\n";
		}

		$tags .= "<meta name=\"generator\" content=\"codem.com.au\" />\n";

		$charset = ContentNegotiator::get_encoding();
		$tags .= "<meta http-equiv=\"Content-type\" content=\"text/html; charset=$charset\" />\n";
		if($this->MetaKeywords) {
			$tags .= "<meta name=\"keywords\" content=\"" . Convert::raw2att($this->MetaKeywords) . "\" />\n";
		}
		if($this->MetaDescription) {
			$tags .= "<meta name=\"description\" content=\"" . Convert::raw2att($this->MetaDescription) . "\" />\n";
		}
		if($this->ExtraMeta) { 
			$tags .= $this->ExtraMeta . "\n";
		} 

		$this->extend('MetaTags', $tags);

		return $tags;
	}
	
	public function SydneyTime() {
		$dt = new DateTime(NULL, new DateTimeZone('Australia/Sydney'));
		return $dt->format('H:i');
	}
	
	public function GetPageLinkByID($id) {
		if($id) {
			return DataObject::get_by_id("SiteTree", $id)->Link();
		}
		return FALSE;
	}
	
	public function Testimonials($limit = 1) {
		$list = DataObject::get('Testimonial','PageID=' . $this->ID);
		$set = array();
		if($list) {
			foreach($list as $k=>$item) {
				$current = $item->getAllFields();
				
				$current['LinkPage'] = FALSE;
				if(!empty($current['ExternalLink'])) {
					$current['LinkPage'] = $current['ExternalLink'];
				} else if($item->InternalLink > 0) {
					$current['LinkPage'] = ($current['InternalLink'] > 0 ? $this->GetPageLinkByID($current['InternalLink']) : FALSE);
				}
				
				$current['AssociatedImage'] = FALSE;
				if(!empty($current['AssociatedImageID'])) {
					if($image = DataObject::get_one('File','ID=' . $current['AssociatedImageID'])) {
						$current['AssociatedImage'] = new Image($image->getAllFields());
					}
				}
				$set[$k] = $current;
			}
		}
		return new DataObjectSet($set);
	}
	

	
	final public function IsLoggedIn() {
		return !is_null(Session::get("loggedInAs"));
	}

	
	public function GetLoggedIn() {
		$member = FALSE;
		if($this->IsLoggedIn()) {
			$member = DataObject::get('Member','id=' . convert::raw2sql(Session::get("loggedInAs")));
		}
		return $member;
	}

}
class Page_Controller extends ContentController {

	protected $use_spam_expression =  FALSE;
	
	public static $allowed_actions = array (
		'logout',
	);
	
	public function logout() {
		Security::logout(TRUE);
		exit;
	}
	public function init() {
		parent::init();
		//rss linkage
		RSSFeed::linkToFeed(Director::absoluteBaseURL() . "home/rssfeed", "10 Most Recently Updated Pages");
		
		//block some core requirements - we'll load these ourselves in our own source ordering
		//SS requirements source ordering control is oddly non-existent
		Requirements::block('/sapphire/thirdparty/jquery/jquery.js');
		Requirements::block('event_calendar/css/calendar.css');
	}
	
	public function CssClass() {
		return "page";
	}
	
	public function CopyrightNotice() {
		return "&copy; 2003 - " . date('Y');
	}
	
	public function IsMobile() {
		return $this->is_mobile;
	}
	
	public function HasLocation() {
		return $this->Latitude != '' && $this->Longitude != '';
	}
	
	public function GetLatitude() {
		if($this->HasLocation()) {
			return $this->Latitude;
		}
	}
	
	public function GetLongitude() {
		if($this->HasLocation()) {
			return $this->Longitude;
		}
	}
	
	/**
	 * Pager()
	 * @note simple pager handler
	 */
	protected function Pager($type) {
		if(empty($this->ParentID)) {
			$this->ParentID = 0;
		}
		$limit = FALSE;
		$where = "";
		$join = "";
		$columns = "";
		$grouping = FALSE;
		switch($type) {
			case "children":
				$columns .= ",ii.ImageID AS FeatureImageID";
				$where = "s.ShowInMenus = 1 AND s.ParentID = {$this->ID}";
				$join = " JOIN Page p ON p.ID = s.ID"
					. " LEFT JOIN ImageGalleryItem ii ON ii.ImageGalleryPageID = p.ID";
				$order = "s.Sort ASC";
				break;
			case "siblings":
				$columns .= ",ii.ImageID AS FeatureImageID";
				$where = "s.ShowInMenus = 1 AND s.ParentID = {$this->ParentID}"
					. " AND s.ID <> {$this->ID}";
				$join = " JOIN Page p ON p.ID = s.ID"
					. " LEFT JOIN ImageGalleryItem ii ON ii.ImageGalleryPageID = p.ID";
				$order = "Sort ASC";
				break;
			case "featured":
				$columns .= ",ii.ImageID AS FeatureImageID";
				$where = "s.ShowInMenus = 1 AND p.FeaturedPage = 1";
				$join = " JOIN Page p ON p.ID = s.ID"
					. " LEFT JOIN ImageGalleryItem ii ON ii.ImageGalleryPageID = p.ID";
				$order = "s.Sort ASC";
				$limit = 10;
				break;
			case "prev":
				$where = "s.ShowInMenus = 1 AND s.ParentID = {$this->ParentID} AND s.Sort < {$this->Sort}";
				$order = "s.Sort DESC";
				$limit = 1;
				break;
			case "next":
			default:
				$where = "s.ShowInMenus = 1 AND s.ParentID = {$this->ParentID} AND s.Sort > {$this->Sort}";
				$order = "s.Sort ASC";
				$limit = 1;
				break;
		}
		
		$grouping = array("s.ID");

		
		$query = new SQLQuery();
		$query->select("s.*{$columns}");
		$query->from("SiteTree s " . $join);
		$query->where($where);
		$query->orderby($order);
		if($grouping) {
			$query->groupby($grouping);
		}
		if($limit) {
			$query->limit($limit);
		}
		
		//var_dump($type);print(htmlspecialchars($query->sql()));
		
		if($result = $query->execute()) {
			if($limit === 1) {
				$record = $result->current();
				if(isset($record['ClassName'])) {
					return new $record['ClassName']($record);
				}
			} else {
				$list = array();
				while($result->valid()) {
					$record = $result->current();
					$record['Excerpt'] = substr(strip_tags($record['Content']), 0, 300);
					$record['FeatureImage'] = NULL;
					if(!is_null($record['FeatureImageID'])) {
						$record['FeatureImage'] = DataObject::get_one('Image','ID=' . $record['FeatureImageID']);
					}
					$list[] = new $record['ClassName']($record);
					//if($type == "siblings") { var_dump($record); }
					$result->next();
				}
				return new DataObjectSet($list);
			}
		}
		return FALSE;
	}
	
	public function PreviousPage() {
		return $this->ParentID ? $this->Pager('prev') : FALSE;
	}
	public function NextPage() {
		return $this->ParentID ? $this->Pager('next') : FALSE;
	}
	
	public function FeaturedPages() {
		return $this->Pager('featured');
	}
	
	public function SiblingPages() {
		return $this->Pager('siblings');
	}
	
	public function Children() {
		return $this->Pager('children');
	}
	
	//RSS feed updates
	public function rssfeed() {
		$rss = new RSSFeed(DataObject::get("Page", "", "LastEdited DESC", "", 10), $this->Link(), "10 Most Recently Updated Pages", "Shows a list of the 10 most recently updated pages.", "Title", "Content", "Author");
		$rss->outputToBrowser();
		exit;
	}

	public function IsHomePage() {
		return FALSE;
	}
	
	public function HasBanner() {
		return !empty($this->BannerID);
	}
	
	public function RenderBanner() {
		if($this->HasBanner()) {
			return $this->Banner()->SetWidth(300);
		}
	}
	
	public function BlurbLink() {
		return $this->GetPageLinkByID($this->getField('BlurbLink'));
	}

}
?>