@extends('layouts.dashboard')
@section('title','Products')
@section('content')
    <h2>Products Trash</h2>
    <x-alert type="success"/>
    <x-alert type="info"/>
    <x-alert type="danger"/>
    <div class='mb-5'>
        <a href="{{route('dashboard.products.index')}}" class="btn btn-sm btn-outline-primary">Back</a>
    </div>
    <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
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
                    <td>
                        <form action="{{route('dashboard.products.restore',$product->id)}}" method="post">
                            @csrf
                            <!--form Method Spoofing-->
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">RESTORE</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('dashboard.products.forceDelete',$product->id)}}" method="post">
                            @csrf
                            <!--form Method Spoofing-->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan='7'>Products not defined</td>
                </tr>
            @endforelse


            </tbody>
        </table>

    </div>
    {{$products->withQueryString()->links()}}

@endsection
