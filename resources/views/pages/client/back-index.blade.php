<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="projects"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth
            titlePage="Projects"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        {{--                        <div class=" me-3 my-3 text-end">--}}
                        {{--                            <a class="btn bg-gradient-dark mb-0" href="{{url('/user-management/create')}}"><i--}}
                        {{--                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New--}}
                        {{--                                User</a>--}}
                        {{--                        </div>--}}
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">
                                    Project
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table table-striped align-items-center mb-0 p-3">
                                    <thead>
                                    <tr>
                                        @foreach($attributes as $attribute)
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{$attribute}}
                                        </th>
                                        @endforeach
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            @foreach($attributes as $attribute)
                                            <td>{{ ucfirst($project->$attribute) }}</td>
{{--                                            <td>${{ number_format($project->amount, 2) }}</td>--}}
                                            @endforeach
                                            <td>
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{route('projects.edit', $project->id) }}"
                                                   data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <form
                                                    action="{{route('projects.destroy', $project->id)}}"
                                                    method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-link"
                                                            onclick="return confirm('Are you sure you want to delete this entry?')"
                                                            data-original-title="" title="">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--                                {{ $projects->links() }}--}}
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
