<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Auth;
use App\User;
use DB;
use Excel;
use Validator,
    Redirect;
use Session;
use Illuminate\Http\Request;
use App\UserSocialMedia;
use App\SocialMedia;

class UsersController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        if (isset($_GET['firstName'])) {
            $data['firstName'] = $_GET['firstName'];
        }
        if (isset($_GET['lastName'])) {
            $data['lastName'] = $_GET['lastName'];
        }
        if (isset($_GET['email'])) {
            $data['email'] = $_GET['email'];
        }
        if (isset($_GET['role_id'])) {
            $data['role_id'] = $_GET['role_id'];
        }
        $data['page'] = $page;
        return view('admin.users.index', $data);
    }

    public function listing(Request $request) {
        // d($request->all(),1);
        $data['search'] = $request->all();
        $data['model'] = User::searchUser($data['search']);
        return view('admin.users.ajax.list', $data);
    }

    public function userDetail(Request $request, $id) {
        $user_id = $request->id;
        if ($user_id > 0) {
            if (Auth::user()->role->code == 'admin') {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $data = User::where('users.id', '=', $user_id)->get();
                $search['user_id'] = $user_id;
                $users = User::userSocialMEdiaShares($search);
                $sm = SocialMedia::select('code', 'color')->get();
                //d($share,1);
                return view('admin.users.details', [
                    'data' => $data,
                    'page' => $page,
                    'users' => $users,
                    'sm' => $sm
                ]);
            } else {
                return redirect('home');
            }
        } else {
            return redirect('home');
        }
    }

    public function edit($id) {
        $user_id = $id;
        $data['user'] = User::findOrFail($user_id);
        if (isset($data['user']->dob)) {
            list($year, $month, $date) = explode('-', $data['user']->dob);
            $data['user']->date = $date;
            $data['user']->month = $month;
            $data['user']->year = $year;
        }
        return view('admin.users.edit', $data)->with('user_id', $user_id);
    }

    public function update(Request $request) {
        $user_id = $request->id;
        $user = User::findOrFail($user_id);

        $rules = array(
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|min:6|email|unique:users,email,' . $user->id,
            'phone' => 'min:8',
            'about' => 'min:20|max:2000',
        );

        $validator = Validator::make($request->all(), $rules);
        // $checkEmail=User::where('email','!=',$user->email)->where('email',$request->email)->count();
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
            array_forget($input, '_token');
            array_forget($input, 'year');
            array_forget($input, 'date');
            array_forget($input, 'month');
            $input['dob'] = $request->year . "-" . $request->month . "-" . $request->date;
            //d($input);
            $affectedRows = User::where('id', '=', $user_id)->update($input);
            echo $affectedRows;
            Session::flash('success', 'Your profile has been updated.');
            return redirect()->back();
        }
    }

    public function delete($id) {
        User::where('id', '=', $id)->delete();
        Session::flash('success', 'Successfully Deleted!');
        return redirect()->back();
    }

    public function accept(Request $request, $id) {
        DB::table('users')->where('id', $id)->update([
            'status' => 1,
            'updated_at' => date('Y-m-d'),
        ]);
        $request->session()->flash('alert-success', 'Successfully Approved!');
        return back();
    }

    public function reject(Request $request, $id) {
        DB::table('users')->where('id', $id)->update([
            'status' => 0,
            'updated_at' => date('Y-m-d'),
        ]);
        $request->session()->flash('alert-success', 'Successfully Disapproved!');
        return back();
    }

    public function downloadExcel($type) {
        $sql = "SELECT u.firstName FirstName,u.`lastName` LastName,u.`email`Email,u.`phone`Phone,u.`location`Location,
       GROUP_CONCAT(DISTINCT l.title) Languages, 
       GROUP_CONCAT(DISTINCT s.title) Skills,
       COUNT(DISTINCT t1.id) TasksPosted,
       COUNT(DISTINCT t2.id) TasksCompleted,
       AVG(r.`rating`) AverageRating
FROM   users u 
       LEFT JOIN users_languages ul 
               ON  ul.user_id = u.id
       LEFT  JOIN languages l 
               ON ul.language_id = l.id
       LEFT JOIN users_skills us 
               ON us.user_id = u.`id`
       LEFT  JOIN skills s 
               ON s.id = us.`skill_id`
       LEFT JOIN tasks t1 ON t1.user_id = u.id
       LEFT JOIN (SELECT * FROM tasks WHERE taskStatus='completed')t2 ON t2.user_id = u.id
       LEFT JOIN reviews r ON r.rate_to = u.id
GROUP  BY u.`id`";
        $result = DB::select($sql);
        $data = array_map(function($object) {
            return (array) $object;
        }, $result);
        return Excel::create('users_data', function($excel) use ($data) {
                    $excel->sheet('mySheet', function($sheet) use ($data) {
                        $sheet->fromArray($data);
                    });
                })->download($type);
    }

//    public function importExcel() {
//        if (Input::hasFile('import_file')) {
//            $path = Input::file('import_file')->getRealPath();
//            $data = Excel::load($path, function($reader) {
//                        
//                    })->get();
//            if (!empty($data) && $data->count()) {
//                foreach ($data as $key => $value) {
//                    $insert[] = ['title' => $value->title, 'description' => $value->description];
//                }
//                if (!empty($insert)) {
//                    DB::table('users')->insert($insert);
//                    dd('Insert Record successfully.');
//                }
//            }
//        }
//        return back();
//    }
}
