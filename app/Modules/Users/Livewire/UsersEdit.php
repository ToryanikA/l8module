<?php

namespace App\Modules\Users\Livewire;

use App\Modules\Groups\Models\Group;
use App\Modules\Groups\Models\User;
use App\Modules\Groups\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UsersEdit extends Component
{
    /**
     * @var
     */
    public $user;

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $email = '';

    /**
     * @var string
     */
    public $password = '';

    /**
     * @var string
     */
    public $password_confirmation = '';

    /**
     * @var
     */
    public $group;

    /**
     * @var
     */
    public $groups;

    /**
     * @param User $user
     */
    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->group = $user->userGroup->group_id ?? '';
        $this->groups = Group::all()->mapWithKeys(function ($group) {
            return [$group->id => $group->name];
        });
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('Users::Livewire.form');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'password' => ['confirmed', Password::defaults()],
        ]);
        $this->user->name = $this->name;
        $this->user->email = $this->email;

        if (!empty($this->password)) {
            $this->user->password = Hash::make($this->password);
        }
        $this->user->save();

        UserGroup::updateOrCreate(
            [
                'user_id' => $this->user->id
            ],
            [
                'group_id' => $this->group,
                'user_id' => $this->user->id
            ]
        );
        return redirect()->route('users.list');
    }
}
