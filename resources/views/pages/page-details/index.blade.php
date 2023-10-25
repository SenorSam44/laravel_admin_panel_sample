<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="page-history"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Page History"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">History</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Change</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Author</th>
{{--                                                <th--}}
{{--                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">--}}
{{--                                                    Function</th>--}}
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Time</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($page_history as $history)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        Page: {{$history->page_name}}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        Field: {{$history->page_field}}
                                                    </p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        Change: {{$history->page_details}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                                 class="avatar avatar-sm me-3 border-radius-lg"
                                                                 alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$history->name}}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{$history->email}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
{{--                                                <td class="align-middle text-center text-sm">--}}
{{--                                                    <span class="badge badge-sm bg-gradient-success">Online</span>--}}
{{--                                                </td>--}}
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs">
                                                        {{$history->updated_at->format('h:i:s a')}}
                                                    </span>
                                                    </br>
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{$history->updated_at->format('m-d-Y')}}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center ">
                                                    <a href="javascript:;"
                                                       class="text-secondary font-weight-bold text-xs"
                                                       data-toggle="tooltip" data-original-title="Edit user">
                                                        Show
                                                    </a>
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
