<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ Route::is('employees.*') ? 'active' : '' }}">
          <a class="nav-link" href="/employees">Employees</a>
        </li>
        <li class="nav-item {{ Route::is('users.*') ? 'active' : '' }}">
          <a class="nav-link" href="/users">Users</a>
        </li>
        <li class="nav-item {{ Route::is('payouts.*') ? 'active' : '' }}">
          <a class="nav-link" href="/payouts">Payouts</a>
        </li>
        <li class="nav-item {{ Route::is('sports.*') ? 'active' : '' }}">
          <a class="nav-link" href="/sports">Sports</a>
        </li>
        <li class="nav-item {{ Route::is('leagues.*') ? 'active' : '' }}">
          <a class="nav-link" href="/leagues">Leagues</a>
        </li>
        <li class="nav-item {{ Route::is('teams.*') ? 'active' : '' }}">
          <a class="nav-link" href="/teams">Teams</a>
        </li>
        <li class="nav-item {{ Route::is('players.*') ? 'active' : '' }}">
          <a class="nav-link" href="/players">Players</a>
        </li>
        <li class="nav-item {{ Route::is('receipts.*') ? 'active' : '' }}">
          <a class="nav-link" href="/receipts">Receipts</a>
        </li>
        <li class="nav-item {{ Route::is('cities.*') ? 'active' : '' }}">
          <a class="nav-link" href="/cities">Cities</a>
        </li>
        <li class="nav-item {{ Route::is('shops.*') ? 'active' : '' }}">
          <a class="nav-link" href="/shops">Shops</a>
        </li>
        <li class="nav-item {{ Route::is('matches.*') ? 'active' : '' }}">
          <a class="nav-link" href="/matches">Matches</a>
        </li>
        <li class="nav-item {{ Route::is('bets.*') ? 'active' : '' }}">
          <a class="nav-link" href="/bets">Bets</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>