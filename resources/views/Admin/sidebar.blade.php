  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


      <li class="nav-heading">Pages</li>
    @if(auth()->user()->role ==1)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user-list')}}">
          <i class="bi bi-person"></i>
          <span>User</span>
        </a>
      </li><!-- End Profile Page Nav -->
    @endif
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('testimonials-list')}}">
          <i class="bi bi-question-circle"></i>
          <span>Testimonials</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item ">
        <a class="nav-link collapsed {{ Request::routeIs('project-list') || Request::routeIs('project-add') || Request::routeIs('project-edit')   ? 'active' : '' }}" href="{{route('project-list')}}">
          <i class="bi bi-envelope"></i>
          <span>Project</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed {{ Request::routeIs('contact-list') ? 'active' : '' }}" href="{{route('contact-list')}}">
            <i class="bi bi-person-rolodex"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin-about')}}">
          <i class="bi bi-card-list"></i>
          <span>About</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('service-list')}}">
          <i class="bi bi-question-circle"></i>
          <span>Service</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('team-list')}}">
            <i class="bi bi-people-fill"></i>
          <span>Team</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin-achievements')}}">
            <i class="bi bi-bullseye"></i>
          <span>Achievements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('change-password.form')}}">
            <i class="bi bi-shield-lock-fill"></i>
          <span>Change Password</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('logout')}}">
            <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
