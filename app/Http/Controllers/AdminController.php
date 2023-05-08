<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $users_students = DB::table('users')
            ->where('role', '=', 0)
            ->paginate(10);

        $users_professors = DB::table('users')
            ->where('role', '=', 1)
            ->paginate(10);

        foreach ($users_professors as $user)
        {
                $user->role_text = 'Profesor';
        }

        foreach ($users_students as $user)
        {
            $user->role_text = 'Student';
        }


        return view('admin_pages.users', ['users_professors' => $users_professors,
            'users_students' => $users_students]);
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
        if ($request->new_password) {
            if($request->new_password === $request->password_confirmation)
            {
                if(strlen($request->new_password) >= 8) {
                    $pw = Hash::make($request->new_password);
                    User::updateOrCreate(
                        [
                            'id' => $id
                        ],
                        [
                            'name' => $request->name,
                            'index_number' => $request->index_number,
                            'email' => $request->email,
                            'password' => $pw,
                        ]
                    );
                }
                else
                    return redirect()->back()->with('error', 'Molimo Vas da šifra sadrži minimum 8 karaktera.');
            }
            else
                return redirect()->back()->with('error', 'Nova šifra i potvrdna šifra se ne poklapaju.');
        }

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

    public function getUsers(Request $request)
    {
        $users_students = DB::table('users')
            ->where('role', '=', 0)
            ->where('index_number', '=', $request->index_number)
            ->paginate(10);

        $users_professors = DB::table('users')
            ->where('role', '=', 1)
            ->paginate(10);

        foreach ($users_professors as $user)
        {
            $user->role_text = 'Profesor';
        }

        foreach ($users_students as $user)
        {
            $user->role_text = 'Student';
        }

        return view('admin_pages.users', ['users_professors' => $users_professors,
            'users_students' => $users_students]);
    }

}
