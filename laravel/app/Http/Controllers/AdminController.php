<?php

namespace App\Http\Controllers;
use Auth;
use Session;

class AdminController extends Controller {
    public function __construct() {
        session_start();
        $this->middleware('admin');
    }

}
