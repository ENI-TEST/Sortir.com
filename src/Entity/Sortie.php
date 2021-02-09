<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Donnez au moins un nom à votre sortie..!")
     * @Assert\Length(max="30", maxMessage="Le nom ne doit pas excéder 30 caractères")
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionsMax;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $descriptionInfos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etatSortie;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $urlPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="sorties")
     */
    protected $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="sorties")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="sorties")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="sortie", cascade={"remove"})
     */
    private $inscriptions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="sorties")
     */
    private $lieu;





    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
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

    public function getDateDebut(): ?DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateCloture(): ?DateTimeInterface
    {
        return $this->dateCloture;
    }

    public function setDateCloture(DateTimeInterface $dateCloture): self
    {
        $this->dateCloture = $dateCloture;

        return $this;
    }

    public function getNbInscriptionsMax(): ?int
    {
        return $this->nbInscriptionsMax;
    }

    public function setNbInscriptionsMax(int $nbInscriptionsMax): self
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->descriptionInfos;
    }

    public function setDescriptionInfos(?string $descriptionInfos): self
    {
        $this->descriptionInfos = $descriptionInfos;

        return $this;
    }

    public function getEtatSortie(): ?int
    {
        return $this->etatSortie;
    }

    public function setEtatSortie(int $etatSortie): self
    {
        $this->etatSortie = $etatSortie;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->urlPhoto;
    }

    public function setUrlPhoto(?string $urlPhoto): self
    {
        $this->urlPhoto = $urlPhoto;

        return $this;
    }

    public function getOrganisateur()//: ?int
    {
        return $this->organisateur;
    }

    public function setOrganisateur($organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    public function setInscriptions($inscriptions): void
    {
        $this->inscriptions = $inscriptions;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu): void
    {
        $this->lieu = $lieu;
    }

    public function checkIfInscrit(Participant $p): bool
    {
        return $this->inscriptions->exists(function($key, $inscription) use($p)
        {
            return ($inscription->getParticipant() == $p);
        });
    }

}
