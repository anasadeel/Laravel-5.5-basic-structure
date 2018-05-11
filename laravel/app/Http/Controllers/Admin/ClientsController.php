<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use Auth;
use App\Tasks;
use App\User;
use Illuminate\Http\Request;
use App\Orders;

class ClientsController extends AdminController  {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (Auth::user()->role->role == 'admin') {

            $model = User::where('role_id', '!=', 1)
                    ->leftJoin('roles as r', 'r.id', '=', 'users.role_id')
                    ->select('users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.role_id', 'users.created_at', 'r.role')
                    ->get();
            return view('admin.clients', compact('model'));
        } else {
            return redirect('home');
        }
    }

    public function userDetail(Request $request, $id) {
        $userId = $request->id;
        if ($userId > 0) {
            if (Auth::user()->role->role == 'admin') {

                $data = User::where('users.id', '=', $userId)->get();

                $model = Tasks::leftJoin('countries', 'countries.id', '=', 'tasks.country')
                        ->leftJoin('states','states.code', '=', 'tasks.state')
                        ->select('tasks.*', 'countries.name as country', 'states.title as state')
                        ->where('tasks.user_id', '=', $userId)
                        ->where('tasks.status', '=', 1)
                        ->get();
                //d($model,1);

                return view('admin.client', [
                    'data' => $data,
                    'model' => $model,
                ]);
            } else {
                return redirect('home');
            }
        } else {
            return redirect('home');
        }
    }

}
