<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider{

	public function boot(): void{
		URL::forceScheme('https'); // 👈 THÊM DÒNG NÀY

		Blade::directive('formatPrice', function ($price){
			return "<?php echo number_format($price, 0, ',', '.').' đ' ?>";
		});

		Blade::directive('formatWeight', function($weight){
			return "<?php echo number_format(round(intval($weight)/1000),1, ',', '.'). ' kg' ?>";
		});

		Paginator::useBootstrapFive();
	}

	public function isEmail(string $email){
		if(preg_match("/^[\w._]+@[\w._]+\.[a-zA-Z]{2,}$/", $email)){
			return true;
		}
		return false;
	}
}
