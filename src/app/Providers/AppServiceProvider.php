<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	public function boot(): void{
		Blade::directive('formatPrice', function ($price){
			return "<?php echo number_format($price, 0, ',', '.').' đ' ?>";
		} );

		Blade::directive('formatWeight', function($weight){
			return "<?php echo number_format(round(intval($weight)/1000),1, ',', '.'). ' kg' ?>";
		});
	}
}
