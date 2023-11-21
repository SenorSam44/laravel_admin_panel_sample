<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="invoice"></x-navbars.sidebar>
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
                                    Invoice #{{$invoice->invoice_number}}
                                </h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                <a rel="tooltip" class="btn btn-success btn-link"
                                   href="{{route('invoices.edit', $invoice->id)}}"
                                   data-original-title=""
                                   title="">
                                    <i class="material-icons">edit</i>
                                    &nbsp;Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <iframe src="{{ route('invoices.webview-pdf', $invoice->id) }}" frameborder="0" width="100%" height="700"></iframe>
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
                        <label for="price">Price</label>
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
