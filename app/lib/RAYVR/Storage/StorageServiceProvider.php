<?php namespace RAYVR\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'RAYVR\Storage\User\UserRepository',
			'RAYVR\Storage\User\EloquentUserRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Category\CategoryRepository',
			'RAYVR\Storage\Category\EloquentCategoryRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Interest\InterestRepository',
			'RAYVR\Storage\Interest\EloquentInterestRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Offer\OfferRepository',
			'RAYVR\Storage\Offer\EloquentOfferRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Preference\PreferenceRepository',
			'RAYVR\Storage\Preference\EloquentPreferenceRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Contact\ContactRepository',
			'RAYVR\Storage\Contact\EloquentContactRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Matches\MatchesRepository',
			'RAYVR\Storage\Matches\EloquentMatchesRepository'
		);

		$this->app->bind(
			'RAYVR\Storage\Order\OrderRepository',
			'RAYVR\Storage\Order\EloquentOrderRepository'
		);
	}
}