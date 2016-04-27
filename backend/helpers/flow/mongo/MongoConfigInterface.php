<?php

namespace backend\helpers\mongo;

use backend\helpers\ConfigInterface;

/**
 * @codeCoverageIgnore
 */
interface MongoConfigInterface extends ConfigInterface
{

    /**
     * @return \MongoGridFS
     */
    public function getGridFs();

}