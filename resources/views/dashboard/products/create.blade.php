@extends('layouts.dashboard')
@section('title','New Product')
@section('content')
    <h2>Categories</h2>
    <div class="basic-form">
        <form method="post" action="{{route('dashboard.products.store')}}" enctype="multipart/form-data">
            @csrf
            @include('dashboard.products._form',[
        'button_label'=>'Create'
    ])
        </form>
    </div>

@endsection
