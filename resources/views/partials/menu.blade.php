<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                        @can('audit_log_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.auditLog.title') }}
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
        @endcan
        @can('menu_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/positions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.menuManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('position_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.positions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/positions") || request()->is("admin/positions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.position.title') }}
                            </a>
                        </li>
                    @endcan

                        @can('menu_access')
                            <li class="c-sidebar-nav-item">
                                <a href="{{ route("admin.menus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menus") || request()->is("admin/menus/*") ? "c-active" : "" }}">
                                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                    </i>
                                    {{ trans('cruds.menu.title') }}
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
        @endcan
        @can('article_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/article-categories*") ? "c-show" : "" }} {{ request()->is("admin/articles*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.articleManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('article_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.article-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/article-categories") || request()->is("admin/article-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.articleCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('article_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.articles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/articles") || request()->is("admin/articles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.article.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.settings.edit") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
            </li>
        @endcan
        @can('partner_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.partners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/partners") || request()->is("admin/partners/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.partner.title') }}
                </a>
            </li>
        @endcan
        @can('social_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.socials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/socials") || request()->is("admin/socials/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.social.title') }}
                </a>
            </li>
        @endcan
        @can('profile_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.profiles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin.profiles") || request()->is("admin.profiles/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.profile.title') }}
                </a>
            </li>
        @endcan

        @can('profile_edit')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("profile.my-profile.edit") }}" class="c-sidebar-nav-link {{ request()->is("profile/my-profile") || request()->is("profile/my-profile/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('global.my_profile') }}
                </a>
            </li>
        @endcan

        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        @can('country_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.country.title') }}
                </a>
            </li>
        @endcan
        @can('slider_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">
                    </i>
                    Sliders
                </a>
            </li>
        @endcan

        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
