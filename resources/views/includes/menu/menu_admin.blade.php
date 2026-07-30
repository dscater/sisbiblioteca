<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Usuarios</p>
    </a>
</li>

{{-- menu-is-opening menu-open --}}
<li class="nav-item @if (request()->is('libros*') ||
        request()->is('ubicacions*') ||
        request()->is('areas*') ||
        request()->is('autors*') ||
        request()->is('edicions*') ||
        request()->is('volumens*') ||
        request()->is('lugars*') ||
        request()->is('editorials*')) menu-is-opening menu-open active @endif">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-list-alt"></i>
        <p>Libros <i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('libros.index') }}" class="nav-link @if (request()->is('libros*') || request()->is('foto_libros*')) active @endif">
                <i class="nav-icon far fa-circle"></i>
                <p>Libros</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('ubicacions.index') }}"
                class="nav-link {{ request()->is('ubicacions*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Ubicaciones</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('areas.index') }}" class="nav-link {{ request()->is('areas*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Áreas</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('autors.index') }}" class="nav-link {{ request()->is('autors*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Autores</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('edicions.index') }}" class="nav-link {{ request()->is('edicions*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Ediciones</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('volumens.index') }}" class="nav-link {{ request()->is('volumens*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Volumenes</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('lugars.index') }}" class="nav-link {{ request()->is('lugars*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Lugares</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('editorials.index') }}"
                class="nav-link {{ request()->is('editorials*') ? 'active' : '' }}">
                <i class="nav-icon far fa-circle"></i>
                <p>Editoriales</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{{ route('prestamos.index') }}" class="nav-link {{ request()->is('prestamos*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>Préstamos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('prestamos.index') }}" class="nav-link {{ request()->is('prestamos*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-bell"></i>
        <p>Notificaciones</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('solicituds.index') }}" class="nav-link {{ request()->is('solicituds*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>Solicitudes Préstamos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('lectors.index') }}" class="nav-link {{ request()->is('lectors*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-users"></i>
        <p>Lectores</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('razon_social.index') }}" class="nav-link {{ request()->is('razon_social*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-hospital"></i>
        <p>Razón social</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('carrusels.index') }}" class="nav-link {{ request()->is('carrusels*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-images"></i>
        <p>Imágines Portal</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reportes</p>
    </a>
</li>
