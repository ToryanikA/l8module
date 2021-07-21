<?php

namespace App\Modules\Groups\Livewire;

use App\Modules\Groups\Models\Group;
use Livewire\Component;

class GroupsEdit extends Component
{
    /**
     * @var
     */
    public $group;

    /**
     * @var
     */
    public $name;

    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @var string[]
     */
    protected $rules = [
        'name' => 'required|min:3',
    ];

    /**
     * GroupsEdit constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->messages = [
            'name.required' => __('The name cannot be empty.'),
            'name.min' => __('The name must be at least :min.'),
        ];
    }

    /**
     * @param Group $group
     */
    public function mount(Group $group)
    {
        $this->group = $group;
        $this->name = $group->name;
        $group->permissions->map(function ($permission) {
            $this->permissions[$permission->module][$permission->permission] = $permission->value;
        });
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('Groups::Livewire.form');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->validate();
        $this->group->name = $this->name;
        $this->group->save();

        foreach ($this->permissions as $module => $permissions) {
            foreach ($permissions as $permission => $value) {
                $permission = $this->group->permissions
                    ->where('module', $module)
                    ->where('permission', $permission)
                    ->first();

                $permission->value = $value;
                $permission->save();
            }
        }

        return redirect()->route('groups.list');
    }
}
