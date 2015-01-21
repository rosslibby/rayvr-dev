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
			'RAYVR\Storage\Preference\PreferenceRepository',
			'RAYVR\Storage\Preference\EloquentPreferenceRepository'
		);
	}
}