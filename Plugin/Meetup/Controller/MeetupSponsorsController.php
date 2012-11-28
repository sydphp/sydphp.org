<?php
/**
 * Sponsors Controller
 *
 * @package sydphp
 * @author Predominant
 */
class MeetupSponsorsController extends AppController {

	public function index() {
		$this->MeetupSponsor->get();
	}
}
