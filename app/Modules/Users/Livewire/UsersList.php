<?php

namespace App\Modules\Users\Livewire;

use App\Modules\Groups\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    protected $perPage = 10;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('Users::livewire.list', [
            'users' => User::orderBy('id', 'desc')->paginate($this->perPage),
        ]);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        if (empty($id)) {
            return;
        }

        if (!auth()->user()->canAccess('Users', \App\Classes\Permissions::DELETE)) {
            $this->alert('error', __('Forbidden'));
            return;
        }

        if ($id == 1) {
            $this->alert('error', __('Forbidden'));
            return;
        }

        User::where('id', $id)->delete();
        $this->alert('success', __('Deleted'));
    }
}
