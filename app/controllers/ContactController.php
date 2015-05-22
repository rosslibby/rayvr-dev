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
			if(Auth::user()->business && Auth::user()->active == 1)
			{
				return Redirect::to('business-contact')->with('success', 'We have received your message and will get back to you shortly.');
			}
			else if(!Auth::user()->business && Auth::user()->active == 1)
			{
				return Redirect::to('support')->with('success', 'We have received your message and will get back to you shortly.');
			}
			else return Redirect::to('contact')->with('success', 'We have received your message and will get back to you shortly.');
		else
		{ 
			if(Auth::user()->business && Auth::user()->active == 1)
			{
				return Redirect::to('business-contact')->with('error', 'Sorry, your message did not send. Please try again.');
			}
			else if((!Auth::user()->business) && Auth::user()->active == 1)
			{
				return Redirect::to('support')->with('error', 'Sorry, your message did not send. Please try again.');
			}
			else return Redirect::to('contact')->with('error', 'Sorry, your message did not send. Please try again.');
		}
	}
}