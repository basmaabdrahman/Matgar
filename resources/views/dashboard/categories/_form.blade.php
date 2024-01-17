@if($errors->any())
    <div class="alert-danger">
        <h3>Attention</h3>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    <label for="">Category Name</label>
    <input type="text" name="name" value="{{old('name',$category->name)}}"
     @class([
        'form-control ','is-invalid'=>$errors->has('name')
]) placeholder="Input Default">
    @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id',$category->parent_id) == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
    <div class="form-group">
        <label for="">Category Description</label>
        <textarea type="text" name="description" class="form-control input-default" placeholder="Input Default">{{old('description',$category->descrption)}}</textarea>
    </div>
    <div class="form-group">
        <label for="">Category Image</label>
        <input type="file" name="image" class="form-control" >

        @if($category->image)
          <div>
        <img src="{{asset('storage/'.$category->image)}}" height="50">
          </div>
        @endif
    </div>
    <div class="form-group">
        <label for="">Category Status</label>
        <div>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="status" value="active" autocomplete="off" @checked(old('status',$category->status) == 'active')>
                <label class="btn btn-outline-primary">active</label>

                <input type="radio" class="btn-check" name="status" value="archived" autocomplete="off" @checked(old('status',$category->status) =='archived')>
                <label class="btn btn-outline-primary" >archived</label>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary">{{$button_label ?? 'Save'}}</button>
</div>
