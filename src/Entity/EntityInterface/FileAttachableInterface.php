<?php

namespace App\Entity\EntityInterface;

use App\Entity\FileUploaded;

interface FileAttachableInterface{

    public function setFile( FileUploaded $fileUploaded ):self;

    public function getFile():?FileUploaded;

    public function removeFile():self;

}
