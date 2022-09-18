<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Task Entity
 * 
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "ipartial"})
 * @ORM\Entity(repositoryClass=App\Repository\TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @Groups({"read"})
     * @ORM\Column(type="string", length=255)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $deadline;

    /**
     * @ORM\ManyToOne(targetEntity=Employee::class, inversedBy="tasks")
     */
    private ?Employee $employee;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * Get id of task
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get name of task
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name of task
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description of task
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description of task
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get date of task creation
     *
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set date of task creation
     *
     * @param \DateTimeInterface $createAt
     * @return self
     */
    public function setCreatedAt(\DateTimeInterface $createAt): self
    {
        $this->createdAt = $createAt;

        return $this;
    }

    /**
     * Get the deadline date
     *
     * @return \DateTimeInterface|null
     */
    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    /**
     * Set the deadline date
     *
     * @param \DateTimeInterface $deadline
     * @return self
     */
    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
