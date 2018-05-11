<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;

class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();

        $data['totalUsers'] = User::where('role_id', '!=', 1)->count();
        $data['recentUsers'] = User::where('role_id', '!=', 1)->orderBy('id', 'desc')->limit(7)->get();
        return view('admin.dashboard', $data);
    }

}
