<div id="header" class="header navbar-default">
  <!-- begin navbar-header -->
  <div class="navbar-header">
    <a href="/" class="navbar-brand">
      <span class="navbar-logo"></span>
      <b>ho</b>CRM
    </a>
    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <!-- end navbar-header -->
  
  <!-- begin header-nav -->
  <ul class="navbar-nav navbar-right">
    <li>
      <form class="navbar-form">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter keyword" />
          <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </li>
    <notifications-header :user="{{Auth::user()}}"></notifications-header>

    <li class="dropdown navbar-user">
      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        @isset($USER_AVATAR) <img src="{{$USER_AVATAR}}" alt="" />@endisset
        <span class="d-none d-md-inline">@isset($USER_FIRST_NAME){{$USER_FIRST_NAME}} {{$USER_SECOND_NAME}}@endisset</span> <b class="caret"></b>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="/personal" class="dropdown-item">Show Profile</a>
        <a href="/personal/edit" class="dropdown-item">Edit Profile</a>

      </div>
    </li>
  </ul>
  <!-- end header navigation right -->
</div>
<!-- end #header -->