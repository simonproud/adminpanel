<div id="sidebar" class="sidebar">
  <!-- begin sidebar scrollbar -->
  <div data-scrollbar="true" data-height="100%">
    <!-- begin sidebar user -->
    <ul class="nav">
      <li class="nav-profile">
        <a href="javascript:;" data-toggle="nav-profile">
          <div class="image">
            @isset($USER_AVATAR) <img src="{{$USER_AVATAR}}" alt="" />@endisset
          </div>
          <div class="info">
            <b class="caret pull-right"></b>
            @isset($USER_FIRST_NAME){{$USER_FIRST_NAME}} {{$USER_SECOND_NAME}}
            <small>{{$USER_WORKING_POSITION}}</small>@endisset
          </div>
        </a>
      </li>
      <li>
        <ul class="nav nav-profile">
          <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
          <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
          <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
        </ul>
      </li>
    </ul>
    <!-- end sidebar user -->
    <!-- begin sidebar nav -->
        @widget('MenuWidget')
    <!-- end sidebar nav -->
  </div>
  <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->