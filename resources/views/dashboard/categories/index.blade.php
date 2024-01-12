@extends('layouts.dashboard')
@section('title','Categories')
@section('content')
<h2>Categories</h2>
<div class='mb-5'>
<a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary">Create Category</a>
</div>
@if(session()->has('success'))
<div class="alert alert-success">
{{session('success')}}
</div>
@endif
@if(Session()->has('edit'))
<div class="alert alert-success">
{{session('edit')}}
</div>
@endif
@if(Session()->has('delete'))
<div class="alert alert-danger">
{{session('delete')}}
</div>
@endif
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th>#</th>
                                                <th>image</th>
                                                <th>Name</th>
                                                <th>Parent</th>
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
                                                <td>{{$category->parent_id}}</td>
                                                <td>{{$category->created_at}}</td>
                                                 <td><a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success">EDIT</a></td>
                                                 <td>
                                                 <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
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

@endsection
