<?php
/**
 * @package sydphp
 * @note contact page model and controller for sydphp.org
 */
class ContactPage extends Codem_ImageGalleryPage {

	public static $db = array(
	);

	public static $has_one = array(
	);
	
	static $hide_ancestor = "Codem_ImageGalleryPage";

}
class ContactPage_Controller extends Codem_ImageGalleryPage_Controller {
	public function CssClass() {
		return "page contactpage";
	}
	
	public function index() {
		return $this->renderWith(array('ContactPage','Page'));
	}
	
	/**
	 * ContactForm for the page
	 */
	protected function ContactFormItems() {
		$items = array();
		$items[] = new TextField('contact[Name]', 'Name <sup>*</sup>');
		$items[] = new TextField('contact[Company]', 'Company');
		$items[] = new EmailField('contact[Email]', 'Email <sup>*</sup>');
		$items[] = new TextField('contact[Phone]', 'Phone');
		$items[] = new TextareaField('contact[Comments]', 'Comments <sup>*</sup>');
		return $items;
	}
	
	public function ContactForm() {
		$items = $this->ContactFormItems();
		$validator = new RequiredFields('contact[Name]', 'contact[Email]', 'contact[Comments]');
		if($this->use_spam_expression) {
			// Recreate a validator containing the expression
			$validator = new RequiredFields('contact[Name]', 'contact[Email]', 'contact[Comments]', 'expression');
		}
		$fields = new FieldSet($items);
		// Create actions
		$actions = new FieldSet(
			new FormAction('ContactFormSubmit', 'Send')
		);
		$form = new Form($this, 'ContactForm', $fields, $actions, $validator);
		return $form;
	}
	
	public function ContactFormSubmit($data, $form) {
		$to = "organisers@sydphp.org";
		//$to = "james@localhost";
		$subject = "Email from the website";
		
		//test captcha
		$message = array();
		$message['Contact'] = "";
		if(isset($data['contact'])) {
			foreach($data['contact'] as $key=>$value) {
				$message['Contact'] .= "<h4>{$key}</h4><p>";
				switch($key) {
					default:
						$message['Contact'] .= htmlentities($value, ENT_QUOTES, 'UTF-8');
						break;
				}
				$message['Contact'] .= "</p>\n";
			}
			
			$email = new Email($data['contact']['Email'], $to, $subject);
			$email->replyTo($data['contact']['Email']);
			//set template
			$email->setTemplate('ContactEmail');
			//populate template
			$email->populateTemplate($message);
			//send mail
			$email->send();
			
			//redirect...
			$location = $this->Link();
			
			$form->sessionMessage('Thanks for your email.','message-good');
			Director::redirect($location);
		}
		
		$form->sessionMessage('Your message could not be sent, some information is missing.','message-bad');
	}
}
?>