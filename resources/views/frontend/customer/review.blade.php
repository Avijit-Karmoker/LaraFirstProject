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
        <style>
            span:hover{
                cursor: pointer;
            }
        </style>
    <!-- account_section - start
    ================================================== -->
    <section class="account_section section_space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 account_menu">
                    <div class="card">
                        <div class="card-header bg-info fw-bold fs-6" style="color: white;">
                            Give Reviews
                        </div>
                        <div class="card-body">
                            @foreach ($invoice_details as $invoice_detail)
                                <div class="d-flex align-items-center justify-content-between px-4">
                                    <div>
                                        <p>Product Name: {{ $invoice_detail->relationshipwithproduct->product_name }}</p>
                                        <p>Quantity: {{ $invoice_detail->quantity }}</p>
                                        <p>Price: {{ $invoice_detail->relationshipwithproduct->discounted_price * $invoice_detail->quantity }}</p>
                                    </div>
                                    <div>
                                        <img width="200" src="{{ asset('uploads/product_thumbnail') }}/{{ $invoice_detail->relationshipwithproduct->thumbnail }}" alt="">
                                    </div>
                                </div>
                                <div class="px-4">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Rating</label>
                                          <div id="rating">
                                            <span class="star fs-4" onclick="setRating(1)" id="{{ $invoice_detail->id }}">&#9733;</span>
                                            <span class="star fs-4" onclick="setRating(2)" id="{{ $invoice_detail->id }}">&#9733;</span>
                                            <span class="star fs-4" onclick="setRating(3)" id="{{ $invoice_detail->id }}">&#9733;</span>
                                            <span class="star fs-4" onclick="setRating(4)" id="{{ $invoice_detail->id }}">&#9733;</span>
                                            <span class="star fs-4" onclick="setRating(5)" id="{{ $invoice_detail->id }}">&#9733;</span>
                                          </div>
                                        </div>
                                        <div class="mb-3">
                                          <label for="" class="form-label">Comment</label>
                                          <textarea type="text" class="form-control" name="" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                          <label for="" class="form-label">Upload Image</label>
                                          <input type="file" class="form-control" name="">
                                        </div>
                                    </form>
                                </div>
                            @endforeach
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
    function setRating(rating) {
      var stars = document.querySelectorAll("#rating .star");
      for (var i = 0; i < stars.length; i++) {
        if (i < rating) {
          stars[i].style.color = "orange";
        } else {
          stars[i].style.color = "black";
        }
      }
    }
</script>
@endsection
