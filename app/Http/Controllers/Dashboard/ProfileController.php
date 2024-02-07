<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;


class ProfileController extends Controller
{
    public function edit(){
        $user=Auth::user();

        return view('dashboard.profile.edit',[
            'user'=>$user,
            'countries'=>Countries::getNames(),
        'locales'=>Languages::getNames(),
        ]);
    }
    public function update(Request $request){
        $user=$request->user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('profile.edit')->with('success','your profile has updated');
    }
}
