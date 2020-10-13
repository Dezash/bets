<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        @can('viewAny', App\Models\Employee::class)
        <li class="nav-item {{ Route::is('employees.*') ? 'active' : '' }}">
          <a class="nav-link" href="/employees">Employees</a>
        </li>
        @endcan
        @can('viewAny', App\Models\User::class)
        <li class="nav-item {{ (Route::is('users.*') && !Route::is('users.users.show')) ? 'active' : '' }}">
          <a class="nav-link" href="/users">Users</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Payout::class)
        <li class="nav-item {{ Route::is('payouts.*') ? 'active' : '' }}">
          <a class="nav-link" href="/payouts">Payouts</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Sport::class)
        <li class="nav-item {{ Route::is('sports.*') ? 'active' : '' }}">
          <a class="nav-link" href="/sports">Sports</a>
        </li>
        @endcan
        @can('viewAny', App\Models\League::class)
        <li class="nav-item {{ Route::is('leagues.*') ? 'active' : '' }}">
          <a class="nav-link" href="/leagues">Leagues</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Team::class)
        <li class="nav-item {{ Route::is('teams.*') ? 'active' : '' }}">
          <a class="nav-link" href="/teams">Teams</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Player::class)
        <li class="nav-item {{ Route::is('players.*') ? 'active' : '' }}">
          <a class="nav-link" href="/players">Players</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Receipt::class)
        <li class="nav-item {{ Route::is('receipts.*') ? 'active' : '' }}">
          <a class="nav-link" href="/receipts">Receipts</a>
        </li>
        @endcan
        @can('viewAny', App\Models\City::class)
        <li class="nav-item {{ Route::is('cities.*') ? 'active' : '' }}">
          <a class="nav-link" href="/cities">Cities</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Shop::class)
        <li class="nav-item {{ Route::is('shops.*') ? 'active' : '' }}">
          <a class="nav-link" href="/shops">Shops</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Match::class)
        <li class="nav-item {{ Route::is('matches.*') ? 'active' : '' }}">
          <a class="nav-link" href="/matches">Matches</a>
        </li>
        @endcan
        @can('viewAny', App\Models\Bet::class)
        <li class="nav-item {{ Route::is('bets.*') ? 'active' : '' }}">
          <a class="nav-link" href="/bets">Bets</a>
        </li>
        @endcan
      </ul>
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        @can('view', Auth::user(), App\Models\User::class)
        <li class="nav-item {{ Request::is('users/' . Auth::user()->id) ? 'active' : '' }}">
        <a class="nav-link" href="{{ '/users/' . Auth::user()->id }}">Profile</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>