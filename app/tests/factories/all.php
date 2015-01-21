<?php

use League\FactoryMuffin\Facade as FactoryMuffin;

FactoryMuffin::define('Points', array(
	'user_id' => 'factory|User'
));

FactoryMuffin::define('User', array(
	'name' => 'firstName'
));