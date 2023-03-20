<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }

    public function show_users()
    {
        $users = DB::table('users')
            ->where('role', '=', 0)
            ->orWhere('role', '=', 1)
            ->get();

        foreach ($users as $user)
        {
            if($user->role == 0)
                $user->role_text = 'Student';
            else
                $user->role_text = 'Profesor';
        }


        return view('admin_pages.users', ['users' => $users]);
    }

    public function delete_user($id)
    {
        $user = User::find($id);

        $name = $user->name;

        $user->delete();

        return redirect('/admin/users')->with('success', 'Obrisali ste korisnika pod imenom '. $name);
    }

    public function edit_user($id)
    {
        $data = User::find($id);

        return response()->json(['data' => $data]);
    }

    public function update_user(Request $request, $id)
    {
        User::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $request->name,
                'index_number' => $request->index_number,
                'email' => $request->email,
            ]
        );

        return redirect('/admin/users')->with('success', 'Uspešno ste ažurirali korisnika.');
    }

    public function update_role($id)
    {
        $user = User::find($id);

        if($user->role == 0)
            $user->role = 1;
        else
            $user->role = 0;

        $user->update();

        //delete all courses that this user had
        $courses = Course::where('user_id', '=', $id)->get();
        foreach ($courses as $course)
            $course->delete();

        return redirect('/admin/users')->with('success', 'Uspešno ste ažurirali korisnika.');
    }
}
