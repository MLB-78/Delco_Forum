<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReponsesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ReponsesRepository::class)
 */
class Reponses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le message ne peut pas être vide")
     */
    private $messageR;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reponse")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="reponse")
     * @ORM\JoinColumn(name="questions_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateN;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
        $this->dateN = new \DateTime('now', new \DateTimeZone('Europe/Paris')); // Set default value to current date in Paris timezone
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageR(): ?string
    {
        return $this->messageR;
    }

    public function setMessageR(string $messageR): self
    {
        $this->messageR = $messageR;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): self
    {
        $this->question = $question;
        return $this;
    }
    public function getDateN(): ?\DateTimeInterface
    {
        return $this->dateN;
    }

    public function setDateN(\DateTimeInterface $dateN): self
    {
        $this->dateN = $dateN;

        return $this;
    }
}
