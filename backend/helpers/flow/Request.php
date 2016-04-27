<?php

namespace backend\helpers\flow;

use Yii;

class Request implements RequestInterface
{

    public function __construct(){}


    /**
     * Get uploaded file name
     *
     * @return string|null
     */
    public function getFileName()
    {
        return Yii::$app->request->getBodyParam("flowFilename");
    }

    /**
     * Get total file size in bytes
     *
     * @return int|null
     */
    public function getTotalSize()
    {
        return Yii::$app->request->getBodyParam("flowTotalSize");
    }

    /**
     * Get file unique identifier
     *
     * @return string|null
     */
    public function getIdentifier()
    {
        return Yii::$app->request->getBodyParam("flowIdentifier");
    }

    /**
     * Get file relative path
     *
     * @return string|null
     */
    public function getRelativePath()
    {
        return Yii::$app->request->getBodyParam("flowRelativePath");
    }

    /**
     * Get total chunks number
     *
     * @return int|null
     */
    public function getTotalChunks()
    {
        return Yii::$app->request->getBodyParam("flowTotalChunks");
    }

    /**
     * Get default chunk size
     *
     * @return int|null
     */
    public function getDefaultChunkSize()
    {
        return Yii::$app->request->getBodyParam("flowChunkSize");
    }

    /**
     * Get current uploaded chunk number, starts with 1
     *
     * @return int|null
     */
    public function getCurrentChunkNumber()
    {
        return Yii::$app->request->getBodyParam("flowChunkNumber");
    }

    /**
     * Get current uploaded chunk size
     *
     * @return int|null
     */
    public function getCurrentChunkSize()
    {
        return Yii::$app->request->getBodyParam("flowCurrentChunkSize");
    }

    /**
     * Return $_FILES request
     *
     * @return array|null
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Checks if request is formed by fusty flow
     *
     * @return bool
     */
    public function isFustyFlowRequest()
    {
        return false;
    }
}
