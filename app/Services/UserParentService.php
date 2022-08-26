<?php

namespace App\Services;

use App\Models\UserParent;

/**
 * Class UserParentService.
 */
class UserParentService
{
    public function store($data)
    {
        $UserParent = UserParent::firstWhere('email', $data['email']);

        if (isset($UserParent)) {
            return null;
        }

        $UserParent = UserParent::create($data);
        return $UserParent;
    }

    public function update($data, $id)
    {
        $UserParent = UserParent::where('id', $id)->first();
        if (is_null($UserParent)) {
            return null;
        }

        $UserParent = UserParent::where('email', $data['email'])->first();
        if (isset($UserParent) && $UserParent->id !== $UserParent->id) {
            return null;
        }

        $UserParent->update($data);
        return $UserParent;
    }
}
