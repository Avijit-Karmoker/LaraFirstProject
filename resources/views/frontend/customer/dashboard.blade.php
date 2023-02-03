@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
    ================================================== -->
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>My Account</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- account_section - start
    ================================================== -->
    <section class="account_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 account_menu">
                    <div class="nav account_menu_list flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link text-start active w-100" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Dashboard </button>
                        <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Acount</button>
                        <button class="nav-link text-start w-100" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">My Orders</button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content bg-light p-3" id="v-pills-tabContent">
                        <div class="tab-pane fade show active text-center" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            {{-- @if((auth()->user()->created_at->diffInHours(\Carbon\Carbon::now())) < 1) --}}
                            <h5>Welcome to Account</h5>
                            {{-- @endif --}}
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <h3>Total Orders</h3>
                                            <h5>{{ $invoices->count() }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>Total Buy</h3>
                                            <h5>৳{{ $invoices->sum('order_total') }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>COD</h3>
                                            <p>{{ $invoices->where('payment_method', 'cod')->count() }}</p>
                                        </div>
                                        <hr>
                                        <div class="col-4">
                                            <h3>Online</h3>
                                            <h5>{{ $invoices->where('payment_method', 'online')->count() }}</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>Total Paid</h3>
                                            <h5>{{ $invoices->where('payment_status', 'paid')->count() }} (৳{{ $invoices->where('payment_status', 'paid')->sum('order_total') }})</h5>
                                        </div>
                                        <div class="col-4">
                                            <h3>Total Unpaid</h3>
                                            <h5>{{ $invoices->where('payment_status', 'paid')->count() }} (৳{{ $invoices->where('payment_status', 'unpaid')->sum('order_total') }})</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-5">Charts</h1>
                            <div class="card mt-5">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <canvas id="payment_method_chart"></canvas>
                                        </div>
                                        <div class="col-6">
                                            <canvas id="payment"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h5 class="text-center pb-3">Account Details</h5>
                            <form class="row g-3 p-2">
                                <div class="col-md-6">
                                    <label for="inputnamel4" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputnamel4" value="Mr. Jon Doe">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" value="jon@doe.com">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword4">
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary active">Update</button>
                                </div>
                                </form>
                            </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h5 class="text-center pb-3">Your Orders</h5>
                            <div class="text-end my-3">
                                <a href="{{ route('download.invoice.all', auth()->id()) }}" class="text-center btn-sm btn-info">Download All</a>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SL</th>
                                    <th>Order No</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Delivery Charge</th>
                                    <th>Payment</th>
                                    <th>Payment Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($invoices as $invoice)
                                @php
                                    $coupon = $invoice->coupon_info;
                                @endphp
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>
                                            #{{ $invoice->id . "-" . $invoice->created_at->format('dmY') }}
                                            {!! DNS2D::getBarcodeHTML($invoice->id . "-" . $invoice->created_at->format('dmY'), 'QRCODE'); !!}
                                        </td>
                                        <td>{{ ($invoice->order_total + get_coupon_price($coupon)) - $invoice->shipping_charge }}</td>
                                        <td>{{ get_coupon_price($coupon) }}</td>
                                        <td>{{ $invoice->shipping_charge }}</td>
                                        <td>{{ $invoice->payment_method }}</td>
                                        <td>{{ $invoice->payment_status }}</td>
                                        <td>{{ $invoice->order_total }}</td>
                                        <td>
                                            <a href="{{ route('download.invoice', $invoice->id) }}" class="btn-sm btn-primary">Download Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- account_section - end
================================================== -->
@endsection

@section('footer_scripts')
<script>
    const ctx = document.getElementById('payment_method_chart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Cash On Delivery', 'Online Payment'],
            datasets: [{
            label: '# of payments',
            data: [{{ $invoices->where('payment_method', 'cod')->count() }}, {{ $invoices->where('payment_method', 'online')->count() }}],
            borderWidth: 2,
            // borderColor: [
            //     'rgba(255, 99, 132, 0.5)',
            //     'rgba(54, 162, 235, 0.5)',
            // ],
            // backgroundColor: [
            //     'rgba(255, 99, 132, 0.5)',
            //     'rgba(54, 162, 235, 0.5)',
            // ]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
    const ctx2 = document.getElementById('payment');

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
            label: '# of payments',
            data: [{{ $invoices->where('payment_status', 'paid')->sum('order_total') }}, {{ $invoices->where('payment_status', 'unpaid')->sum('order_total') }}],
            borderWidth: 2,
            // borderColor: [
            //     'rgba(255, 99, 132, 0.5)',
            //     'rgba(54, 162, 235, 0.5)',
            // ],
            // backgroundColor: [
            //     'rgba(255, 99, 132, 0.5)',
            //     'rgba(54, 162, 235, 0.5)',
            // ]
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endsection
