<ul class="nav justify-content-center bg-white p-3 my-3 border">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('task.list') ? ' active fw-bold' : ' text-dark' }}"
            href="{{ route('task.list') }}">Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.list') ? ' active fw-bold' : ' text-dark' }}"
            href="{{ route('user.list') }}">User</a>
    </li>

</ul>
