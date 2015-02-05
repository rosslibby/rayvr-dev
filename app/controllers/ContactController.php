<?php

use RAYVR\Storage\Contact\ContactRepository as Contact;

class ContactController extends BaseController {

	protected $contact;

	public function __construct(Contact $contact)
	{
		$this->contact = $contact;
	}

	/**
	 * Primary contact form
	 */
	public function primary()
	{
		$s = $this->contact->create(Input::all());

		if($s->save())
			return Redirect::to('contact')->with('success', 'We have received your message and will get back to you shortly.');
		return Redirect::to('contact')->with('error', 'Sorry, your message did not send. Please try again.');
	}
}