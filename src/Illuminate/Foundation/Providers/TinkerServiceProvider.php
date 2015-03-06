<?php namespace Illuminate\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\TinkerCommand;

class TinkerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		if (self::is_repl_available())
		{
			$this->app->bindShared('command.tinker', function()
			{
				return new TinkerCommand;
			});

			$this->commands('command.tinker');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		if (self::is_repl_available())
		{
			return array('command.tinker');
		}
		return array();
	}

	public static function is_repl_available()
	{
		return class_exists('\\Boris\\Boris') && extension_loaded('readline') && extension_loaded('posix') && extension_loaded('pcntl');
	}

}
