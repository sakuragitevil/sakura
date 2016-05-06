<?php
Yii::setAlias("@avatarUrl", ".." . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . "avatars");
Yii::setAlias("@avatarTempUrl", ".." . DIRECTORY_SEPARATOR . "web" . DIRECTORY_SEPARATOR . "avatars" . DIRECTORY_SEPARATOR . "temps");

Yii::setAlias("@avatarPath", "upload" . DIRECTORY_SEPARATOR . "avatars");
Yii::setAlias("@avatarWebPath", "web" . DIRECTORY_SEPARATOR . "avatars");
Yii::setAlias("@avatarTempPath", "web" . DIRECTORY_SEPARATOR . "avatars" . DIRECTORY_SEPARATOR . "temps");

Yii::setAlias("@documentPath", "upload" . DIRECTORY_SEPARATOR . "documents");
Yii::setAlias("@chunksTempPath", "upload" . DIRECTORY_SEPARATOR . "chunks_temp_folder");