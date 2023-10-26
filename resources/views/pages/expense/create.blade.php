<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="create-{{str_contains($type, 'expense')? 'expense': 'income'}}"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="{{str_contains($type, 'expense')? 'Expenses' : 'Incomes'}}"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">
                                    {{ isset($expense) ? 'Edit' : 'Add new' }}
                                    {{str_contains($type, 'expense')? 'Expense': 'Income'}}
                                </h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form
                                action="{{str_contains($type, 'expense')? route('expenses.store'): route('income.store')}}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{isset($expense->id)? $expense->id: 'new'}}">
                                    <input type="hidden" name="type"
                                           value="{{$type}}">

                                    <div class="mb-3 col-md-6">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control border border-2 p-2" id="date"
                                               name="date"
                                               value="{{ isset($expense) ? date_format($expense->date, "Y-m-d") : old('date') }}"
                                               required>
                                        @error('date')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control border border-2 p-2" id="description"
                                               name="description"
                                               value="{{ isset($expense) ? $expense->description : old('description') }}"
                                               required>
                                        @error('description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="category">Category</label>
                                        <input type="text" class="form-control border border-2 p-2" id="category"
                                               name="category"
                                               value="{{ isset($expense) ? $expense->category : old('category') }}"
                                               required>
                                        @error('category')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" class="form-control border border-2 p-2"
                                               id="amount" name="amount"
                                               value="{{ isset($expense) ? $expense->amount : old('amount') }}"
                                               required>
                                        @error('amount')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>

                                    @if(isset($expense))

                                    <div class="mb-3 col-md-6">
                                        <label for="amount">Upload files</label>

                                        {{-- Don't change the model_related_to field to income --}}
                                        <x-subcomponent.fileupload-button model_related_to="expense"
                                                                          model_id="{{$expense->id}}">
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
                                                         alt="{{$file->name}}">
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
                                <button type="submit" class=" mt-3 btn bg-gradient-dark">
                                    {{ isset($expense) ? 'Update' : 'Add' }} {{str_contains($type, 'expense')? 'Expense': 'Income'}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
