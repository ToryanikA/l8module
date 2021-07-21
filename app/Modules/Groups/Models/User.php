<?php

namespace App\Modules\Groups\Models;

class User extends \App\Models\User
{
    /**
     * @param $permission
     * @param $module
     * @return bool
     */
    public function canAccess($module, $permission)
    {
        if (empty($this->userGroup->group)) {
            return false;
        }

        $permission = $this->userGroup->group->permissions
            ->where('permission', $permission)
            ->where('module', $module)
            ->where('value', true)
            ->first();

        if ($permission) {
            return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userGroup()
    {
        return $this->hasOne(UserGroup::class);
    }
}
