<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
      <li class="nav-item d-none d-md-block"><a href="{{url('/')}}" class="nav-link" target="_blank">Home</a></li>
      <li class="nav-item d-none d-md-block"><a href="{{route('contact')}}" class="nav-link" target="_blank">Contact</a></li>
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img
            src="{{asset('admin/assets/img/user2-160x160.jpg')}}"
            class="user-image rounded-circle shadow"
            alt="User Image"
          />
          <span class="d-none d-md-inline">
              @auth
                  {{ auth()->user()->name }}
              @endauth
          </span>
        </a>
      </li>
      <li>
        <li class="user-footer d-flex justify-content-between px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-default btn-flat">
                    Sign out
                </button>
            </form>
        </li>
      </li>
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->



<script>
  document.addEventListener('click', function (e) {
      const toggleBtn = e.target.closest('[data-lte-toggle="sidebar"]');
      if (!toggleBtn) return;

      // AdminLTE toggle করার পরে একটু delay দিয়ে state পড়ি
      setTimeout(() => {
          if (document.body.classList.contains('sidebar-collapse')) {
              localStorage.setItem('sidebarState', 'collapsed');
          } else {
              localStorage.setItem('sidebarState', 'expanded');
          }
      }, 0);
  });
  window.addEventListener('DOMContentLoaded', function () {
    const sidebarState = localStorage.getItem('sidebarState');

    if (sidebarState === 'collapsed') {
        document.body.classList.add('sidebar-collapse');
    }
  }); 
</script>

