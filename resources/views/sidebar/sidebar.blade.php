<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Menu Principal</span>
                </li>

                {{-- Menu Tableau de Bord --}}
                <li class="submenu {{ set_active(['home', 'dashboard']) }}">
                    <a href="#"><i class="feather-grid"></i>
                        <span> Tableau de bord </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home') }}" class="{{ set_active(['home']) }}">Tableau de bord </a>
                        </li>
                    </ul>
                </li>

                {{-- Menu Étudiant --}}
                <li
                    class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page', 'student/edit/*', 'student/profile/*']) }}">
                    <a href="#"><i class="fas fa-graduation-cap"></i>
                        <span> Étudiant</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('student/list') }}"
                                class="{{ set_active(['student/list', 'student/grid']) }}">Liste des étudiants</a></li>
                        <li><a href="{{ route('student/add/page') }}"
                                class="{{ set_active(['student/add/page']) }}">Ajouter un étudiant</a></li>
                    </ul>
                </li>

                {{-- Menu Encadreur --}}
                <li
                    class="submenu {{ set_active(['teacher/add/page', 'teacher/list/page', 'teacher/grid/page', 'teacher/edit']) }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                        <span> Encadreur</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('teacher/list/page') }}"
                                class="{{ set_active(['teacher/list/page', 'teacher/grid/page']) }}">Liste des
                                encadreurs</a></li>
                        <li><a href="{{ route('teacher/add/page') }}"
                                class="{{ set_active(['teacher/add/page']) }}">Ajouter un encadreur</a></li>
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
                        <li><a href="{{ route('partenariats.add') }}"
                                class="{{ set_active(['partenariats.add']) }}">Ajouter un partenariat</a></li>
                    </ul>
                </li>

                {{-- Menu Stages --}}
                <li class="submenu {{ set_active(['stage.list', 'stage.grid', 'stage/add', 'stage/edit/*']) }}">
                    <a href="#"><i class="fas fa-book-reader"></i>
                        <span> Stages</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('stage.list') }}"
                                class="{{ set_active(['stage.list', 'stage.grid']) }}">Liste des stages</a></li>
                        <li><a href="{{ route('stage.add') }}" class="{{ set_active(['stage.add']) }}">Ajouter un
                                stage</a></li>
                    </ul>
                </li>
                {{-- Menu Départements --}}
                <li class="submenu {{ set_active(['departments.list', 'departments.add', 'departments.edit']) }}">
                    <a href="#"><i class="fas fa-building"></i>
                        <span>Départements</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('departments.list') }}"
                                class="{{ set_active(['departments.list']) }}">Liste des départements</a></li>
                        <li><a href="{{ route('departments.add') }}"
                                class="{{ set_active(['departments.add']) }}">Ajouter un département</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
