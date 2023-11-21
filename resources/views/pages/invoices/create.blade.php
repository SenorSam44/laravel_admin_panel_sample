<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="create-invoice"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Invoice"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">
                                    {{ isset($invoice) ? 'Edit' : 'Add new' }}
                                    Invoice
                                </h6>
                            </div>
                            <div class="me-3 my-3 text-end">
                                <a class="btn bg-gradient-dark"
                                   href="{{route('invoices.show', $invoice->id)}}">
                                    <i class="material-icons">visibility</i>
                                    &nbsp;&nbsp;View
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <form
                                action="{{route('invoices.store')}}"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{isset($invoice->id)? $invoice->id: 'new'}}">
                                    @foreach($attributes as $attribute)
                                        <div
                                            class="mb-3 {{!in_array($attribute, ['to_address']) ? 'col-md-6' : 'col-md-12' }}">
                                            <label
                                                for="{{ $attribute }}">{{ ucwords(str_replace('_', ' ', $attribute)) }}</label>

                                            @if ($attribute === 'to_address')
                                                <textarea class="form-control border border-2 p-2" rows="6"
                                                          id="{{ $attribute }}"
                                                          name="{{ $attribute }}">{{ isset($invoice) ?
                                                                $invoice->$attribute : old($attribute) }}</textarea>
                                            @elseif($attribute === 'to_address')
                                                <input type="tel" name="phone" class="form-control border border-2 p-2"
                                                       value='{{ old('phone', isset($user->phone)? $user->phone : null) }}'>
                                            @elseif (in_array($attribute, ['payment_method']))
                                                <select class="form-control border border-2 p-2" id="{{ $attribute }}"
                                                        onchange="toggleOptionalInput()"
                                                        name="{{ $attribute }}" required>
                                                    @foreach ($invoice_attributes_options[$attribute] as $option)
                                                        <option
                                                            value="{{ $option }}" {{ (isset($invoice) && $invoice->$attribute == $option) ? 'selected' : '' }}>
                                                            {{ ucwords(str_replace('_', ' ', $option)) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            @elseif(in_array($attribute, ['user_id']))
                                                <select class="form-control border border-2 p-2" id="{{ $attribute }}"
                                                        name="{{ $attribute }}" required>
                                                    @foreach ($invoice_attributes_options[$attribute] as $option)
                                                        <option
                                                            value="{{ $option }}" {{ (isset($invoice) && $invoice->$attribute == $option) ? 'selected' : '' }}>
                                                            {{ ucwords(str_replace('_', ' ', $option)) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            @else
                                                <input type="text" class="form-control border border-2 p-2"
                                                       id="{{ $attribute }}" name="{{ $attribute }}"
                                                       value="{{ isset($invoice) ? $invoice->$attribute : old($attribute) }}"
                                                       required>
                                            @endif

                                            @error($attribute)
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                @endforeach

                                <!-- Dynamic Invoice Items Section -->
                                    <div id="invoiceItemsSection"
                                         class="mt-5">
                                        <div class="row mb-2 py-3">
                                            <div class="col-auto my-auto">
                                                <div class="h-100">
                                                    <h4 class="my-1">
                                                        Invoice Items
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                                                <div class="nav-wrapper position-relative end-0">
                                                    <button type="button"
                                                            class="btn btn-outline-success my-auto"
                                                            onclick="addInvoiceItem()">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-table row">
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class=" mt-3 btn bg-gradient-dark">
                                    {{ isset($invoice) ? 'Update' : 'Add' }} Invoice
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                invoice_item_count = 0;
                @if(isset($invoice) && isset($invoice_items) && count($invoice_items)>0)
                @foreach($invoice_items as $invoice_item)
                addInvoiceItem("{!!$invoice_item->name !!}", {{$invoice_item->quantity}}, {{$invoice_item->unit_price}});
                @endforeach
                @else
                addInvoiceItem();
                @endif
                function addInvoiceItem(name = NaN, quantity = NaN, unit_price = NaN) {
                    invoice_item_count++;
                    const invoiceItemsSection = document.querySelector('#invoiceItemsSection .row.invoice-table');

                    const newItemDiv = document.createElement('div');
                    newItemDiv.className = 'mb-3 col-md-4';

                    newItemDiv.innerHTML = `
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control border border-2 p-2" name="items[${invoice_item_count}][name]" value="${name}" required>
                    `;

                    const quantityDiv = document.createElement('div');
                    quantityDiv.className = 'mb-3 col-md-3';

                    quantityDiv.innerHTML = `
                        <label for="quantity">Quantity</label>
                            <input type="number" class="form-control border border-2 p-2" name="items[${invoice_item_count}][quantity]" value="${quantity}" required>
                    `;

                    const priceDiv = document.createElement('div');
                    priceDiv.className = 'mb-3 col-md-3';

                    priceDiv.innerHTML = `
                        <label for="price">Unit Price</label>
                        <input type="number" class="form-control border border-2 p-2" name="items[${invoice_item_count}][unit_price]" value="${unit_price}" required>
                    `;

                    const deleteButtonDiv = document.createElement('div');
                    deleteButtonDiv.className = "mb-3 col-md-2 position-relative";

                    deleteButtonDiv.innerHTML = `
                        <button type="button" class="btn btn-danger position-absolute mb-1 bottom-0 start-0">
                             <i class="material-icons">close</i>
                        </button>
                    `
                    deleteButtonDiv.querySelector('button').onclick = function () {
                        invoiceItemsSection.removeChild(newItemDiv);
                        invoiceItemsSection.removeChild(quantityDiv);
                        invoiceItemsSection.removeChild(priceDiv);
                        invoiceItemsSection.removeChild(deleteButtonDiv);
                    };

                    invoiceItemsSection.appendChild(newItemDiv);
                    invoiceItemsSection.appendChild(quantityDiv);
                    invoiceItemsSection.appendChild(priceDiv);
                    invoiceItemsSection.appendChild(deleteButtonDiv);

                }
            </script>

            <script>
                toggleOptionalInput();
                function toggleOptionalInput() {
                    // Get the selected value
                    let selectedPaymentMethod = document.getElementById('payment_method').value;

                    // Get the optional input container
                    let bank_payment_inputs = document.querySelectorAll('input#account_no, input#account_name, input#transaction_number');
                    // Check if the selected payment method requires the optional input
                    bank_payment_inputs.forEach((bank_payment_input, idx) => {
                        bank_payment_input.parentElement.style.display = selectedPaymentMethod === 'cash' ? 'none': 'block';
                    })
                }
            </script>

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
