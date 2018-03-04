<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  
  <a class="navbar-brand" href="#">
    {{ config('app.name' )}}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{ isset($home_page) ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('home') }}"><i class="material-icons" style="vertical-align: middle;font-size: 16px;">home</i> Home</a>
      </li>

      @if (session('drive') != null)
        <li class="nav-item {{ isset($profile_page) ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('profile') }}"><i class="material-icons" style="vertical-align: middle;font-size: 18px;">account_circle</i> User Info</a>
        </li>
        
        <li class="nav-item {{ isset($list_page) ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('lists') }}"><i class="material-icons" style="vertical-align: middle;font-size: 18px;">toc</i> List Files
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="https://github.com/andriawan/AndDrive"><i class="material-icons" style="vertical-align: middle; font-size: 18px;">launch</i> Fork Me on Github</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" ><i class="material-icons" style="vertical-align: middle;font-size: 18px;">settings_power</i> Logout</a>
        </li>
      @endif

    </ul>
    
    @if (session('drive') != null)
      <span class="navbar-text" style="padding-right:  15px;">
          Hello {{ session('drive')->name }}
      </span>
      <img src="{{ session('drive')->picture }}" width="50" height="50" class="d-inline-block align-top" alt="" style="border-radius:50%;">
    @endif
  </div>

</nav>