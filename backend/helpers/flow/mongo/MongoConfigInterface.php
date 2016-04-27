<?php

namespace backend\helpers\flow\mongo;

use backend\helpers\flow\ConfigInterface;

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