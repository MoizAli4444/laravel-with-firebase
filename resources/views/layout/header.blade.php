<ul class="nav justify-content-center bg-white p-3 my-3 border">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('task.index') ? ' active fw-bold' : ' text-dark' }}"
            href="{{ route('task.index') }}">Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.index') ? ' active fw-bold' : ' text-dark' }}"
            href="{{ route('user.index') }}">User</a>
    </li>

</ul>
