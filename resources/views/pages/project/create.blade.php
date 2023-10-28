<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="create-project"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Project"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">
                                    {{ isset($project) ? 'Edit' : 'Add new' }} Projects
                                </h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @if (session('status'))
                                <div class="row">
                                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('status') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <form
                                action="{{route('projects.store')}}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id"
                                           value="{{isset($project->id)? $project->id: 'new'}}"/>
                                    @foreach($attributes as $attribute)
                                        <div class="mb-3 {{$attribute != 'description'? 'col-md-6': 'col-md-12' }}">
                                            <label
                                                for="{{ $attribute }}">{{ ucwords( str_replace('_', ' ', $attribute)) }}</label>
                                            @if (str_contains($attribute, 'date'))
                                                <input type="date" class="form-control border border-2 p-2"
                                                       id="{{ $attribute }}" name="{{ $attribute }}"
                                                       value="{{ isset($project) ? date_format($project->$attribute, 'Y-m-d') : old($attribute) }}"
                                                       required>
                                            @elseif ($attribute === 'description')
                                                <textarea class="form-control border border-2 p-2" rows="6"
                                                          id="{{ $attribute }}" name="{{ $attribute }}">
                                                    {{ isset($project) ? $project->$attribute : old($attribute) }}
                                                </textarea>
                                            @elseif ($attribute === 'status')
                                                <select class="form-control border border-2 p-2" id="{{ $attribute }}"
                                                        name="{{ $attribute }}" required>
                                                    <option
                                                        value="ongoing" {{ (isset($project) && $project->status === 'ongoing') ? 'selected' : '' }}>
                                                        Ongoing
                                                    </option>
                                                    <option
                                                        value="completed" {{ (isset($project) && $project->status === 'completed') ? 'selected' : '' }}>
                                                        Completed
                                                    </option>
                                                    <option
                                                        value="pending" {{ (isset($project) && $project->status === 'pending') ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                </select>
                                            @elseif($attribute === 'published')
                                                <div class="form-check form-switch">
                                                    <input type="hidden" name="{{ $attribute }}" value="0"> <!-- Hidden input for 'false' value -->
                                                    <input id="{{ $attribute }}" name="{{ $attribute }}"
                                                           class="form-check-input" type="checkbox"
                                                           value="1" {{ $project->$attribute ? 'checked' : '' }}
                                                           role="switch" {{isset($project->$attribute) && $project->$attribute? 'checked': ''}}>
                                                </div>
                                            @elseif(in_array($attribute , ['client_id', 'budget', 'progress']))
                                                <input class="form-control border border-2 p-2"
                                                       type="number" step="0.01" id="{{ $attribute }}"
                                                       name="{{ $attribute }}"
                                                       value="{{ isset($project) ? $project->$attribute : old($attribute) }}"
                                                       required>
                                            @else
                                                <input type="text" class="form-control border border-2 p-2"
                                                       id="{{ $attribute }}" name="{{ $attribute }}"
                                                       value="{{ isset($project) ? $project->$attribute : old($attribute) }}"
                                                       required>
                                            @endif
                                            @error($attribute)
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    @endforeach

                                </div>
                                <button type="submit" class=" mt-3 btn bg-gradient-dark">
                                    {{ isset($project) ? 'Update' : 'Add' }} Project
                                </button>
                            </form>

                            @if(isset($project))

                                <div class="mb-3 col-md-6">
                                    <label for="amount">Upload files</label>

                                    {{-- Don't change the model_related_to field to income --}}
                                    <x-subcomponent.fileupload-button model_related_to="project"
                                                                      model_id="{{$project->id}}">
                                    </x-subcomponent.fileupload-button>
                                </div>

                                <div id="file-previews" class="row">
                                    <!-- File previews will be displayed here -->

                                    @foreach($files as $file)
                                        @php
                                            $filePath = 'storage/' . str_replace('public/', '', $file->location);
                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp

                                        <div class="file-preview col-md-4 my-3 position-relative">
                                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                                <img class="w-100 p-4 border border-dark rounded"
                                                     src="{{asset('storage/'.str_replace("public/", "", $file->location))}}"
                                                     alt="{{$file->name}}"/>
                                            @else
                                                <button
                                                    type="button"
                                                    class="btn border-radius-lg w-100 h-100 shadow-sm"
                                                    id="image-preview">
                                                    <i class="material-icons w-100 h-100"
                                                       style="font-size: min(30vh, 15vw)">drafts</i>
                                                </button>
                                            @endif
                                            <p>{{$file->name}}</p>
                                            <button
                                                type="button"
                                                class="btn btn-danger delete-file position-absolute rounded-circle p-0"
                                                style="top: -1em; right: 0; width: 30px; height: 30px;"
                                                data-file-id="{{$file->id}}"
                                                data-file="{{$file->name}}">
                                                <i class="material-icons">close</i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
