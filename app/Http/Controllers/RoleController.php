<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $this->middleware(['permission:system.role'])->only('index', 'show');
        $this->middleware(['permission:system.role.create'])->only('create', 'store');
        $this->middleware(['permission:system.role.edit'])->only('edit', 'update');
        $this->middleware(['permission:system.role.destroy'])->only('destroy');
        $this->middleware(['permission:system.role.permission'])->only('permission', 'assignPermission');
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
        $roles = Role::query()->paginate(5);

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $data = $request->all();
        try {
            Role::query()->create($data);
            return redirect('role')->with('status', 'Role add success!');
        } catch (\Exception $exception) {
            return redirect('role')->with('error', 'Role add failure!');
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
        $role = Role::query()->findOrFail($id);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::query()->findOrFail($id);
        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::query()->findOrFail($id);
        $data = $request->all();
        try {
            $role->update($data);
            return redirect('role')->with('status', 'Role update success!');
        } catch (\Exception $exception) {
            return redirect('role')->with('error', 'Role update failure!');
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
        $role = Role::query()->findOrFail($id);
        try {
            $role->delete();
            return redirect('role')->with('status', 'Role destroy success!');
        } catch (\Exception $exception) {
            return redirect('role')->with('error', 'Role destroy failure!');
        }
    }

    /**
     * Assign Permission.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function permission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::query()->where('parent_id', 0)->get();
        foreach ($permissions as $p1) {
            $p1->own = $role->hasPermissionTo($p1->id) ? 'checked' : false ;
            if ($p1->childs->isNotEmpty()) {
                foreach ($p1->childs as $p2) {
                    $p2->own = $role->hasPermissionTo($p2->id) ? 'checked' : false ;
                    if ($p2->childs->isNotEmpty()) {
                        foreach ($p2->childs as $p3) {
                            $p3->own = $role->hasPermissionTo($p3->id) ? 'checked' : false ;
                        }
                    }
                }
            }
        }
        info(__METHOD__, [$role, $permissions]);
        return view('role.permission', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);
        $permissions = $request->get('permissions', []);
        try {
            $role->syncPermissions($permissions);
            return redirect('role')->with('status', 'Role update success!');
        } catch (\Exception $exception) {
            return redirect('role')->with('error', 'Role update failure!');
        }
    }
}
