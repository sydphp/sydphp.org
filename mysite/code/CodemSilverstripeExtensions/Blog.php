<?php
if(class_exists('ArchiveWidget')) {

	/**
	 * A Calendar Archive Widget which groups by year and month
	 */
	class CalendarArchiveWidget extends ArchiveWidget {
		
		static $title = "Blog";
		static $cmsTitle = 'Blog Calendar Archive';
		static $description = 'Shows a grouped list of blog post years and months, most recent first';
		
		private $container = NULL;
		
		public function getCMSFields() {
			return array();//NON CONFIG!
		}
		
		private function SetContainerBlog() {
			if(!$this->container) {
				$this->container = BlogTree::current();
			}
		}
		
		public function Title() {
			$this->SetContainerBlog();
			if($this->container->Title != "") {
				return $this->container->Title;
			} else if($this->container->MenuTitle != "") {
				return $this->container->MenuTitle;
			} else {
				return Object::get_static($this->class, 'title');
			}
		}
	
		public function Dates() {
			
			$this->SetContainerBlog();
			
			$set = new DataObjectSet();
			
			$query = new SQLQuery();
			$query->select("YEAR(be.Date) AS EntryYear, DATE_FORMAT(be.Date, '%m') AS EntryMonth");
			$query->from("BlogEntry be JOIN SiteTree s ON s.ID = be.ID AND s.ParentID = '" . Convert::raw2sql($this->container->ID) . "'");
			$query->orderby("EntryYear DESC, EntryMonth DESC");
			$query->groupby("YEAR(be.Date), MONTH(be.Date)");
			//var_dump($query->sql());
			$results = $query->execute();
			if($results && $results->valid()) {
				$dataset = array();
				while($results->valid()) {
					$record = $results->current();
					$dataset[$record['EntryYear']][] = $results->current();
					$results->next();
				}
				
				foreach($dataset as $year=>$records) {
					$count = count($records) - 1;
					foreach($records as $k=>$record) {
						$is_first_month = $is_last_month = FALSE;
						
						if($k == 0) {
							$is_first_month = TRUE;
						}
						if($k == $count) {
							$is_last_month = TRUE;
						}
						
						$first_day = $record['EntryYear'] . '-' . $record['EntryMonth'] . '-01';
						
						//dataset for the template
						$set->push(new ArrayData(
							array(
								'Year' => $record['EntryYear'],
								'Month' => $record['EntryMonth'],
								'LangMonth' => strftime('%B', strtotime($first_day)),
								'IsFirstYearEntry' => $is_first_month,
								'IsLastYearEntry' => $is_last_month,
								'YearLink' => $this->container->Link('date') . '/' . $record['EntryYear'] . '/',
								'MonthLink' => $this->container->Link('date') . '/' . $record['EntryYear'] . '/' . $record['EntryMonth'] . '/',
							)
						));
					}
				}
			}
			
			return $set;
		}
	}
}


class Codem_LatestBlogPostsWidget extends Widget {
	static $cmsTitle = 'Latest Blog Posts list';
	static $description = 'Shows latest blog posts, orderered by most recent first (default 5)';
	
	static $defaults = array(
		"NumPosts" => 5,
	);
		
	public function getCMSFields() {
		$fields = new FieldSet(
			new TextField(
				'NumPosts',
				'Number of posts to show'
			)
		);
		
		$this->extend('updateCMSFields', $fields);
		
		return $fields;
	}
	
	public function Posts() {
		$set = FALSE;
		$container = BlogTree::current();
		if(!empty($container->ID)) {
			$limit = (int)$this->NumPosts;
			
			if($limit <= 0) {
				$limit = 5;
			}
			
			$query = new SQLQuery();
			$query->select("s.ID, s.Title, s.Content, be.Date, be.Author, be.Tags");
			$query->from("BlogEntry be JOIN SiteTree s ON s.ID = be.ID AND s.ParentID = '" . Convert::raw2sql($container->ID) . "'");
			$query->orderby("be.Date DESC");
			$query->limit($limit);
			$query->groupby("be.ID");
			
			$result = $query->execute();
			if($result && $result->valid()) {
				$set = new DataObjectSet();
				while($result->valid()) {
					$be = new BlogEntry($result->current());
					$set->push($be);
					$result->next();
				}
			}
		}
		return  $set;
	}
}
?>