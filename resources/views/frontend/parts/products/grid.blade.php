<div class="grid">
    <div class="product-pic">
        @if ($product->thumbnail)
            <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->thumbnail }}" alt>
        @else
            <img src="https://boschbrandstore.com/wp-content/uploads/2019/01/no-image.png" alt="No image to show" style="width: 800px; height: 168px">
        @endif
        @if ($product->discounted_price)
            <span class="theme-badge-2">{{ round(100 - (($product->discounted_price/$product->regular_price)*100), 2) }}% off</span>
        @endif
    </div>
    <div class="details">
        <h4>
            <a href="#">{{ Str::limit($product->product_name, 22) }}</a>
        </h4>
        <span class="badge bg-secondary">{{ $product->relationshipwithcategory->category_name }}</span>
        <p class="mb-0">
            <a href="#">
                {{ Str::limit($product->short_description, 30) }}
            </a>
        </p>
        <div class="rating mb-1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
        </div>
        <span class="price">
            @if ($product->discounted_price)
                <ins>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->discounted_price }}
                        </bdi>
                    </span>
                </ins>
                <del aria-hidden="true">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->regular_price }}
                        </bdi>
                    </span>
                </del>
            @else
                <ins>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">৳</span>{{ $product->regular_price }}
                        </bdi>
                    </span>
                </ins>
            @endif
        </span>
        <div class="add-cart-area">
            <a class="w-100" href="{{ route('product.details', $product->id) }}">
                <button class="add-to-cart">Details</button>
            </a>
        </div>
    </div>
</div>
