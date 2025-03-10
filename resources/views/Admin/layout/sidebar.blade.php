<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('Admin.Dashboard') }}" class="{{ in_array(Route::currentRouteName(), ['Admin.Dashboard']) ? 'active' : '' }}">
                        <i class="fas fa-home"  style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <!-- Manage Users Route -->
                 <li class="{{ in_array(Route::currentRouteName(), ['Admin.ManageUsers','Admin.DetailPage']) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-users" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.ManageUsers','']) ? 'active' : '' }}"><a href="{{ route('Admin.ManageUsers') }}" data-key="t-alerts" aria-expanded="false"><span>User List</span></a></li>
                        {{-- <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Gallery.view-Thumbnail',]) ? 'active' : '' }}"><a href="{{ route('Admin.Manage-Gallery.view-Thumbnail') }}" data-key="t-alerts" aria-expanded="false"><span>View Gallery</span></a></li> --}}
                    </ul>
                </li>
                <!-- Manage Events Route -->
                 <li class="{{ in_array(Route::currentRouteName(), ['Admin.eventPage','Admin.EventCompletedPage','Admin.UpdateEventsPage','Admin.EventListPage','Admin.EventDetailsPage']) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-image" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.eventPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.eventPage') }}" data-key="t-alerts" aria-expanded="false"><span>Create Events</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.EventListPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.EventListPage') }}" data-key="t-alerts" aria-expanded="false"><span>Event List</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.EventCompletedPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.EventCompletedPage') }}" data-key="t-alerts" aria-expanded="false"><span>Completed Events</span></a></li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['Admin.TicketsListPage','Admin.TicketPage']) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-image" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Tickets</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.TicketsListPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.TicketsListPage') }}" data-key="t-alerts" aria-expanded="false"><span>Manage Tickets</span></a></li>
                        {{-- <li class="{{ in_array(Route::currentRouteName(), ['Admin.EventListPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.EventListPage') }}" data-key="t-alerts" aria-expanded="false"><span>Event List</span></a></li> --}}
                    </ul>
                </li>
{{--
                <!-- Manage Audio Route  -->
                <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Audio.View-Audio',]) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-headphones-alt" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Manage Audio</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Audio.Page',]) ? 'active' : '' }}"><a href="{{ route('Admin.Manage-Audio.Page') }}" data-key="t-alerts" aria-expanded="false"><span>Add Audio</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Audio.GroupPage',]) ? 'active' : '' }}"><a href="{{ route('Admin.Manage-Audio.GroupPage') }}" data-key="t-alerts" aria-expanded="false"><span>View Audio</span></a></li>
                    </ul>
                </li>

                
                <!-- Manage Document Route  -->
                <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Document.View-Document',]) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-folder" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Manage Document</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Document.Page',]) ? 'active' : '' }}"><a href="{{ route('Admin.Manage-Document.Page') }}" data-key="t-alerts" aria-expanded="false"><span>Add Document</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Manage-Document.Document',]) ? 'active' : '' }}"><a href="{{ route('Admin.Manage-Document.GroupPage') }}" data-key="t-alerts" aria-expanded="false"><span>View Document</span></a></li>
                    </ul>
                </li>


                <!-- Manage Staff Route  -->
                <li class="{{ in_array(Route::currentRouteName(), ['Admin.Add-Staff.Page', 'Admin.UnassignStaff-List.Page','Admin.StaffUpdate.Page' ,'Admin.StaffDetails.Page']) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-users" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Manage Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Add-Staff.Page',]) ? 'active' : '' }}"><a href="{{ route('Admin.Add-Staff.Page') }}" data-key="t-alerts" aria-expanded="false"><span>Add Staff</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.Staff-List.Page','Admin.UnassignStaff-List.Page',]) ? 'active' : '' }}"><a href="{{ route('Admin.Staff-List.Page') }}" data-key="t-alerts" aria-expanded="false"><span>Staff List</span></a></li>
                    </ul>
                </li>

                <li class="{{ in_array(Route::currentRouteName(), ['Admin.InfoPage','Admin.EditPage','Admin.CustomPageSelect']) ? 'mm-active' : '' }}">
                    <a href=" javascript: void(0);" class="has-arrow">
                        <i class="fas fa-globe"style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-authentication">Manage Pages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.InfoPage']) ? 'active' : '' }}"><a href="{{ route('Admin.InfoPage') }}" data-key="t-alerts" aria-expanded="false"><span>Add Page</span></a></li>
                        <li class="{{ in_array(Route::currentRouteName(), ['Admin.listPage']) ? 'active' : '' }}"><a href="{{ route('Admin.listPage') }}" data-key="t-alerts" aria-expanded="false"><span>Manage Page</span></a></li>
                    </ul>
                </li>



                <li class="menu-title mt-2" data-key="t-components">Master Pages</li>
                <li>
                    <a href="{{ route('Admin.DepartmentPage') }}" class="{{ in_array(Route::currentRouteName(), ['Admin.DepartmentPage']) ? 'active' : '' }}">
                        <i class="fas fa-suitcase" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-briefcase">Manage Department</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Admin.DesignationPage') }}" class="{{ in_array(Route::currentRouteName(), ['Admin.DesignationPage']) ? 'active' : '' }}">
                        <i class="fas fa-briefcase" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-user-plus">Manage Designation</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Admin.MenuMasterPage') }}" class="{{ in_array(Route::currentRouteName(), ['Admin.MenuMasterPage', 'Admin.GenerateMenuPage','Admin.UpdateMenuPage']) ? 'active' : '' }}">
                        <i class="fas fa-bars" style="color: #545a6d;font-size: 0.99rem;"></i>
                        <span data-key="t-user-plus">Menu Master</span>
                    </a>
                </li> --}}



            </ul>


        </div>
        <!-- Sidebar -->
    </div>  
</div>