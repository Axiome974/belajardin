<?php


namespace App\Entity\EntityInterface;

trait FileAttachableTrait{


    public function removeFile():self
    {
        $this->file = null;
        return $this;
    }

}
