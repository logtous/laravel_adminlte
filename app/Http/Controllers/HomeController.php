<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('language');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        $queryKey = $request->input('term');
        $res = $this->_formatTree($this->tree(), $queryKey);
        return Response::json($res);
    }

    /**
     * filter tree
     * @param $menus
     * @param  string  $filter
     * @param  int  $level
     * @param  array  $tmp
     * @return array
     */
    private function _formatTree($menus, $filter = '', $level = 1, &$tmp = [])
    {
        if (empty($menus)) {
            return [];
        }
        $gate = app(Gate::class);
        foreach ($menus as $menu) {
            if (($level <= 2 or ($level <= 3 and isset($menu['_child']) && !empty($menu['_child']))) && $filter && (strpos(
                $menu['display_name'],
                $filter
            ) !== false || strpos($menu['route'], $filter) !== false)) {
                if ($gate->check($menu['name'])) {
                    $route = isset($menu['route']) && !empty($menu['route']);
                    $tmp[] = [
                        'label' => str_repeat('&nbsp;&nbsp;', $level).'┣☛'.$menu['display_name'],
                        'id' => $route ? route($menu['route']) : '',
                    ];
                };
            }
            if (isset($menu['_child']) && !empty($menu['_child'])) {
                $this->_formatTree($menu['_child'], $filter, $level + 1, $tmp);
            }
        }
        return $tmp;
    }

    /**
     * permission tree
     * @param  array  $list
     * @param  string  $pk
     * @param  string  $pid
     * @param  string  $child
     * @param  int  $root
     * @return array
     */
    public function tree($list = [], $pk = 'id', $pid = 'parent_id', $child = '_child', $root = 0)
    {
        if (empty($list)) {
            $list = Permission::query()->get()->toArray();
        }
        $tree = array();
        if (is_array($list)) {
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }
}
