<?php

namespace Eutranet\Corporate\Repository\Eloquent;

use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Repository\BaseRepository;
use Eutranet\Setup\Models\StaffMember;
use Eutranet\Setup\Exceptions\MoreThanOneSuperStaffException;

class StaffMemberRepository extends BaseRepository
{
    /**
     * Agency Repository constructor
     *
     * @param StaffMember $model
     */

    #[Pure] public function __construct(StaffMember $model)
    {
        parent::__construct($model);
    }

    /**
     *Throw an error if there is more than one super admin in the DB
     */
    public function countSuperStaff()
    {
        if ($this->model->where('is_staff', true)->get()->count() > 1) {
            throw new MoreThanOneSuperStaffException($this->model->where('is_super', true)->get()->count());
        }
    }
}
