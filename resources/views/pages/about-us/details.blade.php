<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="about-us-page"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='About Us'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
{{--                <div class="row gx-4 mb-2">--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="avatar avatar-xl position-relative">--}}
{{--                            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="profile_image"--}}
{{--                                class="w-100 border-radius-lg shadow-sm">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto my-auto">--}}
{{--                        <div class="h-100">--}}
{{--                            <h5 class="mb-1">--}}
{{--                                {{ auth()->user()->name }}--}}
{{--                            </h5>--}}
{{--                            <p class="mb-0 font-weight-normal text-sm">--}}
{{--                                CEO / Co-Founder--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">--}}
{{--                        <div class="nav-wrapper position-relative end-0">--}}
{{--                            <ul class="nav nav-pills nav-fill p-1" role="tablist">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"--}}
{{--                                        role="tab" aria-selected="true">--}}
{{--                                        <i class="material-icons text-lg position-relative">home</i>--}}
{{--                                        <span class="ms-1">App</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"--}}
{{--                                        role="tab" aria-selected="false">--}}
{{--                                        <i class="material-icons text-lg position-relative">email</i>--}}
{{--                                        <span class="ms-1">Messages</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"--}}
{{--                                        role="tab" aria-selected="false">--}}
{{--                                        <i class="material-icons text-lg position-relative">settings</i>--}}
{{--                                        <span class="ms-1">Settings</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">About Us page Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if(session('updated'))
                            <div class="row">
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('updated') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('page-details.store') }}'>
                            @csrf
                            <input type="hidden" name="page_name" value="about-us"/>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea1">Our story</label>
                                    <textarea class="form-control border border-2 p-2"
                                              placeholder="Say something about our story" id="floatingTextarea1" name="page_details['our-story']"
                                              rows="4" cols="50"></textarea>
                                    @error('our-story')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Our Mission</label>
                                    <textarea class="form-control border border-2 p-2"
                                              placeholder="Say something about our mission" id="floatingTextarea2" name="page_details['our-mission']"
                                              rows="4" cols="50"></textarea>
                                    @error('our-story')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea3">Our Vision</label>
                                    <textarea class="form-control border border-2 p-2"
                                              placeholder="Say something about our vision" id="floatingTextarea3" name="page_details['our-vision']"
                                              rows="4" cols="50"></textarea>
                                    @error('our-vision')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <script>
            console.log("hello jquery!")

            let page_details = [];
            $.ajax({
                type: "GET",
                url: '/page-details/search',
                data: {
                    page_name: document.querySelector('form.input[name="page_name"]')
                },
                success: (res)=> {
                    page_details = res;
                    // res.forEach((page_details, idx) => {
                    //     console.log(idx)
                    //     console.log(page_details)
                    // })
                    let inputs = document.querySelectorAll('form input, form textarea')

                    console.log(res);
                    inputs.forEach((input_ele, idx)=> {
                        page_details.forEach(details => {
                            // console.log(input_ele.name, `page_details['${details.page_field}']`)
                            if (input_ele.name === `page_details['${details.page_field}']`){
                                console.log(input_ele.name)
                                input_ele.value = details.page_details
                            }
                        })

                    });
                }
            });


        </script>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
