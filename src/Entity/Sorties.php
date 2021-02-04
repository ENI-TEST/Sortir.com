<?php

namespace App\Entity;

use App\Repository\SortiesRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SortiesRepository::class)
 */
class Sorties
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
    private $date_debut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_cloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_inscriptions_max;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description_infos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etat_sortie;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $url_photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="sorties")
     */
    protected $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="sorties")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etats", inversedBy="sorties")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscriptions", mappedBy="sortie")
     */
    private $inscriptions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieux", inversedBy="sorties")
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
        return $this->date_debut;
    }

    public function setDateDebut(DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

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
        return $this->date_cloture;
    }

    public function setDateCloture(DateTimeInterface $date_cloture): self
    {
        $this->date_cloture = $date_cloture;

        return $this;
    }

    public function getNbInscriptionsMax(): ?int
    {
        return $this->nb_inscriptions_max;
    }

    public function setNbInscriptionsMax(int $nb_inscriptions_max): self
    {
        $this->nb_inscriptions_max = $nb_inscriptions_max;

        return $this;
    }

    public function getDescriptionInfos(): ?string
    {
        return $this->description_infos;
    }

    public function setDescriptionInfos(?string $description_infos): self
    {
        $this->description_infos = $description_infos;

        return $this;
    }

    public function getEtatSortie(): ?int
    {
        return $this->etat_sortie;
    }

    public function setEtatSortie(int $etat_sortie): self
    {
        $this->etat_sortie = $etat_sortie;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(?string $url_photo): self
    {
        $this->url_photo = $url_photo;

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

    /**
     * @return ArrayCollection
     */
    public function getInscriptions(): ArrayCollection
    {
        return $this->inscriptions;
    }

    /**
     * @param ArrayCollection $inscriptions
     */
    public function setInscriptions(ArrayCollection $inscriptions): void
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



}
