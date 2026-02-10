<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ url('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('uploads/general/'.GeneralSetting()->logo) }}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin-Dashboard</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              
                <a href="#" class="nav-link active">
                  <p> 
                    <strong>
                        Dashboard
                    </strong>
                  </p>
                </a>
              <li class="nav-item">
                <a href="{{ route('newsletters') }}" class="nav-link">
                  <i class="nav-icon bi bi-caret-right"></i>
                  <p>Newsletter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('allContact') }}" class="nav-link">
                  <i class="nav-icon bi bi-caret-right"></i>
                  <p>Contact</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('allUser') }}" class="nav-link">
                  <i class="nav-icon bi bi-caret-right"></i>
                  <p>All User</p>
                </a>
              </li>
              <a href="#" class="nav-link active">
                <p> 
                  <strong>
                      Blog Management
                  </strong>
                </p>
              </a>
              <li class="nav-item">
                  <a href="{{ route('dashboard.posts.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-newspaper"></i>
                      <p>All Posts</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('dashboard.posts.create') }}" class="nav-link">
                      <i class="nav-icon bi bi-plus-circle"></i>
                      <p>Add New Post</p>
                  </a>
              </li>
              <a href="#" class="nav-link active">
                <p> 
                  <strong>
                      Page Settings
                  </strong>
                </p>
              </a>
              <li class="nav-item">
                <a href="{{route('generalSettings.index')}}" class="nav-link">
                  <i class="nav-icon bi bi-patch-check-fill"></i>
                  <p>GeneralSettings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-patch-check-fill"></i>
                  <p>ColorSettings</p>
                </a>
              </li>
              <a href="#" class="nav-link active">
                <p> 
                  <strong>
                      <p>######</p>
                  </strong>
                </p>
              </a>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-question-circle-fill"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-question-circle-fill"></i>
                  <p>License</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->