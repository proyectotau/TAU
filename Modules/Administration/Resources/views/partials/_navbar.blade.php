<!-- will be used to show navigation bar -->
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('/') }}">Nerd Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ route('admin.users.index') }}">View All Users</a></li>
        <li><a href="{{ route('admin.users.create') }}">Create a New User</a></li>
    </ul>
</nav>