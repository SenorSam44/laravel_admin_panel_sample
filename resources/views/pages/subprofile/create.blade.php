<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <div id="image-container">
                                <img src="{{ asset('assets') }}/img/bruce-mars.jpg" id="image-preview"
                                     class="w-100 border-radius-lg shadow-sm" alt="Image">
                                <input type="file" id="image-upload" style="display: none">
                            </div>
                        </div>
                    </div>
                    @if(isset($user))

                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ $user->name }}
                                </h5>
                                <p class="mb-0 font-weight-normal text-sm">
                                    {{ $user->position }}
                                </p>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-selected="true">
                                        <i class="material-icons text-lg position-relative">home</i>
                                        <span class="ms-1">App</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-selected="false">
                                        <i class="material-icons text-lg position-relative">email</i>
                                        <span class="ms-1">Messages</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-selected="false">
                                        <i class="material-icons text-lg position-relative">settings</i>
                                        <span class="ms-1">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Profile Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                            <div class="row">
                                <div
                                    class="alert {{ Session::has('success') && Session::get('success')? 'alert-success': 'alert-danger'}} alert-dismissible text-white"
                                    role="alert">
                                    <span class="text-sm">{{ Session::get('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('demo'))
                            <div class="row">
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('demo') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <form method='POST' action='{{ route('user-management.store') }}'>
                            @csrf
                            <input type="hidden" name="id" value="{{isset($user)? $user->id: 'new'}}">
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2"
                                           value='{{ old('email', isset($user->email) ? $user->email: null) }}'>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                           value='{{ old('name', isset($user->name)? $user->name: null) }}'>
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control border border-2 p-2"
                                           value='{{ old('password', isset($user->password) ? $user->password : null) }}'>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control border border-2 p-2"
                                           value='{{ old('password', isset($user->password)? $user->password : null ) }}'>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" name="phone" class="form-control border border-2 p-2"
                                           value='{{ old('phone', isset($user->phone)? $user->phone : null) }}'>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Role</label>
                                    <select class="form-control border border-2 p-2" name="role">
                                        @if(auth()->user()->role<=0 )
                                            <option @if( isset($user->role) && $user->role==0) selected
                                                    @endif value="0">
                                                Super Admin
                                            </option>
                                        @endif
                                        @if(auth()->user()->role <=1)
                                            <option @if( isset($user->role) && $user->role==1) selected
                                                    @endif value="1">
                                                Management
                                            </option>
                                        @endif
                                        @if(auth()->user()->role <=2 )
                                            <option
                                                @if((isset($user->role) && $user->role==2) || !isset($user)) selected
                                                @endif value="2">
                                                Team
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="position" class="form-control border border-2 p-2"
                                           placeholder="What position is s\he in?"
                                           value='{{ old('position', isset($user->position)? $user->position: null)}}'
                                    >
                                    @error('position')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror('position')
                                </div>


                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">About</label>
                                    <textarea class="form-control border border-2 p-2"
                                              placeholder=" Say something about yourself" id="floatingTextarea2"
                                              name="about"
                                              rows="4"
                                              cols="50"> {{ old('about', isset($user->about)? $user->about : null) }}</textarea>
                                    @error('about')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <script>
                const imageContainer = document.getElementById('image-container');
                const imagePreview = document.getElementById('image-preview');
                const imageUpload = document.getElementById('image-upload');

                imageContainer.addEventListener('click', () => {
                    imageUpload.click();
                });

                imageUpload.addEventListener('change', () => {
                    const file = imageUpload.files[0];
                    if (file) {
                        const imageUrl = URL.createObjectURL(file);
                        imagePreview.src = imageUrl;

                        // You can also use JavaScript to send the file to the server for storage.
                        // Example AJAX request to upload the file to the server using Laravel:
                        // const formData = new FormData();
                        // formData.append('image', file);
                        // fetch('/upload-image', {
                        //     method: 'POST',
                        //     body: formData,
                        // });
                    }
                });
            </script>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
