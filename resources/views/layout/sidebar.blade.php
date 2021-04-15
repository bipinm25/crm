<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item"><a href="{{route('dashboard')}}"><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a></li>    
          <li class=" nav-item"><a href="{{route('company')}}"><i class="icon-menu"></i><span class="menu-title" data-i18n="nav.dash.main">Company</span></a></li>    
          <li class=" nav-item"><a href="{{route('users')}}"><i class="icon-user"></i><span class="menu-title" data-i18n="nav.dash.main">User</span></a></li>

          <li class=" nav-item"><a href=""><i class="icon-menu"></i><span class="menu-title" data-i18n="nav.dash.main">Task</span></a></li>
        
          <li class=" navigation-header"><span data-i18n="nav.category.support">Settings</span><i class="ft-more-horizontal ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Settings"></i></li>

          <li class=" nav-item"><a href=""><i class="ft-settings"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">General Settings</span></a></li>
          @hasrole('Super-admin')
            <li class=" nav-item"><a href="{{route('role')}}"><i class="icon-support"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Role & Permission</span></a></li>
          @endhasrole
        </ul>
      </div>
    </div>