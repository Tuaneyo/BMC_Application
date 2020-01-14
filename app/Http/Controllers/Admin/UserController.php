<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AccountController;
use App\Models\User;
use App\Models\UserAssigment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Filesystem\Filesystem;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $html = ['title' => 'Alle gebruikers beheren', 'thumb' => 'people.jpg'];
        return view('admin.users.index', ['users' => User::all(), 'html' => $html]);
    }

    /**
     * show all mentors
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMentors()
    {
        $users = User::role('docent')->get();
        $html = ['title' => 'Alle mentoren beheren', 'thumb' => 'mentors.jpg'];
        return view('admin.users.index', compact('users', 'html'));
    }

    public function showStudents()
    {
        $users = User::role('student')->get();
        $html = ['title' => 'Alle studenten beheren', 'thumb' => 'students.jpg'];
        return view('admin.users.index', compact('users', 'html'));
    }

    /**
     * @param Request $newUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(Request $newUser)
    {

        if (!User::where('email', '=', $newUser->email)->exists()) {
            $user = new User();
            $user->name = $newUser->name;
            $user->email = $newUser->email;
            $user->password = Hash::make($newUser->password);
            $user->active = $newUser->active ? 1 : 0;
            $user->save();
            foreach ($newUser->roles as $role) {
                $user->assignRole($role);
            }
            return redirect()->route('admin.users.index')->with('status', 'Gebruiker is aangemaakt!');
        }
        return redirect()->back()->with('status', 'Deze gebruiker bestaat al!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateUserForm()
    {
        return view('admin.users.create', ['roles' => \Spatie\Permission\Models\Role::all()]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        try {
            if($user->exists) {
                $user->news()->delete();
                $user->assignments()->delete();
                $user->delete();
                return redirect()->route('admin.users.index');
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'gebruiker is niet gevonden');
        }
    }

    /**
     * @param Request $changedUuser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editUser(Request $changedUuser)
    {

        try {
            $user = self::getUser($changedUuser->id);

            //If there is a name change
            if($user->name != $changedUuser->name){
                //change name (obviously)
                $user->name = $changedUuser->name;

                //change file name
                if(!empty($user->file)){
                $oldfile = $user->id.'/'.$user->file;
                $ext = pathinfo($oldfile, PATHINFO_EXTENSION);
                $newfile = $user->id.'/'.$user->name.'.'.$ext;

                    rename('uploads/avatar/'.$oldfile, 'uploads/avatar/'.$newfile);
                    $user->file = $user->name.'.'.$ext;
                }

            }


            $user->lastname = $changedUuser->lastname;
            //If password is empty dont change it (mainly because password field is empty and the other fields aren't)
            if(!is_null($changedUuser->password))
                $user->password = Hash::make($changedUuser->password);

            //change role
            $user->roles()->sync([$changedUuser->roles]);

            $user->save();
            return redirect()->back()->with('status', 'Gebruiker is aangepast!');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

    /**
     * @param Request $changedUuser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $changedUuser)
    {
        try {
            $user = self::getUser($changedUuser->id);
            //If password is empty dont change it (mainly because password field is empty and the other fields aren't)
            if(!is_null($changedUuser->password) && !is_null($changedUuser->password_confirmation)){
                if($changedUuser->password_confirmation === $changedUuser->password){
                    $changedUuser->validate([
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                    ]);
                    $user->password = Hash::make($changedUuser->password);
                }
            }

            $user->save();
            return redirect()->back()->with('status', 'Wachtwoord is gewijzigd');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }


    /**
     * @param Request $changedUuser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeRole(Request $changedUuser)
    {
        try {
            $user = self::getUser($changedUuser->id);
            //change role
            $user->roles()->sync([$changedUuser->roles]);
            $user->save();
            return redirect()->back()->with('status', 'Role is aangepast');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

    /**
     * @param Request $changedUuser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeProfileImg(Request $changedUuser)
    {
        try {
            $user = self::getUser($changedUuser->id);

            //join user and file and use as argument for changeProfilePicture

            if (!empty($changedUuser->upload)) {
                //Upload avatar

                $changedUuser->validate([
                    'upload' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                ]);

                $name = $user->name;
                if (preg_match('/\s/', $changedUuser->name)) {
                    $name = str_replace(' ', '_', $changedUuser->name);
                    $name = strtolower($name);
                }
                $filename = $name . '.' . $changedUuser->file('upload')->extension();

                $user->file = $filename;
                $changedUuser->file('upload')->storeAs($user->id, $filename, 'avatar');
            }


            $user->save();
            return redirect()->back()->with('status', 'Profiel foto is geupload');
        }
        catch(Exception $e){
            return redirect()->back()->with('status', 'Er is iets fout gegaan'.$e->getMessage().'');
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function getUser($user)
    {
        $dUser = Crypt::decryptString($user);
        $user = User::find($dUser);
        return $user;
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditUserForm(User $user)
    {
        $roles = Role::where('name', '<>', 'administrator')->get();
        // all assignmenents of users
        $assignments = UserAssigment::where('user_id', $user->id)->count();
        // rated assignments of user
        $rated = UserAssigment::where([['user_id', $user->id], ['rated', '<>', 0]])->count();
        // not rated assignments of user
        $notRated = UserAssigment::where([['user_id', $user->id], ['rated', 0]])->count();
        return view('admin.users.edit', ['user' => $user, 'roles' => $roles, 'assignments' => $assignments, 'rated' => $rated, 'notRated' => $notRated]);
    }


}
