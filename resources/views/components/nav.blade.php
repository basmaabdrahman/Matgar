<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            @foreach($items as $item)
                <li>
                    <a href="{{route($item['route'])}}" class="nav-link {{\Illuminate\Support\Facades\Route::is($item['active'] )? 'active' : '' }}">
                        <i class="{{$item['icon']}}"></i><span class="nav-text">{{$item['name']}}</span>
                    </a>

                </li>
            @endforeach
        </ul>
    </div>
</div>
