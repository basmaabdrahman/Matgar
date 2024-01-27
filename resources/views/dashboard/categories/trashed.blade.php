@extends('layouts.dashboard')
@section('title','Categories')
@section('content')
    <h2>Categories</h2>
    <x-alert type="success"/>
    <x-alert type="info"/>
    <x-alert type="danger"/>
    <div class='mb-5'>
        <a href="{{route('dashboard.categories.index')}}" class="btn btn-sm btn-outline-primary">Back</a>
    </div>
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
                <th>Parent</th>
                <th>Status</th>
                <th>Created_at</th>
                <th colspan="2">Actions<th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td><img src="{{asset('storage/'.$category->image)}}" height='50'/></td>
                    <td>{{$category->name}}
                    </td>
                    <td>{{$category->parent_name}}</td>
                    <td>{{$category->status}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>
                        <form action="{{route('dashboard.categories.restore',$category->id)}}" method="post">
                            @csrf
                            <!--form Method Spoofing-->
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-primary">RESTORE</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('dashboard.categories.forceDelete',$category->id)}}" method="post">
                            @csrf
                            <!--form Method Spoofing-->
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @empty

                <tr>
                    <td colspan='7'>Categories not defined</td>
                </tr>
            @endforelse


            </tbody>
        </table>

    </div>
    {{$categories->withQueryString()->links()}}

@endsection
