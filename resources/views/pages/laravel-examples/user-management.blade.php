<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
{{--                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">--}}
{{--                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">--}}
{{--                                <h6 class="text-white mx-3"><strong> Add, Edit, Delete features are not--}}
{{--                                        functional!</strong> This is a<strong> PRO</strong> feature! Click--}}
{{--                                    <strong><a--}}
{{--                                            href="https://www.creative-tim.com/product/material-dashboard-pro-laravel"--}}
{{--                                            target="_blank" class="text-white"><u>here</u> </a></strong>to see--}}
{{--                                    the PRO product!</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{url('/user-management/create')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                User</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PHOTO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NAME</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ROLE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                POSITION
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Models\User::all() as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{$user->id}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team/{{$user->name}}.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$user->name}}</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">{{$user->email}}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if(!$user->role)
                                                        Super admin
                                                    @elseif($user->role==1)
                                                        Management
                                                    @elseif($user->role ==2)
                                                        Team
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{$user->position}}</span>
                                            </td>
                                            <td class="align-middle">
                                                @if($user->role>=auth()->user()->role)
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{route('user-management.edit', [$user->id])}}"
                                                   data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-link"
                                                        data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
