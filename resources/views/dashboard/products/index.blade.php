@extends('layouts.dashboard')
@section('title','products')
@section('content')
<h2>Categories</h2>
<div class='mb-5'>
<a href="{{route('dashboard.products.create')}}" class="btn btn-sm btn-outline-primary">Create product</a>
    </div>
<x-alert type="success"/>
<x-alert type="info"/>
<x-alert type="danger"/>

<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
<div class="row mx-2">
       <x-form.input  name="name" class="mx-2"/>

    <div class="col">
        <select class="form-control mx-2" name="status">
        <option value="">All</option>
        <option value="active" >Active</option>
        <option value="archived">Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </div>
 </div>
</form>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>image</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Store</th>
                                                <th>Price</th>
                                                <th>Compare Price</th>
                                                <th>Rating</th>
                                                <th>Featured</th>
                                                <th>Status</th>
                                                <th colspan="2">Actions<th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td><img src="{{asset('storage/'.$product->image)}}" height='50'/></td>
                                                <td>{{$product->name}}
                                                </td>
                                                <td>{{$product->category->name}}</td>
                                                <td>{{$product->store->name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->compare_price}}</td>
                                                <td>{{$product->rating}}</td>
                                                <td>{{$product->featured}}</td>
                                                <td>{{$product->status}}</td>
                                                 <td><a href="{{route('dashboard.categories.edit',$product->id)}}" class="btn btn-sm btn-outline-success">EDIT</a></td>
                                                 <td>
                                                 <form action="{{route('dashboard.categories.destroy',$product->id)}}" method="post">
                                                 @csrf
                                                 <!--form Method Spoofing-->
                                                 @method('delete')
                                                 <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                                                 </form>
                                                 </td>
                                            </tr>
                                            @empty

                                            <tr>
                                            <td colspan='11'>Products not defined</td>
                                            </tr>
                                    @endforelse


                                        </tbody>
                                    </table>

                                </div>
                                    {{$products->withQueryString()->links()}}

@endsection
