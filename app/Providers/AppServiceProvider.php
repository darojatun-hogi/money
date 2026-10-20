<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Menu;
use App\Models\PersonalAccessToken;
use App\Models\Transaction;
use App\Models\TransactionName;
use App\Models\User;
use App\Models\Wallet;
use App\Observers\MenuObserver;
use App\Policies\CategoryPolicy;
use App\Policies\FeedbackPolicy;
use App\Policies\MenuPolicy;
use App\Policies\TransactionNamePolicy;
use App\Policies\TransactionPolicy;
use App\Policies\WalletPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Models\Permission;
use App\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        // super-admin berlaku di semua app yang memakai tabel auth bersama
        Gate::before(fn (User $user) => $user->hasRole(config('access.super_admin_role')) ? true : null);

        Gate::policy(Menu::class, MenuPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(TransactionName::class, TransactionNamePolicy::class);
        Gate::policy(Wallet::class, WalletPolicy::class);
        Gate::policy(Transaction::class, TransactionPolicy::class);
        Gate::policy(Feedback::class, FeedbackPolicy::class);

        Menu::observe(MenuObserver::class);

        // Tur dashboard tampil sekali setiap kali user login di hub SSO (sso.login_at diisi hub)
        View::composer('template.master', function ($view) {
            $loginAt = session('sso.login_at');
            $show = $loginAt && session('money.tour_login_at') !== $loginAt;

            if ($show) {
                session(['money.tour_login_at' => $loginAt]);
            }

            $view->with('showTour', (bool) $show);
        });

        View::composer('template.sidebar', function ($view) {
            $menus = Menu::with('children')
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $view->with('sidebarMenus', $menus);
        });
    }
}
