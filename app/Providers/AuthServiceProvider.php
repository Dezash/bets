<?php

namespace App\Providers;

use App\Models\Employee;
use App\Models\League;
use App\Models\Match;
use App\Models\Payout;
use App\Models\Receipt;
use App\Policies\BetPolicy;
use App\Policies\CityPolicy;
use App\Policies\EmployeePolicy;
use App\Policies\LeaguePolicy;
use App\Policies\MatchPolicy;
use App\Policies\PayoutPolicy;
use App\Policies\PlayerPolicy;
use App\Policies\ReceiptPolicy;
use App\Policies\ShopPolicy;
use App\Policies\SportPolicy;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Bet::class => BetPolicy::class,
        City::class => CityPolicy::class,
        Employee::class => EmployeePolicy::class,
        League::class => LeaguePolicy::class,
        Match::class => MatchPolicy::class,
        Payout::class => PayoutPolicy::class,
        Player::class => PlayerPolicy::class,
        Receipt::class => ReceiptPolicy::class,
        Shop::class => ShopPolicy::class,
        Sport::class => SportPolicy::class,
        Team::class => TeamPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
