<div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
        <div class="header-logo">
            <a href="/dashboard">
                <img src="{{ asset('admin/img/logo.png') }}" alt="logo">
            </a>
        </div>
        <div id="sidebar-toggle-button" class="toggle-button sidebar-toggle">
            <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
            </button>
        </div>
    </div>
    <div class="d-md-none mobile-nav-bar">
        <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button id="sidebar-toggle-button-mobile" type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
        <ul class="navbar-nav">

        </ul>
        <ul class="navbar-nav">
            <li class="navbar-item dropdown header-notification">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                    <span>8</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">03 Notifiacations</h6>
                    </div>
                    <div class="item-content">
                        <div class="media">
                            <div class="item-icon bg-skyblue">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Complete Today Task</div>
                                <span>1 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-orange">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Director Metting</div>
                                <span>20 Mins ago</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="item-icon bg-violet-blue">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div class="media-body space-sm">
                                <div class="post-title">Update Password</div>
                                <span>45 Mins ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-expanded="false">
                    <div class="admin-title">
                        <h5 class="item-title">Stevne Zone</h5>
                        <span>Admin</span>
                    </div>
                    <div class="admin-img">
                        <img src="{{ asset('admin/img/figure/admin.jpg') }}" alt="Admin">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title">Steven Zone</h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            <li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                            <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                            <li><a href="#"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>
                            <li><a href="#"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="/logout"
                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <i class="flaticon-turn-off"></i>
                                        Log Out
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
