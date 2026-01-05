<div class="container my-5">
    <div class="card shadow-lg border-0 invoice-letter">

        <!-- Header -->
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset('logobloomp.png') }}" 
                     class="img-fluid" 
                     style="max-height:70px;">

                <div class="text-end">
                    <h2 class="fw-bold mb-0">INVOICE</h2>
                    <small class="text-muted">
                        #{{ $invoice->invoice_number }}
                    </small>
                </div>
            </div>

            <hr>

            <!-- Customer Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-uppercase text-muted mb-2">
                        Billed To
                    </h6>
                    <p class="mb-1 fw-semibold">
                        {{ $invoice->customer->name }}
                    </p>
                    <p class="mb-0 text-muted">
                        {{ $invoice->customer->email }}
                    </p>
                    <p class="mb-0 text-muted">
                        {{ $invoice->customer->phone }}
                    </p>
                </div>

                <div class="col-md-6 text-end">
                    <h6 class="text-uppercase text-muted mb-2">
                        Invoice Date
                    </h6>
                    <p class="mb-0">
                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}
                    </p>
                </div>
            </div>

            <hr>

            <!-- Summary -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Total Amount</p>
                    <h3 class="fw-bold text-dark">
                        ₦{{ number_format($invoice->total, 2) }}
                    </h3>
                </div>

                <div class="col-md-6 text-end">
                    @if($invoice->payment_status === 'owing')
                        <span class="badge bg-danger fs-6 px-3 py-2">
                            Owing ₦{{ number_format($invoice->balance, 2) }}
                        </span>
                    @else
                        <span class="badge bg-success fs-6 px-3 py-2">
                            Fully Paid
                        </span>
                    @endif
                </div>
            </div>

            <hr>

            <!-- Actions -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.invoices.download', $invoice->id) }}"
                   class="btn btn-dark px-4">
                    <i class="fas fa-file-pdf me-2"></i>
                    Download PDF
                </a>
            </div>

        </div>
    </div>
</div>
