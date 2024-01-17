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
    <x-form.label >Category Name</x-form.label>

    <x-form.input name="name" type="text" value="{{$category->name}}"/>
</div>

<div class="form-group">
    <x-form.label >Category Parent</x-form.label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id',$category->parent_id) == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
    <div class="form-group">
        <x-form.label >Category Description</x-form.label>
        <x-form.textarea name="description" value="{{$category->description}}"/>
    </div>
    <div class="form-group">
        <x-form.input type="file" name="image" class="form-control" label="Category Image"/>

        @if($category->image)
          <div>
         <img src="{{asset('storage/'.$category->image)}}" height="50">
          </div>
        @endif
    </div>
    <div class="form-group">
        <x-form.label >Category Status</x-form.label>
        <div>
            <x-form.radio name="status" checked='{{$category->status}}' :options="['active'=>'Active','archived'=>'Archived']"/>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary">{{$button_label ?? 'Save'}}</button>
</div>
