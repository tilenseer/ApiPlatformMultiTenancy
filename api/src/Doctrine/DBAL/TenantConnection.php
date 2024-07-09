<?php

namespace App\Doctrine\DBAL;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class TenantConnection extends Connection
{
    /**
     * @throws Exception
     */
    public function connectToDB(string $user, string $password, string $tenant): void
    {
        $this->close();

        $params = $this->getParams();

        $params['user'] = $user;
        $params['password'] = $password;
        $params['dbname'] = $tenant;

        $this->__construct($params, $this->getDriver(), $this->getConfiguration(), $this->getEventManager());
    }
}
