<aside class="main-sidebar sidebar-left">
    <section class="sidebar mt-3">
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{route('calendar.index')}}">
                    <img src="{{asset('backend/images/icon_calendar.png')}}"> <span>カレンダー</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a href="{{route('user.index')}}">
                    <img src="{{asset('backend/images/icon_customers.png')}}"> <span>会員管理</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a href="{{route('notification.index')}}">
                   <img src="{{asset('backend/images/icon_chat-room.png')}}"> <span>お知らせ管理</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li>
                <a href="{{route('blogs.index')}}">
                    <img src="{{asset('backend/images/icon_blog.png')}}"> <span>チュートリアル</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
        </ul>
    </section>
</aside>
