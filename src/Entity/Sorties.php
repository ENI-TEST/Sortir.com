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
    private $organisateur;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDateDebut($date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDateCloture()
    {
        return $this->date_cloture;
    }

    /**
     * @param mixed $date_cloture
     */
    public function setDateCloture($date_cloture): void
    {
        $this->date_cloture = $date_cloture;
    }

    /**
     * @return mixed
     */
    public function getNbInscriptionsMax()
    {
        return $this->nb_inscriptions_max;
    }

    /**
     * @param mixed $nb_inscriptions_max
     */
    public function setNbInscriptionsMax($nb_inscriptions_max): void
    {
        $this->nb_inscriptions_max = $nb_inscriptions_max;
    }

    /**
     * @return mixed
     */
    public function getDescriptionInfos()
    {
        return $this->description_infos;
    }

    /**
     * @param mixed $description_infos
     */
    public function setDescriptionInfos($description_infos): void
    {
        $this->description_infos = $description_infos;
    }

    /**
     * @return mixed
     */
    public function getEtatSortie()
    {
        return $this->etat_sortie;
    }

    /**
     * @param mixed $etat_sortie
     */
    public function setEtatSortie($etat_sortie): void
    {
        $this->etat_sortie = $etat_sortie;
    }

    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->url_photo;
    }

    /**
     * @param mixed $url_photo
     */
    public function setUrlPhoto($url_photo): void
    {
        $this->url_photo = $url_photo;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
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
