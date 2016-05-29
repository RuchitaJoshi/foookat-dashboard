<li class="{{ Request::is('dashboard/dashboard') ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

<li class="{{ Request::is('admins/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-user-secret"></i> <span class="nav-label">Admins</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('admins/all') || Request::is('admins/all/*') ? 'active' : '' }}"><a href="{{ route('admins.all') }}">All</a></li>
        <li class="{{ Request::is('admins/create') ? 'active' : '' }}"><a href="{{ route('admins.create') }}">Create</a></li>
    </ul>
</li>

<li class="{{ Request::is('businesses/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Businesses</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('businesses/all') || Request::is('businesses/all/*') ? 'active' : '' }}"><a href="{{ route('businesses.all') }}">All</a></li>
        <li class="{{ Request::is('businesses/create') ? 'active' : '' }}"><a href="{{ route('businesses.create') }}">Create</a></li>
    </ul>
</li>

<li class="{{ Request::is('users/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('users/all') || Request::is('users/all/*') ? 'active' : '' }}"><a href="{{ route('users.all') }}">All</a></li>
        <li class="{{ Request::is('users/create') ? 'active' : '' }}"><a href="{{ route('users.create') }}">Create</a></li>
    </ul>
</li>

<li class="{{ Request::is('locations/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-map-marker"></i> <span class="nav-label">Locations</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('locations/states') || Request::is('locations/states/*') ? 'active' : '' }}">
            <a href="#">States<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level collapse">
                <li class="{{ Request::is('locations/states/all') || Request::is('locations/states/all/*') ? 'active' : '' }}"><a href="{{ route('locations.states.all') }}">All</a></li>
                <li class="{{ Request::is('locations/states/create') ? 'active' : '' }}"><a href="{{ route('locations.states.create') }}">Create</a></li>
            </ul>
        </li>
    </ul>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('locations/cities') || Request::is('locations/cities/*') ? 'active' : '' }}">
            <a href="#">Cities<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level collapse">
                <li class="{{ Request::is('locations/cities/all') || Request::is('locations/cities/all/*') ? 'active' : '' }}"><a href="{{ route('locations.cities.all') }}">All</a></li>
                <li class="{{ Request::is('locations/cities/create') ? 'active' : '' }}"><a href="{{ route('locations.cities.create') }}">Create</a></li>
            </ul>
        </li>
    </ul>
</li>

<li class="{{ Request::is('categories/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Categories</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('categories/all') || Request::is('categories/all/*') ? 'active' : '' }}"><a href="{{ route('categories.all') }}">All</a></li>
        <li class="{{ Request::is('categories/create') ? 'active' : '' }}"><a href="{{ route('categories.create') }}">Create</a></li>
    </ul>
</li>

<li class="{{ Request::is('membershipPlans/*') ? 'active' : '' }}">
    <a href="#"><i class="fa fa-inr"></i> <span class="nav-label">Plans</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="{{ Request::is('membershipPlans/all') || Request::is('membershipPlans/all/*') ? 'active' : '' }}"><a href="{{ route('membershipPlans.all') }}">All</a></li>
    </ul>
</li>