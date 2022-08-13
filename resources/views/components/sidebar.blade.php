<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/permissions*")||request()->is("admin/roles*")||request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('sale_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/sales*")||request()->is("admin/import/sales*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.sale.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.sales.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.sale.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('sale_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/import/sales*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.admin.import.sales") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        Import
                                    </a>
                                </li>
                            @endcan
                                @can('sale_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is("admin/sales/losses*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.admin.sales.losses") }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                            </i>
                                            Losses
                                        </a>
                                    </li>
                                @endcan
                                @can('sale_access')
                                    <li class="items-center">
                                        <a class="{{ request()->is("admin/sales/other*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.admin.sales.other") }}">
                                            <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                            </i>
                                            Other
                                        </a>
                                    </li>
                                @endcan

                        </ul>
                    </li>
                @endcan

                @can('raw_material_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/raw-materials*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.raw-materials.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.rawMaterial.title') }}
                        </a>
                    </li>
                @endcan
                @can('branch_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/branches*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.branches.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.branch.title') }}
                        </a>
                    </li>
                @endcan



                @can('unit_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/units*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.units.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.unit.title') }}
                        </a>
                    </li>
                @endcan
                @can('semi_finished_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/semi-finisheds*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.semi-finisheds.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.semiFinished.title') }}
                        </a>
                    </li>
                @endcan
                @can('labor_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/labors*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.labors.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.labor.title') }}
                        </a>
                    </li>
                @endcan
                @can('finished_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/finisheds*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.finisheds.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.finished.title') }}
                        </a>
                    </li>
                @endcan
                @can('fixed_asset_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/fixed-assets*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.fixed-assets.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.fixedAsset.title') }}
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="items-center">
                        <a class="{{ request()->is("admin/settings*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.settings.index") }}">
                            <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                            </i>
                            {{ trans('cruds.setting.title') }}
                        </a>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
