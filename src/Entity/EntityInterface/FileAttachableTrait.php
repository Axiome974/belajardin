<?php


namespace App\Entity\EntityInterface;

use App\Entity\FileUploaded;
use Doctrine\ORM\Mapping as ORM;

trait FileAttachableTrait{

    /**
     * @var FileUploaded
     * @ORM\OneToOne(targetEntity=FileUploaded::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $file;

    public function getFile(): ?FileUploaded
    {
        return $this->file;
    }

    public function setFile(FileUploaded $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function removeFile():self
    {
        $this->file = null;
        return $this;
    }

}
