<?php

namespace Eutranet\Corporate\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use JetBrains\PhpStorm\Pure;
use Eutranet\Corporate\Models\CorporateGeneralTerm;

class CorporateGeneralTermRepository extends BaseRepository
{
    /**
     * Gneral termr Repository constructor..
     *
     * @param CorporateGeneralTerm $model
     */

    #[Pure] public function __construct(CorporateGeneralTerm $model)
    {
        parent::__construct($model);
    }
}
