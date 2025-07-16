<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link{{ request()->is('/') ? ' active' : '' }}" href="/">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('even') ? ' active' : '' }}" href="/even">Even Numbers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('prime') ? ' active' : '' }}" href="/prime">Prime Numbers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('multable') ? ' active' : '' }}" href="/multable">Multiplication Table</a>
    </li>
</ul>
