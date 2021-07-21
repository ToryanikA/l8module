<?php

namespace App\Modules\Users\Livewire;

use App\Modules\Groups\Models\Group;
use App\Modules\Groups\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UsersCreate extends Component
{
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
     * @var array
     */
    public $groups = [];

    /**
     *
     */
    public function mount()
    {
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        return redirect()->route('users.list');
    }
}
