<?php
/**
 * Codem_SiteConfig
 * @note a extended SiteConfig to handle generic web sitey things
 * @note implement in mysite/_config with
 */
class Codem_SiteConfig extends DataObjectDecorator {
	public function extraStatics() {
		return array(
			'db' => array(
				'AnalyticsKey' => 'Text',
				
				'MappingKey' => 'Text',
				'DefaultLongitude' => "LongitudeField(9,6)",
				'DefaultLatitude' => "LatitudeField(8,6)",
				'DefaultZoom' => 'Int(2)',
				
				'GeneralEmailRecipient' => 'Text',
				'GeneralEmailSender' => 'Text',
				'WebmasterEmailRecipient' => 'Text',
				
				'SourcePage' => 'Text',
				'SourceBranch' => 'Text',
				'TwitterURL' => 'Text',
				'FacebookURL' => 'Text',
				'IdenticaURL' => 'Text',
				
				'ImageThumbQuality' => 'Int',
			),
			
			'defaults' => array(
				'ImageThumbQuality' => 80,
			 	'DateFormat' => 'l j F Y',
			 	'TimeFormat' => 'g:ia',
			 	'DateFormatShort' => 'd M Y',
			 	'TimeFormatShort' => 'H:i',
			 ),
			 
		);
	}

	public function updateCMSFields(FieldSet &$fields) {
		$fields->addFieldToTab("Root.Analytics", new TextField("AnalyticsKey", "Website Analytics Key"));
		
		$fields->addFieldToTab("Root.Mapping", new TextField("MappingKey", "Mapping Key"));
		$fields->addFieldToTab("Root.Mapping", new TextField("DefaultLatitude", "Default Latitude"));
		$fields->addFieldToTab("Root.Mapping", new TextField("DefaultLongitude", "Default Longitude"));
		$fields->addFieldToTab("Root.Mapping", new TextField("DefaultZoom", "Default Zoom"));
		
		$fields->addFieldToTab("Root.ContactDetails", new TextField("GeneralEmailRecipient", "General Email Recipient"));
		$fields->addFieldToTab("Root.ContactDetails", new TextField("GeneralEmailSender", "General Email Sender (where site emails come from"));
		$fields->addFieldToTab("Root.ContactDetails", new TextField("WebmasterEmailRecipient", "Webmaster Email Recipient"));
		
		//source branch for open source projects
		$fields->addFieldToTab("Root.SourceCode", new TextField("SourcePage", "Project Source Page"));
		$fields->addFieldToTab("Root.SourceCode", new TextField("SourceBranch", "Project Source Branch Location"));
		
		//social stuff
		$fields->addFieldToTab("Root.Social", new TextField("TwitterURL", "Twitter page"));
		$fields->addFieldToTab("Root.Social", new TextField("FacebookURL", "Facebook page"));
		$fields->addFieldToTab("Root.Social", new TextField("IdenticaURL", "identi.ca page"));
		
		//misc
		$fields->addFieldToTab("Root.Images", new TextField("ImageThumbQuality", "Image Thumb Quality (0-100)"));
		
		//date.time formatting
		$fields->addFieldToTab("Root.DateTime", new TextField("DateFormat", "Date format"));
		$fields->addFieldToTab("Root.DateTime", new TextField("TimeFormat", "Time format"));
		$fields->addFieldToTab("Root.DateTime", new TextField("DateFormatShort", "Date format (short)"));
		$fields->addFieldToTab("Root.DateTime", new TextField("TimeFormatShort", "Time format (short)"));
	}
}
?>