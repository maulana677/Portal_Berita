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

            <li><a class="nav-link" href="{{ route('admin.kategori.index') }}"><i class="far fa-square"></i>
                    <span>Kategori</span></a></li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Berita</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.berita.index') }}">Semua Berita</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="{{ route('admin.social-count.index') }}"><i class="far fa-square"></i>
                    <span>Media Sosial</span></a></li>

            <li><a class="nav-link" href="{{ route('admin.home-section-setting.index') }}"><i class="far fa-square"></i>
                    <span>Pengaturan Rumah</span></a></li>

            <li><a class="nav-link" href="{{ route('admin.bahasa.index') }}"><i class="far fa-square"></i>
                    <span>Bahasa</span></a></li>
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
