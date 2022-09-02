<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Employee entity
 * 
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "patch", "delete"}
 * )
 * @ORM\Entity(repositoryClass=App\Repository\EmployeeRepository::class)
 */
class Employee
{
    /**
     * @var integer|null $id Id of employee
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private ?string $surname;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $salary;

    /**
     * @ORM\Column(type="date")
     */
    private ?\DateTimeInterface $birthdate;

    /**
     * @var Collection<int, Task> All task assigned to this employee
     * 
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="employee")
     */
    private iterable $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }


    /**
     * Get id of employee
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get name of employee
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name of employee
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
     * Get surname of employee
     *
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Set surname of employee
     *
     * @param string $surname
     * @return self
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get salary of employee
     *
     * @return float|null
     */
    public function getSalary(): ?float
    {
        return $this->salary;
    }

    /**
     * Set salary of employee
     *
     * @param float $salary
     * @return self
     */
    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get birthdate of employee
     *
     * @return \DateTimeInterface|null
     */
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    /**
     * Set birthdate of employe
     *
     * @param \DateTimeInterface $birthdate
     * @return self
     */
    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setEmployee($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getEmployee() === $this) {
                $task->setEmployee(null);
            }
        }

        return $this;
    }
}
