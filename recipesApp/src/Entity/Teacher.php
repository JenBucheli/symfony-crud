<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 */
class Teacher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\OneToMany(targetEntity=Classroom::class, mappedBy="teacher")
     */
    private $LastName;

    public function __construct()
    {
        $this->LastName = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    /**
     * @return Collection|Classroom[]
     */
    public function getLastName(): Collection
    {
        return $this->LastName;
    }

    public function addLastName(Classroom $lastName): self
    {
        if (!$this->LastName->contains($lastName)) {
            $this->LastName[] = $lastName;
            $lastName->setTeacher($this);
        }

        return $this;
    }

    public function removeLastName(Classroom $lastName): self
    {
        if ($this->LastName->removeElement($lastName)) {
            // set the owning side to null (unless already changed)
            if ($lastName->getTeacher() === $this) {
                $lastName->setTeacher(null);
            }
        }

        return $this;
    }
}
