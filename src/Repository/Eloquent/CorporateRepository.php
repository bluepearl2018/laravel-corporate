<?php

namespace Eutranet\Corporate\Repository\Eloquent;

use JetBrains\PhpStorm\Pure;
use Eutranet\Corporate\Models\Corporate;
use Eutranet\Setup\Repository\BaseRepository;

class CorporateRepository extends BaseRepository
{
    /**
     * Cororate Repository constructor
     *
     * @param Corporate $model
     */

    #[Pure] public function __construct(Corporate $model)
    {
        parent::__construct($model);
    }
}
