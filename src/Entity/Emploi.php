<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmploiRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=EmploiRepository::class)
 * @Vich\Uploadable
 */
class Emploi
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
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typedecontrat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mission;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prerequis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryEmploi::class, inversedBy="emplois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=EmploiLike::class, mappedBy="emploi", cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emplois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $clics;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $candidatures;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totallike;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $evaluation;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="evaluation")
     * @var File
     */
    private $evaluationFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hm;


    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getTypedecontrat(): ?string
    {
        return $this->typedecontrat;
    }

    public function setTypedecontrat(string $typedecontrat): self
    {
        $this->typedecontrat = $typedecontrat;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): self
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getOrganisme(): ?string
    {
        return $this->organisme;
    }

    public function setOrganisme(string $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getCategory(): ?CategoryEmploi
    {
        return $this->category;
    }

    public function setCategory(?CategoryEmploi $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // if ($image) {
        //     $this->updatedAt = new \DateTime('now');
        // }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }


    public function setImage($image)
    {
        $this->image = $image;

    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setEvaluationFile(File $evaluation = null)
    {
        $this->evaluationFile = $evaluation;

        // if ($evaluation) {
        //     $this->updatedAt = new \DateTime('now');
        // }
    }

    public function getEvaluationFile()
    {
        return $this->evaluationFile;
    }

    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }


    /**
     * @return Collection|EmploiLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(EmploiLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setEmploi($this);
        }

        return $this;
    }

    public function removeLike(EmploiLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getEmploi() === $this) {
                $like->setEmploi(null);
            }
        }

        return $this;
    }

    /**
     * Formation liké
     *
     * @param User $user
     * @return boolean
     */
    public function isLikeByUser(User $user) : bool {
        foreach($this->likes as $like) {
            if ($like->getUser() === $user) return true;
        }
        return false;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getClics(): ?int
    {
        return $this->clics;
    }

    public function setClics(?int $clics): self
    {
        $this->clics = $clics;

        return $this;
    }

    public function getCandidatures(): ?int
    {
        return $this->candidatures;
    }

    public function setCandidatures(?int $candidatures): self
    {
        $this->candidatures = $candidatures;

        return $this;
    }

    public function getTotallike(): ?int
    {
        return $this->totallike;
    }

    public function setTotallike(?int $totallike): self
    {
        $this->totallike = $totallike;

        return $this;
    }

    public function getHm(): ?string
    {
        return $this->hm;
    }

    public function setHm(?string $hm): self
    {
        $this->hm = $hm;

        return $this;
    }


}
