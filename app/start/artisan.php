<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/
$offer = App::make('RAYVR\Storage\Offer\OfferRepository');

Artisan::add(new OfferStarterCommand($offer));
Artisan::add(new OfferDistribution($offer));
Artisan::add(new OfferPay($offer));
Artisan::add(new CheckReviews($offer));
Artisan::add(new SecondMatching($offer));