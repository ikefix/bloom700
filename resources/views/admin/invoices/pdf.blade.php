<div class="container my-4">

    <!-- Header -->
    <div class="text-center mb-4">
        <img src="{{ asset('logobloomp.png') }}" class="img-fluid mb-2" style="max-height:80px;">
        <h2 class="fw-bold mb-0">Invoice</h2>
        <small class="text-muted">Invoice No: {{ $invoice->invoice_number }}</small>
    </div>

    <!-- Customer Details -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Customer Details</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $invoice->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $invoice->customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $invoice->customer->phone }}</p>
                </div>
                <div class="col-md-6">
                    @if($invoice->customer->company)
                        <p><strong>Company:</strong> {{ $invoice->customer->company }}</p>
                    @endif

                    @if($invoice->customer->address)
                        <p><strong>Address:</strong> {{ $invoice->customer->address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Purchased Goods -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Purchased Goods</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $product = \App\Models\Product::find($invoice->goods['product_id']);
                    @endphp
                    <tr>
                        <td>{{ $product?->name ?? 'Unknown product' }}</td>
                        <td class="text-center">{{ $invoice->goods['quantity'] }}</td>
                        <td class="text-end">
                            ₦{{ number_format($invoice->goods['total_price'], 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Payment Summary -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <strong>Payment Summary</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Total Amount:</strong></p>
                    <p><strong>Amount Paid:</strong></p>
                    <p><strong>Payment Type:</strong></p>
                </div>
                <div class="col-md-6 text-end">
                    <p>₦{{ number_format($invoice->total, 2) }}</p>
                    <p>₦{{ number_format($invoice->amount_paid, 2) }}</p>
                    <p>{{ ucfirst($invoice->payment_type) }}</p>
                </div>
            </div>

            <hr>

            @if($invoice->payment_status === 'owing')
                <div class="alert alert-danger mb-0">
                    <strong>Outstanding Balance:</strong>
                    ₦{{ number_format($invoice->balance, 2) }}
                </div>
            @else
                <div class="alert alert-success mb-0">
                    <strong>Status:</strong> Fully Paid
                </div>
            @endif
        </div>
    </div>

</div>
