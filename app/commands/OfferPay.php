<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class OfferPay extends ScheduledCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'offers:pay';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Charge for the offers that ended today.';
	protected $offer;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(RAYVR\Storage\Offer\OfferRepository $offer)
	{
		$this->offer = $offer;
		parent::__construct();
	}

	/**
	 * When a command should run
	 *
	 * @param Scheduler $scheduler
	 * @return \Indatus\Dispatcher\Scheduling\Schedulable
	 */
	public function schedule(Schedulable $scheduler)
	{
		return $scheduler->daily()->hours(22);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->line('Kicking off today\'s offers.');
		$this->offer->closeOffers();
		$this->line('The offers have been started.');
		Log::info('Offer closeout completed.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['example', InputArgument::OPTIONAL, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}
}