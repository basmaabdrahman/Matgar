@extends('layouts.dashboard')
@section('title','New Category')
@section('content')
<h2>Categories</h2>
<div class="basic-form">
    <form method="post" action="{{route('dashboard.categories.store')}}" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form',[
    'button_label'=>'Create'
])
    </form>
</div>

@endsection
