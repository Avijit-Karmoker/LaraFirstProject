<div>
    <div class="item_attribute">
        <form action="#">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
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
                        <select class="form-select" wire:model="color_dropdown">
                            @if ($available_colors)
                            <option data-display="- Please select -">Choose A Color</option>
                                @foreach ($available_colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->relationshipwithcolor->color_name }}</option>
                                @endforeach
                            @else
                                <option data-display="- Please select -">Choose A Option</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div class="{{ $visibility }}">
                <div class="quantity_wrap" style="margin-bottom: 10px">
                    <div class="quantity_input">
                        <button type="button" class="input_number_decrement" wire:click="decrement">
                            <i class="fal fa-minus"></i>
                        </button>
                        <input class="" type="text" value="{{ $count }}">
                        <button type="button" class="input_number_increment" wire:click="increment">
                            <i class="fal fa-plus"></i>
                        </button>
                    </div>
                    <div class="total_price" style="line-height: 1">
                        @if ($total_price == 0)
                            Total: ৳{{$unit_price}}
                        @else
                            Total: ৳{{$total_price}}
                        @endif
                        <br>
                        @if ($extra_charge)
                            <span class="badge text-success" style="background: #dff9fb; font-size: 11px">Colour extra charge: ৳{{ $extra_charge }}</span>
                        @endif
                    </div>
                </div>
                @if ($stock)
                    <span class="badge text-success mb-4" style="background: #dff9fb">Available Stock: {{ $stock }}</span>
                @endif
            </div>
            <ul class="default_btns_group ul_li @if($stock) @else mt-4 @endif {{ $visibility }}">
                <li>
                    @auth()
                        <a class="btn btn_primary addtocart_btn" wire:click="addtocartbtn">Add To Cart</a>
                    @else
                        <a class="btn btn_primary addtocart_btn" id="not_logged_in">Add To Cart</a>
                    @endauth
                </li>
            </ul>
        </form>
    </div>
</div>

@section('footer_scripts')
<script>
    $(document).ready(function () {
        $('#not_logged_in').click(function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="{{ route('account') }}">Please Login First</a>'
            })
        });
    })
</script>
@endsection
