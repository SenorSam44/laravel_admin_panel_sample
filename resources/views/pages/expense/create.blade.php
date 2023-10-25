<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="create-expense"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Expenses"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">{{ isset($expense) ? 'Edit Expense' : 'Add new Expense' }}</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form
                                action="{{route('expenses.store')}}"
                                method="POST">
                                @csrf

{{--                                @if (isset($expense))--}}
{{--                                    @method('PUT')--}}
{{--                                @endif--}}
                                <div class="row">
                                    <input type="hidden" name="id" value="{{isset($expense->id)? $expense->id: 'new'}}">

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
                                </div>
                                <button type="submit" class=" mt-3 btn bg-gradient-dark">
                                    {{ isset($expense) ? 'Update Expense' : 'Add Expense' }}
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
