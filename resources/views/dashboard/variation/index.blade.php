@extends('layouts.dashboardmaster')

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            @livewire('variation.addsize')
        </div>
        <div class="col-xl-6 col-lg-6">
            @livewire('variation.addcolor')
        </div>
    </div>
</div>

<!--**********************************
    Content body end
***********************************-->

@endsection
