<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu Principal</span>
                </li>

                {{-- Menu Tableau de Bord --}}
                <li class="submenu {{ set_active(['home', 'teacher/dashboard', 'student/dashboard']) }}">
                    <a href="#"><i class="feather-grid"></i>
                        <span> Tableau de bord </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{ set_active(['home']) }}">Tableau de bord </a>
                        </li>
                    </ul>
                </li>

                {{-- Menu Gestion d'Utilisateur --}}
                {{-- @if (in_array(Session::get('role_name'), ['Admin', 'Super Admin']))
                    <li
                        class="submenu {{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-shield-alt"></i>
                            <span>Gestion d'utilisateur</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a href="{{ route('list/users') }}"
                                    class="{{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">Liste
                                    des utilisateurs</a></li>
                        </ul>
                    </li>
                @endif --}}

                {{-- Menu Étudiant --}}
                <li
                    class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page']) }} {{ request()->is('student/edit/*') || request()->is('student/profile/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span> Étudiant</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('student/list') }}"
                                class="{{ set_active(['student/list', 'student/grid']) }}">Liste des étudiants</a></li>
                    </ul>
                </li>

                {{-- Menu Encadreur --}}
                <li
                    class="submenu {{ set_active(['teacher/add/page', 'teacher/list/page', 'teacher/grid/page', 'teacher/edit']) }} {{ request()->is('teacher/edit/*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                        <span> Encadreur</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('teacher/list/page') }}"
                                class="{{ set_active(['teacher/list/page', 'teacher/grid/page']) }}">Liste des
                                encadreurs</a></li>
                    </ul>
                </li>

                {{-- Menu Partenariats --}}
                <li class="submenu {{ set_active(['partenariats.list', 'partenariats.add', 'partenariats.edit']) }}">
                    <a href="#"><i class="fas fa-building"></i>
                        <span>Partenariats</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('partenariats.list') }}"
                                class="{{ set_active(['partenariats.list']) }}">Liste des partenariats</a></li>
                        {{-- <li><a href="{{ route('partenariats.add') }}" class="{{set_active(['partenariats.add'])}}">Ajouter un partenariat</a></li> --}}
                    </ul>
                </li>

                {{-- Menu Stages --}}
                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i>
                        <span> Stages</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('stage.list') }}">Liste des stages</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
