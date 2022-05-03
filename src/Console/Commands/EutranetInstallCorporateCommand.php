<?php

namespace Eutranet\Corporate\Console\Commands;

use Eutranet\Init\Console\Commands\InstallPackageCommand;

class EutranetInstallCorporateCommand extends InstallPackageCommand
{
    public function __construct()
    {
        $this->signature = 'eutranet:install-corporate';
        parent::__construct('corporate', 'eutranet:install-corporate');
    }
}
