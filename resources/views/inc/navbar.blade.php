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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>