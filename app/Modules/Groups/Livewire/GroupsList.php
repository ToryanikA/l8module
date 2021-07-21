<?php

namespace App\Modules\Groups\Livewire;

use App\Modules\Groups\Models\Group;
use Livewire\Component;
use Livewire\WithPagination;

class GroupsList extends Component
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
        return view('Groups::livewire.list', [
            'groups' => Group::orderBy('id', 'desc')->paginate($this->perPage),
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

        if (!auth()->user()->canAccess('Groups', \App\Classes\Permissions::DELETE)) {
            $this->alert('error', __('Forbidden'));
            return;
        }

        if ($id == 1) {
            $this->alert('error', __('Forbidden'));
            return;
        }

        Group::where('id', $id)->delete();
        $this->alert('success', __('Deleted'));
    }
}
