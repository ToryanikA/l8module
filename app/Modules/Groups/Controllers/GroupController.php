<?php

namespace App\Modules\Groups\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Groups\Models\Group;

class GroupController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('Groups::index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('Groups::edit')->withGroup($group);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('Groups::create');
    }
}
