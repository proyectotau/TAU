<!-- will be used to show navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ URL::to('/') }}">ADMINISTRACION DEL SISTEMA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                   aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="{{ route('admin.users.index') }}">View All Users
                    <span class="sr-only">(current)</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.groups.index') }}">View All Groups</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.roles.index') }}">View All Roles</a></li>

        </ul>
    </div>
</nav>