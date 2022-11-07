<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
        <br>
        <li>
            <a href="http://34.204.43.32/provider">Manage Status</a>
        </li>
        <li>
            <a href="{{ route('driver') }}">Driver Earnings</a>
        </li>
        <li>
            <a href="#">Invite</a>
        </li>
        <li>
            <a href="{{ route('provider.profile.index') }}">Valued Driver Profile</a>
        </li>
        <li>
            <a href="http://34.204.43.32/provider/documents">Manage My Documents</a>
        </li>
        <li>
            <a href="#">Help & Driver's Guide</a>
        </li>
        <li>
            <a href="{{ url('/provider/logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ url('/provider/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</nav>