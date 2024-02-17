@extends('layouts.dashboard')
@section('title','Update Form')
@section('content')
    <h2>Categories</h2>
    <div class="basic-form">
        <form method="post" action="{{route('dashboard.products.update',$product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('dashboard.products._form',[
    'button_label'=>'Update'
])
        </form>
    </div>

@endsection
