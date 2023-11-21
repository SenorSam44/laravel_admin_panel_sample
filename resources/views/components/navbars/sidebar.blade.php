@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">Ext4 Solutions Admin Panel</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'tables' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('tables') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'projects' ? 'active bg-gradient-primary' : '' }} toggle-sub-menu"
                   href="javascript:void(0);">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">psychology</i>
                    </div>
                    <span class="nav-link-text ms-1">Projects</span>
                </a>
                <ul class="sub-menu" style="{{ in_array($activePage, ['projects', 'create-project']) ? 'display: block;' : 'display: none;' }}">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'projects' ? 'active' : '' }}"
                           href="{{ route('projects.index') }}">
                            <span class="nav-link-text ms-1">All Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'create-project' ? 'active' : '' }}"
                           href="{{ route('projects.create') }}">
                            <span class="nav-link-text ms-1">Add Projects</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'clients' ? 'active bg-gradient-primary' : '' }} toggle-sub-menu"
                   href="javascript:void(0);">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">man</i>
                    </div>
                    <span class="nav-link-text ms-1">Clients</span>
                </a>
                <ul class="sub-menu" style="{{ in_array($activePage, ['clients', 'create-client']) ? 'display: block;' : 'display: none;' }}">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'clients' ? 'active' : '' }}"
                           href="{{ route('clients.index') }}">
                            <span class="nav-link-text ms-1">All Clients</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'create-client' ? 'active' : '' }}"
                           href="{{ route('clients.create') }}">
                            <span class="nav-link-text ms-1">Add Clients</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'invoices' ? 'active bg-gradient-primary' : '' }} toggle-sub-menu"
                   href="javascript:void(0);">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Invoice</span>
                </a>
                <ul class="sub-menu" style="{{ in_array($activePage, ['invoices', 'create-invoice']) ? 'display: block;' : 'display: none;' }}">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'invoices' ? 'active' : '' }}"
                           href="{{ route('invoices.index') }}">
                            <span class="nav-link-text ms-1">Invoice List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'create-invoice' ? 'active' : '' }}"
                           href="{{ route('invoices.create') }}">
                            <span class="nav-link-text ms-1">Create Invoice</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'expenses' ? 'active bg-gradient-primary' : '' }} toggle-sub-menu"
                   href="javascript:void(0);">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Expenses</span>
                </a>
                <ul class="sub-menu" style="{{ in_array($activePage, ['expenses', 'create-expense']) ? 'display: block;' : 'display: none;' }}">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'expenses' ? 'active' : '' }}"
                           href="{{ route('expenses.index') }}">
                            <span class="nav-link-text ms-1">Expenses List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'create-expense' ? 'active' : '' }}"
                           href="{{ route('expenses.create') }}">
                            <span class="nav-link-text ms-1">Add Expense</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'incomes' ? 'active bg-gradient-primary' : '' }} toggle-sub-menu"
                   href="javascript:void(0);">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Income</span>
                </a>
                <ul class="sub-menu" style="{{ in_array($activePage, ['incomes', 'create-income']) ? 'display: block;' : 'display: none;' }}">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'incomes' ? 'active' : '' }}"
                           href="{{ route('income.index') }}">
                            <span class="nav-link-text ms-1">Income List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ $activePage == 'create-income' ? 'active' : '' }}"
                           href="{{ route('income.create') }}">
                            <span class="nav-link-text ms-1">Add Income</span>
                        </a>
                    </li>
                </ul>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link text-white {{ $activePage == 'billing' ? ' active bg-gradient-primary' : '' }}  "--}}
{{--                    href="{{ route('billing') }}">--}}
{{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="material-icons opacity-10">receipt_long</i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Billing</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link text-white {{ $activePage == 'virtual-reality' ? ' active bg-gradient-primary' : '' }}  "--}}
{{--                    href="{{ route('virtual-reality') }}">--}}
{{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="material-icons opacity-10">view_in_ar</i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Virtual Reality</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link text-white {{ $activePage == 'notifications' ? ' active bg-gradient-primary' : '' }}  "--}}
{{--                    href="{{ route('notifications') }}">--}}
{{--                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">--}}
{{--                        <i class="material-icons opacity-10">notifications</i>--}}
{{--                    </div>--}}
{{--                    <span class="nav-link-text ms-1">Notifications</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link text-white ps-2 {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
                   href="{{ route('user-management.index') }}">
                    <div class="text-white text-center d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Page details</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'about-us-page' ? ' active bg-gradient-primary' : '' }} "
                   href="{{ route('about-us-page.details') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">A</i>
                    </div>
                    <span class="nav-link-text ms-1">About Us</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'page-history' ? ' active bg-gradient-primary' : '' }} "
                   href="{{ route('page-details.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">history</i>
                    </div>
                    <span class="nav-link-text ms-1">History</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rtl' ? ' active bg-gradient-primary' : '' }}  "
                   href="{{ route('rtl') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('static-sign-in') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="{{ route('static-sign-up') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gradient-primary' : '' }} "
                   href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>
        </ul>
    </div>
    <script>
        $(document).ready(function() {
            $('.toggle-sub-menu').on('click', function() {
                // Toggle the display of the sub-menu
                $(this).next('.sub-menu').slideToggle('fast');
            });
        });
    </script>

</aside>
