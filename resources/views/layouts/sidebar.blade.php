<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-danger bg-gradient">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

            @hasrole('Registrar Administration')
            <li>
                <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="bi bi-people"></i><span class="ms-1 d-none d-sm-inline">Staff</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                    <li>
                        <a href="/admin/departments" class="nav-link px-3">
                            <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> Departments</span>
                        </a>
                    </li>
                    <li>
                                <a href="/management_categories" class="nav-link px-3">
                                    <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i>Management</span>
                                </a>
                    </li>
                    <li>
                        <a href="{{route('job_titles.index')}}" class="nav-link px-3">
                            <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> Job Titles</span>
                        </a>
                    </li>
                </ul>

            </li>
            @endhasrole()

            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Leave</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">

                    <li>
                        <a href="{{route('leave_application.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> My Leave</span></a>
                    </li>
                    <li>
                        <a href="{{route('assigned_duties.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> Assigned Duties</span></a>
                    </li>
                    <li>
                        <a href="{{route('leave_recommendation.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> Recommendation</span></a>
                    </li>
               @hasrole('Registrar Administration')
                    <li class="w-100">
                        <a href="{{route('holidays.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i>Pubic Holidays</span> </a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('leaveCategory.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i>Leave Category </span> </a>
                    </li>
                    <li>
                        <a href="{{route('leave_approvals.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i> Leave Approvals</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('leave_allocation.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i>Leave Allocation </span> </a>
                    </li>
                    <li class="w-100">
                        <a href="{{route('leave_reports.index')}}" class="nav-link px-3"> <span class="d-none text-white d-sm-inline"><i class="bi bi-caret-right"></i>Leave Reports </span> </a>
                    </li>
                @endhasrole()
                </ul>
            </li>
            @role('Admin')
            <li>
                <a href="{{route('users.index')}}" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-person-gear"></i> <span class="ms-1 d-none  d-sm-inline">Users</span></a>
            </li>
            <li>
                <a href="{{route('roles.index')}}" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-person-gear"></i> <span class="ms-1 d-none  d-sm-inline">Roles</span></a>
            </li>
            <li>
                <a href="{{route('permissions.index')}}" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-person-gear"></i> <span class="ms-1 d-none  d-sm-inline">Permissions</span></a>
            </li>
            <li>
                <a href="{{route('sitewide-notification')}}" class="nav-link px-0 align-middle text-white">
                    <i class="fs-4 bi-bell"></i> <span class="ms-1 d-none  d-sm-inline">Site Wide Notifications</span></a>
            </li>
            @endrole()
        </ul>
        <hr>

    </div>
</div>
