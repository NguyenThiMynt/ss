<header class="main-header">
    <a href="#" class="sidebar-toggle icon-bar d-lg-none d-block" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <a href="#" class="logo lg-title">
        <span class="logo-lg">セミナー管理システム</span>
    </a>
    <a href="#" class="logout float-right d-block d-md-none">Logout</a>
    <nav class="navbar navbar-static-top menu d-none d-md-block">
        <div class="seach-box">
            <form>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="input-group-text" id="basic-addon"><img src="{{asset('backend/images/icon_search.png')}}" class="icon-search"></button>
                    </div>
                    <input type="text" class="form-control" placeholder="検索" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
        </div>
        <div class="navbar-right d-none d-md-block mt-2">
            <a href="{{route('admin.login')}}" class="lg-out">Logout</a>
        </div>
    </nav>
</header>
