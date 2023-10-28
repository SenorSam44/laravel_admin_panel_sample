<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="clients"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth
            titlePage="Clients"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 mt-4">
{{--                    <div class="mb-5 ps-3">--}}
{{--                        <h6 class="mb-1">Clients</h6>--}}
{{--                        <p class="text-sm">Architects design houses</p>--}}
{{--                    </div>--}}
                    <div class="row">
                        @foreach($clients as $client)
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 mt-n4 mx-3">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="{{ asset('assets') }}/img/home-decor-1.jpg"
                                             alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">{{$client->title}}</p>
                                    <a href="javascript:;">
                                        <h5>
                                            {{$client->category}}
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        {{$client->description}}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{route('clients.show', $client->id)}}" type="button" class="btn btn-outline-primary btn-sm mb-0">
                                            View Client
                                        </a>
                                        <div class="avatar-group mt-2">
{{--                                            @foreach($team_members as $member)--}}
{{--                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle"--}}
{{--                                               data-bs-toggle="tooltip" data-bs-placement="bottom"--}}
{{--                                               title="{{$member->name}}">--}}
{{--                                                <img alt="Image placeholder"--}}
{{--                                                     src="{{ asset('assets') }}/img/team-1.jpg">--}}
{{--                                            </a>--}}
{{--                                            @endforeach--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
