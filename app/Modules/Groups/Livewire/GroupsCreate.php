<?php

namespace App\Modules\Groups\Livewire;

use App\Classes\Permissions;
use App\Modules\Groups\Models\Group;
use Livewire\Component;

class GroupsCreate extends Component
{
    /**
     * @var string
     */
    public $name = '';

    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @var string[]
     */
    protected $rules = [
        'name' => 'required|min:3',
    ];

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * GroupsCreate constructor.
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

        $group = Group::create([
            'name' => $this->name
        ]);

        foreach (config('module.modules') as $module) {
            foreach (Permissions::getAll() as $permission) {
                $group->permissions()->create([
                    'module' => $module,
                    'permission' => $permission,
                    'value' => $this->permissions[$module][$permission] ?? false
                ]);
            }
        }

        return redirect()->route('groups.list');
    }
}
