@props([
        'name','value'=>''
])
<textarea name="{{$name}}"
      {{$attributes->class([
    'form-control',
    'is-valid'=>$errors->has($name)

])}}>{{old($name,$value)}}</textarea>

@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
@enderror
