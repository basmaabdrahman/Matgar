@extends('layouts.dashboard')
@section('title','Update Form')
@section('content')
    <x-alert type="success"/>

    <h2>Profile</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <div class="media-body">
                                <h3 class="mb-0">{{$user->profile->first_name}}</h3>
                                <p class="text-muted mb-0">{{$user->country}}</p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted px-4">Following</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card card-profile text-center">
                                    <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                    <h3 class="mb-0">263</h3>
                                    <p class="text-muted">Followers</p>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-danger px-5">Follow Now</button>
                            </div>
                        </div>

                        <h4>About Me</h4>
                        <p class="text-muted">{{$user->profile->birthday}}<br>
                        {{$user->profile->country}}.{{$user->profile->city}}</p>
                        <ul class="card-profile__info">
                            <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>01793931609</span></li>
                            <li><strong class="text-dark mr-4">Email</strong> <span>{{$user->email}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Form</h4>
                        <div class="basic-form">
                            <form method="post" action="{{route('profile.update')}}">
                                @method('patch')
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-form.label>first name</x-form.label>
                                        <x-form.input type="text" class="form-control"  name="first_name" placeholder="Enter First Name" :value="$user->profile->last_name"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-form.label>Last Name</x-form.label>
                                        <x-form.input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" :value="$user->profile->last_name"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-form.label>Birthday</x-form.label>
                                        <input type="date" class="form-control" placeholder="Enter Your Birthday">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-form.label>gender </x-form.label>
                                        <x-form.radio name="gender" :options="['male'=>'Male','female'=>'Female']" :checked="$user->profile->gender" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <x-form.label>Street Address</x-form.label>
                                    <x-form.input type="text" name="street_address" class="form-control" placeholder="1234 Main St" :value="$user->profile->street_address"/>
                                </div>
                                <div class="form-group">
                                    <x-form.label>postal code</x-form.label>
                                    <x-form.input type="text" class="form-control" placeholder="Postal Code" name="postal-code"/>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-form.label>Country</x-form.label>
                                        <x-form.select name="country" :options="$countries" :selected="$user->profile->country" class="form-control"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-form.label>Language</x-form.label>
                                        <x-form.select name="locale" :options="$locales" :selected="$user->profile->locale" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-form.label>City</x-form.label>
                                        <x-form.input name="city" :value="$user->profile->city" class="form-control"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-form.label>State</x-form.label>
                                        <x-form.input name="state" :value="$user->profile->state" class="form-control"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
