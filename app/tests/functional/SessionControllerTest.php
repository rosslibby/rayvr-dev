<?php

class SessionControllerTest extends TestCase {

	/**
	 * Test Index
	 */
	public function testCreate()
	{
		$this->call('GET', 'login');

		$this->assertResponseOk();
	}
}