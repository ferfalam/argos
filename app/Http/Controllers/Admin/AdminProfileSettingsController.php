<?php

namespace App\Http\Controllers\Admin;

use App\EmployeeDetails;
use App\Helper\Reply;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminProfileSettingsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-user';
        $this->pageTitle = 'app.menu.profileSettings';
    }

    public function index()
    {
        $this->userDetail = $this->user;
        $this->employeeDetail = EmployeeDetails::where('user_id', '=', $this->userDetail->id)->first();

        return view('admin.profile.index', $this->data);
    }

    public function stopImpersonate()
    {
        $userId = session('impersonate');
        session()->flush();
        Auth::logout();
        Auth::loginUsingId($userId);
        return redirect('super-admin/dashboard');
    }

    public function changeLanguage(Request $request)
    {
        $setting = User::findOrFail($this->user->id);
        $setting->locale = $request->input('lang');
        $setting->save();
        session()->forget('user');
        return Redirect::back();
    }
}
