<?php

namespace App\Entity;

use App\Entity\EntityInterface\FileAttachableInterface;
use App\Entity\EntityInterface\FileAttachableTrait;
use App\Repository\AboutSectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AboutSectionRepository::class)
 */
class AboutSection implements FileAttachableInterface
{
    use FileAttachableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=IconSection::class, cascade={"persist", "remove"})
     */
    private $iconSections;

    /**
     * @ORM\OneToOne(targetEntity=FileUploaded::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $file;

    public function __construct()
    {
        $this->iconSections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|IconSection[]
     */
    public function getIconSections(): Collection
    {
        return $this->iconSections;
    }

    public function addIconSection(IconSection $iconSection): self
    {
        if (!$this->iconSections->contains($iconSection)) {
            $this->iconSections[] = $iconSection;
        }

        return $this;
    }

    public function removeIconSection(IconSection $iconSection): self
    {
        $this->iconSections->removeElement($iconSection);

        return $this;
    }

    public function getFile(): ?FileUploaded
    {
        return $this->file;
    }

    public function setFile(FileUploaded $file): self
    {
        $this->file = $file;

        return $this;
    }
}
