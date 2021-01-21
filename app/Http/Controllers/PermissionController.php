<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $this->middleware(['permission:system.permission'])->only('index', 'show');
        $this->middleware(['permission:system.permission.create'])->only('create', 'store');
        $this->middleware(['permission:system.permission.edit'])->only('edit', 'update');
        $this->middleware(['permission:system.permission.destroy'])->only('destroy');
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
        $permissions = Permission::query()->get();
        return view('permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::with('allChilds')->where('parent_id', 0)->get();
        $type_list = Permission::$type_list;
        return view('permission.create', compact('permissions', 'type_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $data = $request->all();
        try {
            Permission::query()->create($data);
            return redirect('permission')->with('status', 'Permission add success!');
        } catch (\Exception $exception) {
            return redirect('permission')->with('error', 'Permission add failure!');
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
        $permission = Permission::query()->findOrFail($id);
        $permissions = Permission::with('allChilds')->where('parent_id', 0)->get();
        $type_list = Permission::$type_list;
        return view('permission.show', compact('permission', 'permissions', 'type_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::query()->findOrFail($id);
        $permissions = Permission::with('allChilds')->where('parent_id', 0)->get();
        $type_list = Permission::$type_list;
        return view('permission.edit', compact('permission', 'permissions', 'type_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $permission = Permission::query()->findOrFail($id);
        $data = $request->all();
        try {
            $permission->update($data);
            return redirect('permission')->with('status', 'Permission update success!');
        } catch (\Exception $exception) {
            return redirect('permission')->with('error', 'Permission update failure!');
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
        $permission = Permission::query()->findOrFail($id);
        try {
            $permission->delete();
            return redirect('permission')->with('status', 'Permission destroy success!');
        } catch (\Exception $exception) {
            return redirect('permission')->with('error', 'Permission destroy failure!');
        }
    }
}
