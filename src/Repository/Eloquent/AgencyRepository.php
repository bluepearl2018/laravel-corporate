<?php

namespace Eutranet\Corporate\Repository\Eloquent;

use JetBrains\PhpStorm\Pure;
use Eutranet\Corporate\Models\Agency;
use Eutranet\Setup\Repository\BaseRepository;
use Eutranet\Setup\Repository\EloquentRepositoryInterface;

class AgencyRepository extends BaseRepository implements EloquentRepositoryInterface
{
    /**
     * Agency Repository constructor
     *
     * @param Agency $model
     */

    #[Pure] public function __construct(Agency $model)
    {
        parent::__construct($model);
    }
}
