@props([
        'type'=>'text','name','value'=>''
])
<input type= "{{$type}}" name="{{$name}}" value="{{old($name,$value)}}"
       {{$attributes->class([
    'form-control',
    'is-valid'=>$errors->has($name)

])}}
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
