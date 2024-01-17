@props([
    'name','options','checked'=>false
])
@foreach($options as $option=>$text)
        <div class="form-check" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="form-check-input" name="{{$name}}" value="{{$option}}" autocomplete="off"
                @checked(old($name,$checked) ==$option)
            {{$attributes->class([
    'form-check-input',
        'is-valid'=>$errors->has($name)

])}}>
            <label class="btn btn-outline-info">{{$text}}</label>
        </div>
@endforeach
