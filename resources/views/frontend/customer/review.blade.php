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
            .review-button{
                border: none;
                background: rgb(2, 175, 2);
                padding: 10px 25px;
                border-radius: 8px;
                margin-top: 2%;
                color: #fff;
            }
            *{
                margin: 0;
                padding: 0;
            }
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px 0 0;
            }
            .rate:not(:checked) > input {
                position:absolute;
                /* top:-9999px; */
                display: none;
            }
            .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★ ';
            }
            .rate > input:checked ~ label {
                color: #ffc700;
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #deb217;
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
            }
            .block{
                margin-bottom: 0;
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
                                    <form action="{{ route('insert.review', $invoice_detail->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="rate mb-4">
                                            <p class="block">Rating</p>
                                            <input type="radio" id="star5_{{ $invoice_detail->id }}" name="rating" value="5" />
                                            <label for="star5_{{ $invoice_detail->id }}" title="text">5 stars</label>
                                            <input type="radio" id="star4_{{ $invoice_detail->id }}" name="rating" value="4" />
                                            <label for="star4_{{ $invoice_detail->id }}" title="text">4 stars</label>
                                            <input type="radio" id="star3_{{ $invoice_detail->id }}" name="rating" value="3" />
                                            <label for="star3_{{ $invoice_detail->id }}" title="text">3 stars</label>
                                            <input type="radio" id="star2_{{ $invoice_detail->id }}" name="rating" value="2" />
                                            <label for="star2_{{ $invoice_detail->id }}" title="text">2 stars</label>
                                            <input type="radio" id="star1_{{ $invoice_detail->id }}" name="rating" value="1" />
                                            <label for="star1_{{ $invoice_detail->id }}" title="text">1 star</label>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="mb-4">
                                          <label for="" class="form-label">Comment</label>
                                          <textarea type="text" class="form-control" name="comments" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                          <label for="" class="form-label">Upload Image</label>
                                          <input type="file" class="form-control" name="review_image">
                                        </div>
                                        <div class="mb-3">
                                          <button type="submit" class="review-button">Give Review</button>
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
