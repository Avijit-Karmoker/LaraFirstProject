<div>
    <div class="item_attribute">
        <form action="#">
            <div class="row">
                <div class="col col-md-6">
                    <div class="select_option clearfix">
                        <h4 class="input_title">Size *</h4>
                        <select class="form-select" wire:model='size_dropdown'>
                            <option data-display="- Please select -">Choose A Option</option>
                            @foreach ($available_sizes as $available_size)
                                <option value="{{ $available_size->relationshipwithsize->id }}">{{ $available_size->relationshipwithsize->size }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="select_option clearfix">
                        <h4 class="input_title">Color *</h4>
                        <select class="form-select">
                            @if ($available_colors)
                                @foreach ($available_colors as $color)
                                    <option value="1">{{ $color->relationshipwithcolor->color_name }}</option>
                                @endforeach
                            @else
                                <option data-display="- Please select -">Choose A Option</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="quantity_wrap">
                <div class="quantity_input">
                    <button type="button" class="input_number_decrement">
                        <i class="fal fa-minus"></i>
                    </button>
                    <input class="input_number" type="text" value="1">
                    <button type="button" class="input_number_increment">
                        <i class="fal fa-plus"></i>
                    </button>
                </div>
                <div class="total_price">Total: ৳620.99</div>
            </div>

            <ul class="default_btns_group ul_li">
                <li><a class="btn btn_primary addtocart_btn" href="#!">Add To Cart</a></li>
            </ul>
        </form>
    </div>
</div>
