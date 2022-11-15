<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Models\UserParent;

/**
 * Class UserParentService.
 */
class UserParentService
{
    public function store($data)
    {
        $this->checkEmailUnique($data['email']);
        $this->checkCinUnique($data['cin']);
        $UserParent = UserParent::create($data);
        return $UserParent;
    }


    public function update($data, $id)
    {
        $parent = $this->getparent($id);
        $this->checkCinUnique($data['cin']);
        $this->checkEmailUnique($data['email']);
        $parent->update($data);
        return $parent;
    }



    public function checkCinUnique($cin)
    {

        $parent = UserParent::where('cin', $cin)->first();
        if (isset($parent)) {
            throw new NotFoundException(['code' => -2, 'message' => 'parent_cin existe']);
        }
        return $parent;
    }

    public function checkEmailUnique($email)
    {
        $parent = UserParent::where('email', $email)->first();
        if (isset($parent)) {
            throw new NotFoundException(['code' => -3, 'message' => 'parent_email existe']);
        }
        return $parent;
    }

    public function getparent($id)
    {
        $parent = UserParent::firstWhere('id', $id);
        if (is_null($parent)) {
            throw new NotFoundException(['code' => -1, 'messege' => 'parent not found']);
        }
        return $parent;
    }
}
