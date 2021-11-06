<?php

namespace App\Providers;

use App;
use App\Category;
use App\Country;
use App\GeneralSetting;
use App\LocalizationSetting;
use App\Product;
use App\Prod;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \View::composer('*', function ($view) {
            if ($view->getName() != 'admin.category.index') {
                $userid = auth()->id();
                $query = DB::table('users')
                    ->Join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->Join('roles', 'roles.id', '=', 'role_user.role_id')
                    ->where('users.id', $userid)
                    ->select('roles.name')
                    ->get();

                $marks = User::getMarks($userid);

                if (@$userid) {
                    $user = User::where('id', $userid)->get();
                    $user_status = $user[0]['block'];
                } else {
                    $user_status = 0;
                }
                $single_user_detail = User::where('id', $userid)->first();

                $categorys = Category::where('status', 1)->orderBy('name', 'asc')->get();

                $view->with(
                    [
                        'units' => Unit::orderBy('Name', 'ASC')->get(),
                        'marks' => $marks,
                        'categorys' => $categorys,
                        'roles' => $query,
                        'user_status' => $user_status,
                        'm_products' => Product::all(),
                        'all_country' => Country::all(),
                        'allproducts' => Prod::all(),
                        'general_setting' => GeneralSetting::first(),
                        'localization_setting' => LocalizationSetting::first(),
                        'main_categorys' => Category::where('parent', 0)->where('status', 1)->orderBy('name', 'asc')->paginate(8),
                        'sub_categorys' => Category::whereRaw("parent != 0")->where('status', 1)->orderBy('name', 'asc')->get(),
                        'single_user_detail' => $single_user_detail,
                        // 'ordercount' => Order::salescount(auth()->id()) + Order::transactioncount(auth()->id()),
                    ]
                );
            }

            $localization_setting = LocalizationSetting::first();
            App::setLocale($localization_setting->language);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}