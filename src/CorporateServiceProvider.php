<?php

namespace Eutranet\Corporate;

use Eutranet\Init\PackageServiceProvider;
use Eutranet\Init\Package;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Eutranet\Corporate\Http\Middleware\CorporateMigratedMiddleware;
use Eutranet\Corporate\Providers\CorporateMenuServiceProvider;
use Eutranet\Corporate\Console\Commands\EutranetInstallCorporateCommand;
use Florbela\FlorbelaBackend\Http\Middleware\HasCurrentUserMiddleware;

class CorporateServiceProvider extends PackageServiceProvider
{
	public function configurePackage(Package $package): void
	{
		$package
			->name('laravel-corporate')
			->hasConfigFile('eutranet-corporate') // php artisan vendor:publish --tag=your-laravel-init-name-config
			->hasViews('corporate')
			// ->hasViewComponent('setup', Alert::class)
			->hasMigration('add_user_status_id_to_users_table')
			->hasMigration('create_corporate_agreements_table')
			->hasMigration('create_corporates_table')
			->hasMigration('create_agencies_table')
			->hasMigration('add_agency_id_to_staff_members_table')
			->hasMigration('create_corporate_staff_member_table')
			->hasMigration('create_staff_member_user_table')
			->hasMigration('create_corporate_general_terms_table')
			->hasMigration('create_notification_templates_table')
			->hasMigration('create_contact_attempts_table')
			->hasMigration('create_feedbacks_table')
			->hasMigration('create_consultations_table')
			->hasCommand(EutranetInstallCorporateCommand::class)
			->hasRoutes(['config', 'back', 'setup', 'web']);
		// ->hasMigration('create_package_tables');
	}

	public function boot()
	{
		parent::boot();

		// ... other things
		$this->registerRoutes();

		$router = $this->app->make(Router::class);
		$router->aliasMiddleware('has-current-user', HasCurrentUserMiddleware::class);
		$router->aliasMiddleware('corporate-migrated', CorporateMigratedMiddleware::class);
		$router->pushMiddlewareToGroup('web', 'corporate-migrated');
	}

	protected function registerRoutes()
	{
		Route::group($this->routeConfiguration(), function () {
			$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
			$this->loadRoutesFrom(__DIR__ . '/../routes/back.php');
			$this->loadRoutesFrom(__DIR__ . '/../routes/setup.php');
			$this->loadRoutesFrom(__DIR__ . '/../routes/config.php');
		});
	}

	protected function routeConfiguration(): array
	{
		return [
			// 'middleware' => config('eutranet-be.middlewares'),
		];
	}

	public function register()
	{
		parent::register();
		$this->loadMigrationsFrom(app_path('Eutranet/Corporate/database/migrations'));
		$this->app->register(CorporateMenuServiceProvider::class);
		// $this->mapRoutes($this->app->router);
	}
}