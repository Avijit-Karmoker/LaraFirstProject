@extends('layouts.master')
@section ('name')
    @for ($i = 1; $i <= 10; $i++)
        <h3>{{ $i }}</h3>
        <h1>I love my country</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolores aspernatur eaque itaque nesciunt nam, harum ratione earum blanditiis, et quo accusamus quisquam vitae necessitatibus! Nemo ipsum numquam commodi fugiat.</p>
    @endfor
@endsection

@section('footer-content')
    About Page
@endsection
