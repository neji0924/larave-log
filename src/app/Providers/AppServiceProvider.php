<?php

namespace Neji0924\Log\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

Class AppServiceProvider extends BaseServiceProvider
{
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
	}

	public function register()
	{
		//
	}
}