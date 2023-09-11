<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/iposta/logo2.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/iposta/logo2.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/iposta/logo2.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/iposta/logo2.png') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>



    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                @include('components.admin.ericSidebar')

                 {{-- @can('allBranches Poboxes')
                 <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">P.O Box Management</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['admin.physicalPob.index','admin.virtualPob.index']) ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-database-line"></i> <span data-key="t-layouts">P.O Box</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.physicalPob.index','admin.virtualPob.index']) ? 'show' : '' }}" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.physicalPob.index') }}" class="nav-link {{ Request::routeIs('admin.physicalPob.index') ? 'active' : '' }}" data-key="t-poboxlist">Physical P.O Box</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.virtualPob.index') }}" class="nav-link {{ Request::routeIs('admin.virtualPob.index') ? 'active' : '' }}" data-key="t-poboxSelling">Virtual P.O Box</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan --}}

    <!-- =============================  Branch Manager Activities =============================================================== -->





         <!-- ============================= End Branch Manager Activities =============================================================== -->



        <!-- ============================= Start Driver Sidebar =============================================================== -->
                @can('read driver')

                <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.vehicle.Vehicles','driver.index','driver.withVehicle','driver.withoutVehicle','driver.history']) ? 'active' : '' }}">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-truck-line"></i> <span data-key="t-pages">Vehicle Management</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.vehicle.Vehicles','driver.index','driver.withVehicle','driver.withoutVehicle','driver.history']) ? 'show' : '' }}" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.vehicle.Vehicles') }}" class="nav-link {{ Request::routeIs('admin.vehicle.Vehicles') ? 'active' : '' }}" data-key="t-starter">Vehicle Registration</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('admin.vehicle.Assign') }}" class="nav-link" data-key="t-starter">Assign Management</a>
                            </li> --}}

                            <li class="nav-item {{ in_array(Route::currentRouteName(),  ['driver.index','driver.withVehicle','driver.withoutVehicle']) ? 'active' : '' }}">
                                <a href="#employees" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="employees" data-key="t-candidate-lists">
                                    Drivers
                                </a>
                                <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['driver.index','driver.withVehicle','driver.withoutVehicle']) ? 'show' : '' }}" id="employees">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('driver.index') }}" class="nav-link {{ Request::routeIs('driver.index') ? 'active' : '' }}" data-key="t-all">All Drivers
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('driver.withVehicle') }}" class="nav-link {{ Request::routeIs('driver.withVehicle') ? 'active' : '' }}" data-key="t-active">With Vehicle
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('driver.withoutVehicle') }}" class="nav-link {{ Request::routeIs('driver.withoutVehicle') ? 'active' : '' }}" data-key="t-inactive"> Without Vehicle
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('driver.history') }}" class="nav-link {{ Request::routeIs('driver.history') ? 'active' : '' }}" data-key="t-starter">Vehicle History</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['driver.nationalMails.index', 'driver.nationalMails.received','driver.nationalMails.sentMail','driver.nationalMails.details','driver.nationalMails.sentMailDetail','driver.nationalMails.assigned']) ? 'active' : '' }}" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bx bx-cart fs-22"></i> <span data-key="t-pages">EMS National</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['driver.nationalMails.index', 'driver.nationalMails.received','driver.nationalMails.sentMail','driver.nationalMails.details','driver.nationalMails.sentMailDetail','driver.nationalMails.assigned']) ? 'show' : '' }}" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="#Dispatch" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Dispatch" data-key="t-candidate-lists">
                                    Dispatch Requests
                                </a>
                                <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['driver.nationalMails.index', 'driver.nationalMails.assigned']) ? 'show' : '' }}" id="Dispatch">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{ route('driver.nationalMails.index') }}" class="nav-link {{ Request::routeIs('driver.nationalMails.index') ? 'active' : '' }}" data-key="t-all"> All Requests
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('driver.nationalMails.assigned') }}" class="nav-link {{ Request::routeIs('driver.nationalMails.assigned') ? 'active' : '' }}" data-key="t-requested">Requests Assigned
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.nationalMails.received') }}" class="nav-link {{ Request::routeIs('driver.nationalMails.received') ? 'active' : '' }}" data-key="t-timeline"> Received Mails </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.nationalMails.sentMail') }}" class="nav-link {{ Request::routeIs('driver.nationalMails.sentMail') ? 'active' : '' }}" data-key="t-sent">Mails Sent</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['driver.homeDelivery.index','driver.homeDelivery.transit','driver.homeDelivery.delivered']) ? 'active' : '' }}" href="#homeDriver" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="homeDriver">
                        <i class="ri-e-bike-2-fill"></i> <span data-key="t-pages">Home Delivery</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['driver.homeDelivery.index','driver.homeDelivery.transit','driver.homeDelivery.delivered']) ? 'show' : '' }}" id="homeDriver">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('driver.homeDelivery.index') }}" class="nav-link {{ Request::routeIs('driver.homeDelivery.index') ? 'active' : '' }}" data-key="t-timeline">New Requests </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.homeDelivery.transit') }}" class="nav-link {{ Request::routeIs('driver.homeDelivery.transit') ? 'active' : '' }}" data-key="t-timeline">In Transit </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('driver.homeDelivery.delivered') }}" class="nav-link {{ Request::routeIs('driver.homeDelivery.delivered') ? 'active' : '' }}" data-key="t-timeline"> Delivered </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endcan
           <!-- ============================= End Driver Sidebar =============================================================== -->



           <!-- ============================= EMS National user Sidebar =============================================================== -->

                @can('send dispatch')
                <li class="nav-item">
                    <a class="nav-link menu-link " href="#dispatch" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="dispatch">
                        <i class="ri-mail-send-line"></i> <span
                            data-key="t-dispatch">National Dispatch</span>
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.sendDispatch.index', 'admin.sendDispatch.viewDispatch','admin.sendDispatch.sentDispatch','admin.sendDispatch.show','admin.sendDispatch.recievedDispatch']) ? 'show' : '' }}" id="dispatch">
                        <ul class="nav nav-sm flex-column">
                           {{-- create dispatch --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.sendDispatch.index',1) }}" class="nav-link {{ Request::routeIs('admin.sendDispatch.index') ? 'active' : '' }}" data-key="t-request"> Create Dispatch </a>
                            </li>
                            {{-- view dispatch --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.sendDispatch.viewDispatch') }}" class="nav-link {{ Request::routeIs('admin.sendDispatch.viewDispatch') ? 'active' : '' }}" data-key="t-timeline"> View Dispatch </a>
                            </li>
                            {{-- Sent dispatch --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.sendDispatch.sentDispatch') }}" class="nav-link {{ Request::routeIs('admin.sendDispatch.sentDispatch') ? 'active' : '' }}" data-key="t-timeline"> Sent Dispatch </a>
                            </li>
                            {{-- received dispatch --}}
                            <li class="nav-item">
                                <a href="{{ route('admin.sendDispatch.recievedDispatch') }}" class="nav-link {{ Request::routeIs('admin.sendDispatch.recievedDispatch') ? 'active' : '' }}" data-key="t-timeline"> Received Dispatch </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['admin.dispatchInvoice.index','admin.dispatchInvoice.show']) ? 'active' : '' }}" href="{{ route('admin.dispatchInvoice.index') }}" role="button">
                        <i class="ri-pages-line"></i> <span data-key="t-pages">Invoice</span>
                    </a>
                </li>
                @endcan

            <!-- ============================= END EMS National user Sidebar =============================================================== -->

        @can('read roles', 'read permissions', 'read employee', 'read setting')
        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Users Management</span></li>
        <li class="nav-item">
            <a class="nav-link menu-link" href="#permission" data-bs-toggle="collapse" role="button"
                aria-expanded="false" aria-controls="permission">
                <i class="ri-settings-5-line"></i> <span data-key="t-landing">Users</span>
            </a>
            <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.employee.index','admin.employee.active','admin.employee.inactive','admin.setting.index','admin.roles.index','admin.permissions.index','admin.employee.deactivate']) ? 'show' : '' }}" id="permission">
                <ul class="nav nav-sm flex-column">

                    @can('read employee')
                    <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.employee.index','admin.employee.active','admin.employee.inactive','admin.employee.deactivate']) ? 'active' : '' }}">
                        <a href="#employees" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="employees" data-key="t-candidate-lists">
                            Employees
                        </a>
                        <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.employee.index','admin.employee.active','admin.employee.inactive','admin.employee.deactivate']) ? 'show' : '' }}" id="employees">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.index') }}" class="nav-link {{ Request::routeIs('admin.employee.index') ? 'active' : '' }}" data-key="t-all">All Employees
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.active') }}" class="nav-link {{ Request::routeIs('admin.employee.active') ? 'active' : '' }}" data-key="t-active">Active Employees
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.inactive') }}" class="nav-link {{ Request::routeIs('admin.employee.inactive') ? 'active' : '' }}" data-key="t-inactive"> Inactive Employees
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.deactivate') }}" class="nav-link {{ Request::routeIs('admin.employee.deactivate') ? 'active' : '' }}" data-key="t-deactiveted"> Deactivated Employees
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('read roles', 'read permissions')
                    <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin.roles.index','admin.permissions.index']) ? 'show' : '' }}">
                        <a href="#roles" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="roles" data-key="t-candidate-lists">
                            Roles & Permissions
                        </a>
                        <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['admin.roles.index','admin.permissions.index']) ? 'show' : '' }}" id="roles">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::routeIs('admin.roles.index') ? 'active' : '' }}" data-key="t-all">Roles
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}" data-key="t-active">Permissions
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endcan
                    @can('read setting')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ Request::routeIs('admin.setting.index') ? 'active' : '' }}" href="{{ route('admin.setting.index') }}">
                                <span data-key="t-base-hu">System Sitting</span>
                        </a>

                    </li>
                    @endcan


                </ul>
            </div>
        </li>
        @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
