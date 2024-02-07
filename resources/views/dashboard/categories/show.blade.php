@extends('layouts.dashboard')
@section('title',$category->name)
@section('content')
    <h2>{{$category->name}}</h2>
    <div class="table-responsive">
        <h5>Products</h5>

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
            </tr>
            </thead>
            <tbody>
            @php
            $products=$category->products()->with('store')->paginate();
            @endphp
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
                </tr>
            @empty

                <tr>
                    <td colspan='10'>Products not defined</td>
                </tr>
            @endforelse


            </tbody>
        </table>

    </div>
@endsection
