<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="index.html">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('category.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#test-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Test</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="test-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('test.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('test.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#grouptest-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Group Test</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="grouptest-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('grouptest.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('grouptest.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Organs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('organ.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('organ.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#labpackage-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Lab Package</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="labpackage-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('labpackage.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('labpackage.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#labs-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Labs</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="labs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('lab.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('lab.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#package-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Package</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="package-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('package.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('package.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#testbyorgan-nav" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-journal-text"></i><span>TestByOrgan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="testbyorgan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admintestbyorgan.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admintestbyorgan.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#order-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="order-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('order.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('prescription.all') }}">
                        <i class="bi bi-circle"></i><span>Prescription</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#slider-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Sliders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="slider-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('slider.index') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('slider.create') }}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#appointemnt-nav" data-bs-toggle="collapse"
                href="#">
                <i class="bi bi-journal-text"></i><span>Appointment</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="appointemnt-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('allppointment') }}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#coupon-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Coupon</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="coupon-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('coupon.create')}}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('coupon.index')}}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                    <a href="{{route('user.index')}}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#cashback-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Cashbacks</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cashback-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                    <a href="{{route('cashback.index')}}">
                        <i class="bi bi-circle"></i><span>All</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

    
    </ul>
</aside><!-- End Sidebar-->
