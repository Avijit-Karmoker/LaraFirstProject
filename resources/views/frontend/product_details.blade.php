@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Product Details</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- product_details - start
================================================== -->
<section class="product_details section_space pb-0">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="product_details_image">
                    <div class="details_image_carousel">
                        <div class="slider_item">
                            <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->thumbnail }}" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                    </div>

                    <div class="details_image_carousel_nav">
                        {{-- <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found">
                        </div> --}}
                        <div class="slider_item" style="height: 104px;">
                            <img style="padding-top: 14px;" src="{{ asset('uploads/product_thumbnail') }}/{{ $product->thumbnail }}" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_1.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_2.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_3.png" alt="image_not_found">
                        </div>
                        <div class="slider_item">
                            <img src="{{ asset('frontend_assets') }}/images/details/product_details_img_4.png" alt="image_not_found">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="product_details_content">
                    {{-- {{ $product }} --}}
                    <h2 class="item_title">{{ $product->product_name }}</h2>
                    <p>{{ $product->short_description }}</p>
                    <div class="item_review">
                        <ul class="rating_star ul_li">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                        <span class="review_value">3 Rating(s)</span>
                    </div>

                    <div class="item_price">
                        @if ($product->discounted_price)
                            <span>৳{{ $product->discounted_price }}</span>
                            <del>৳{{ $product->regular_price }}</del>
                        @else
                            <span>৳{{ $product->regular_price }}</span>
                        @endif
                    </div>
                    <hr>
                    @livewire('productdetails.addtocart', ['product_id' => $product->id])
                    <hr>
                </div>
            </div>
        </div>

        <div class="details_information_tab">
            <ul class="tabs_nav nav ul_li" role=tablist>
                <li>
                    <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                        Description
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab" aria-controls="additional_information_tab" aria-selected="false">
                    Additional information
                    </button>
                </li>
                <li>
                    <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                    Reviews(2)
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                    <p>{{ $product->description }}</p>
                </div>

                <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                    <p>
                        {{ $product->additional_discription }}
                    </p>
                </div>

                <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                    <div class="average_area">
                        <div class="row align-items-center">
                            <div class="col-md-12 order-last">
                                <div class="average_rating_text">
                                    <ul class="rating_star ul_li_center">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p class="mb-0">
                                    Average Star Rating: <span>4 out of 5</span> (2 vote)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="customer_reviews">
                        <h4 class="reviews_tab_title">2 reviews for this product</h4>
                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="{{ asset('frontend_assets') }}/images/team/team_1.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Aonathor troet</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                            </div>
                        </div>

                        <div class="customer_review_item clearfix">
                            <div class="customer_image">
                                <img src="{{ asset('frontend_assets') }}/images/team/team_2.jpg" alt="image_not_found">
                            </div>
                            <div class="customer_content">
                                <div class="customer_info">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <h4 class="customer_name">Danial obrain</h4>
                                    <span class="comment_date">JUNE 2, 2021</span>
                                </div>
                                <p class="mb-0">
                                Great product quality, Great Design and Great Service.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="customer_review_form">
                        <h4 class="reviews_tab_title">Add a review</h4>
                        <form action="#">
                            <div class="form_item">
                                <input type="text" name="name" placeholder="Your name*">
                            </div>
                            <div class="form_item">
                                <input type="email" name="email" placeholder="Your Email*">
                            </div>
                            <div class="your_ratings">
                                <h5>Your Ratings:</h5>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                                <button type="button"><i class="fal fa-star"></i></button>
                            </div>
                            <div class="form_item">
                                <textarea name="comment" placeholder="Your Review*"></textarea>
                            </div>
                            <button type="submit" class="btn btn_primary">Submit Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product_details - end
================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @forelse ($related_products as $product)
                            @include('frontend.parts.products.grid')
                        @empty
                            <div class="alart alart-danger">No related product to show</div>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related_products_section - end
================================================== -->
@endsection
