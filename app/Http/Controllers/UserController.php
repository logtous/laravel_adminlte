<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:system']);
        $this->middleware(['permission:system.user'])->only('index', 'show');
        $this->middleware(['permission:system.user.create'])->only('create', 'store');
        $this->middleware(['permission:system.user.edit'])->only('edit', 'update');
        $this->middleware(['permission:system.user.destroy'])->only('destroy');
        $this->middleware(['permission:system.user.role'])->only('role', 'assignRole');
        $this->middleware(['permission:system.user.permission'])->only('permission', 'assignPermission');
        $this->middleware('language');
        $this->middleware('operate.record');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->paginate(5);

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        if ($request->exists('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        try {
            User::query()->create($data);
            return redirect('user')->with('status', 'User add success!');
        } catch (\Exception $exception) {
            return redirect('user')->with('error', 'User add failure!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::query()->findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $data = $request->all(['name', 'email', 'password']);
        if ($request->exists('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        try {
            $user->update($data);
            return redirect('user')->with('status', 'User update success!');
        } catch (\Exception $exception) {
            return redirect('user')->with('error', 'User update failure!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        try {
            $user->delete();
            return redirect('user')->with('status', 'User destroy success!');
        } catch (\Exception $exception) {
            return redirect('user')->with('error', 'User destroy failure!');
        }
    }

    /**
     *  Assign Role.
     *
     *  @param   int  $id
     *  @return \Illuminate\Http\Response
     */
    public function role($id)
    {
        $user = User::query()->findOrFail($id);
        $roles = Role::query()->get();
        foreach ($roles as $role) {
            $role->own = $user->hasRole($role) ? true : false;
        }
        return view('user.role', compact('user', 'roles'));
    }

    /**
     * Assign Role.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignRole(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $roles = $request->get('roles', []);
        try {
            $user->syncRoles($roles);
            return redirect('user')->with('status', 'User role update success!');
        } catch (\Exception $exception) {
            return redirect('user')->with('error', 'User role update failure!');
        }
    }

    /**
     *  Assign Permission.
     *
     *  @param   int  $id
     *  @return \Illuminate\Http\Response
     */
    public function permission($id)
    {
        $user = User::query()->findOrFail($id);
        $permissions = Permission::with('allChilds')->where('parent_id', 0)->get();
        foreach ($permissions as $p1) {
            $p1->own = $user->hasDirectPermission($p1->id) ? 'checked' : '' ;
            if ($p1->childs->isNotEmpty()) {
                foreach ($p1->childs as $p2) {
                    $p2->own = $user->hasDirectPermission($p2->id) ? 'checked' : '' ;
                    if ($p2->childs->isNotEmpty()) {
                        foreach ($p2->childs as $p3) {
                            $p3->own = $user->hasDirectPermission($p3->id) ? 'checked' : '' ;
                        }
                    }
                }
            }
        }
        return view('user.permission', compact('user', 'permissions'));
    }

    /**
     * Assign Permission.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignPermission(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $permissions = $request->get('permissions', []);
        try {
            $user->syncPermissions($permissions);
            return redirect('user')->with('status', 'User permission update success!');
        } catch (\Exception $exception) {
            return redirect('user')->with('error', 'User permission update failure!');
        }
    }
}
