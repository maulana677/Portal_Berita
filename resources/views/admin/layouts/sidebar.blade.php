<div class="navbar-bg"></div>

{{--  navbar start  --}}
@include('admin.layouts.navbar')
{{--  navbar end  --}}

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="{{ setSidebarActive(['admin.category.*']) }}">
                <a class="nav-link" href="{{ route('admin.category.index') }}"><i class="far fa-square"></i>
                    <span>Category</span>
                </a>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.berita.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>News</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.berita.*']) }}">
                        <a class="nav-link" href="{{ route('admin.berita.index') }}">All News</a>
                    </li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setSidebarActive(['admin.about.*', 'admin.contact.*']) }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Pages</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.about.*']) }}">
                        <a class="nav-link" href="{{ route('admin.about.index') }}">About Page</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.contact.*']) }}">
                        <a class="nav-link" href="{{ route('admin.contact.index') }}">Contact Page</a>
                    </li>
                </ul>
            </li>

            <li class="{{ setSidebarActive(['admin.social-count.*']) }}">
                <a class="nav-link" href="{{ route('admin.social-count.index') }}"><i class="far fa-square"></i>
                    <span>Social Count</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.contact-message.*']) }}">
                <a class="nav-link" href="{{ route('admin.contact-message.index') }}"><i class="far fa-square"></i>
                    <span>Contact Messages</span>
                    @if ($unReadMessages > 0)
                        <i class="badge bg-danger" style="color:#fff">{{ $unReadMessages }}</i>
                    @endif
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.home-section-setting.*']) }}">
                <a class="nav-link" href="{{ route('admin.home-section-setting.index') }}"><i
                        class="far fa-square"></i>
                    <span>Home Section Setting</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.ad.*']) }}">
                <a class="nav-link" href="{{ route('admin.ad.index') }}"><i class="far fa-square"></i>
                    <span>Advertisement</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.bahasa.*']) }}">
                <a class="nav-link" href="{{ route('admin.bahasa.index') }}"><i class="far fa-square"></i>
                    <span>Languages</span>
                </a>
            </li>

            <li class="{{ setSidebarActive(['admin.subscribers.*']) }}">
                <a class="nav-link" href="{{ route('admin.subscribers.index') }}"><i class="far fa-square"></i>
                    <span>Subscribers</span>
                </a>
            </li>

            <li
                class="dropdown {{ setSidebarActive([
                    'admin.social-link.*',
                    'admin.footer-info.*',
                    'admin.footer-grid-one.*',
                    'admin.footer-grid-two.*',
                    'admin.footer-grid-three.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Footer Setting</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.social-link.*']) }}">
                        <a class="nav-link" href="{{ route('admin.social-link.index') }}">Social Links</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-info.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Info</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-one.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-one.index') }}">Footer Grid One</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-two.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a>
                    </li>
                    <li class="{{ setSidebarActive(['admin.footer-grid-three.*']) }}">
                        <a class="nav-link" href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a>
                    </li>
                </ul>
            </li>
            {{--  <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>  --}}

            {{--  <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li>  --}}
        </ul>
    </aside>
</div>
