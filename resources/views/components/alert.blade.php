@if(session()->has($type))
    <div class="alert alert-{{$type}}">
        {{session($type)}}
    </div>
@endif
{{--
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
--}}
