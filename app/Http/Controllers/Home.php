<?php

namespace App\Http\Controllers;

use App;
use App\Model\Google\Drive;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;

class Home extends Controller
{
    // drive instance
    public $drive;

    public function __construct()
    {
        $this->drive = new Drive();
    }

    public function index()
    {
        return view('home.main');
    }

    public function google_login(Request $request)  {

        return $this->drive->auth($request);
    }

    public function get_user_profile()
    {
        return view('home.profile');
    }

    public function upload_local(Request $request)
    {
        $this->drive->upload_file($request);
        return redirect()->to('/');
    }

    public function download_file($file_id = null, Request $request)
    {
        return $this->drive->download_file($file_id, $request);
    }

    public function list_files(Request $request)
    {
        $lists =  $this->drive->list_files($request);
        return view('home.list', compact('lists'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->to('/');
    }

}
