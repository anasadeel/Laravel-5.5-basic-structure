<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\ContactUs;
use Session;

class ContactusController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $contactus = ContactUs::orderBy('id', 'desc')->paginate(15);
        return view('admin.contact_us.index', compact('contactus'));
    }

    public function detail($id) {

        $contactus = ContactUs::where('id', '=', $id)->first();
        return view('admin.contact_us.details', compact('contactus'));
    }

    public function delete($id) {
        ContactUs::where('id', '=', $id)->delete();
        Session::flash('success', 'Successfully Deleted');
        return redirect()->back();
    }

}
