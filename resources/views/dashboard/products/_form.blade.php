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
    <x-form.label >product Name</x-form.label>

    <x-form.input name="name" type="text" value="{{$product->name}}"/>
</div>

<div class="form-group">
    <x-form.label >Product's Category </x-form.label>
    <select name="category_id" class="form-control form-select">
        <option value="">Product Category</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}" @selected(old('category_id',$product->category_id) == $product->id)>{{$category->name}}</option>
        @endforeach
    </select>
    <x-form.label >Product's Store </x-form.label>
    <select name="store_id" class="form-control form-select">
        <option value="">Product Store</option>
        @foreach($stores as $store)
            <option value="{{$store->id}}" @selected(old('store_id',$product->store_id) == $store->id)>{{$store->name}}</option>
        @endforeach
    </select>
    <div class="form-group">
        <x-form.label >Category Description</x-form.label>
        <x-form.textarea name="description" value="{{$product->description}}"/>
    </div>
    <div class="form-group">
        <x-form.input type="file" name="image" class="form-control" label="Category Image"/>

        @if($product->image)
            <div>
                <img src="{{asset('storage/'.$product->image)}}" height="50">
            </div>
        @endif
    </div>
    <div class="form-group">
        <x-form.label >Category Status</x-form.label>
        <div>
            <x-form.radio name="status" checked='{{$product->status}}' :options="['active'=>'Active','archived'=>'Archived']"/>
        </div>
    </div>
    <div class="form-group">
        <x-form.label >product price</x-form.label>

        <x-form.input name="price" type="number" value="{{$product->name}}"/>
    </div>
    <div class="form-group">
        <x-form.label >product compared price</x-form.label>

        <x-form.input name="compare_price" type="number" value="{{$product->name}}"/>
    </div>

</div>
<div class="form-group">
    <x-form.label >Product Option</x-form.label>
    <div>
        <x-form.radio name="option" checked='{{$product->option}}' :options="['active'=>'Active','archived'=>'Archived']"/>
    </div>
</div>
<div class="form-group">
    <x-form.label >product rating</x-form.label>

    <x-form.input name="rating" type="range" min="0" max="5" value="{{$product->rating}}"/>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary">{{$button_label ?? 'Save'}}</button>
</div>
