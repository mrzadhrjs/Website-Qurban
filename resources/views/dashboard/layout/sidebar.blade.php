<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/user*') ? 'active' : ''}}" href="/dashboard/user">
            <span data-feather="user" class="align-text-bottom"></span>
            User
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/hewan*') ? 'active' : ''}}" href="/dashboard/hewan">
            <span data-feather="truck" class="align-text-bottom"></span>
            Hewan
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/grade*') ? 'active' : ''}}" href="/dashboard/grade">
            <span data-feather="slack" class="align-text-bottom"></span>
            Grade
          </a>
        </li>
      </ul>
    </div>
  </nav>