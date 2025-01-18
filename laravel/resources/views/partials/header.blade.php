<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="hamburger pull-right visible-xs">
            <span class="glyphicon glyphicon-menu-hamburger"></span>
        </div>

        <div class="navbar-header">
            <a class="pull-left" href="/"><img style="padding:5px" src="/img/apo-logo-particle.png"></a>
            <a class="navbar-brand" href="/">Weightlifter</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'judge', 'kitten', 'observer']))
                    <li><a href="/applications">Applications</a></li>
                    <li><a href="/rounds">Rounds</a></li>
                    <li><a href="/users">Users</a></li>
                    <li><a href="/questions">Questions</a></li>
                    <li><a href="/criteria">Criteria</a></li>
                    <li><a href="/scores">Scores</a></li>
                    @if(Auth::check()&& in_array(Auth::user()->role, ['admin']))
                        <li><a href="/reports/view">Reports</a></li>
                    @endif
                @else
                    <li><a href="/about">About</a></li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="/users/profile">Profile</a></li>
                    <li><a href="/logout">Logout</a></li>
                @else
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
