<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommuneFrance
 *
 * @ORM\Table(name="commune_france")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommuneFranceRepository")
 */
class CommuneFrance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EU_circo", type="string", length=255, nullable=true)
     */
    private $eUCirco = null;

    /**
     * @var int
     *
     * @ORM\Column(name="code_region", type="integer", nullable=true)
     */
    private $codeRegion= null;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_region", type="string", length=255, nullable=true)
     */
    private $nomRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="chef_lieu_region", type="string", length=255, nullable=true)
     */
    private $chefLieuRegion= null ;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_departement", type="string", length=255, nullable=true)
     */
    private $numeroDepartement= null;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_departement", type="string", length=255, nullable=true)
     */
    private $nomDepartement= null;

    /**
     * @var string
     *
     * @ORM\Column(name="prefecture", type="string", length=255, nullable=true)
     */
    private $prefecture= null;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_circonscription", type="float", nullable=true)
     */
    private $numeroCirconscription= null;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_commune", type="string", length=255, nullable=true)
     */
    private $nomCommune;

    /**
     * @var int
     *
     * @ORM\Column(name="codes_postaux", type="string", length=255, nullable=true)
     */
    private $codesPostaux= null;

    /**
     * @var int
     *
     * @ORM\Column(name="code_insee", type="float", nullable=true)
     */
    private $codeInsee= null;

    /**
     * @var int
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude= null;

    /**
     * @var int
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude= null;

    /**
     * @var int
     *
     * @ORM\Column(name="eloignement",  type="string", length=255, nullable=true)
     */
    private $eloignement= null;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eUCirco
     *
     * @param string $eUCirco
     *
     * @return CommuneFrance
     */
    public function setEUCirco($eUCirco)
    {
        $this->eUCirco = $eUCirco;

        return $this;
    }

    /**
     * Get eUCirco
     *
     * @return string
     */
    public function getEUCirco()
    {
        return $this->eUCirco;
    }

    /**
     * Set codeRegion
     *
     * @param integer $codeRegion
     *
     * @return CommuneFrance
     */
    public function setCodeRegion($codeRegion)
    {
        $this->codeRegion = $codeRegion;

        return $this;
    }

    /**
     * Get codeRegion
     *
     * @return int
     */
    public function getCodeRegion()
    {
        return $this->codeRegion;
    }

    /**
     * Set nomRegion
     *
     * @param string $nomRegion
     *
     * @return CommuneFrance
     */
    public function setNomRegion($nomRegion)
    {
        $this->nomRegion = $nomRegion;

        return $this;
    }

    /**
     * Get nomRegion
     *
     * @return string
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }

    /**
     * Set chefLieuRegion
     *
     * @param string $chefLieuRegion
     *
     * @return CommuneFrance
     */
    public function setChefLieuRegion($chefLieuRegion)
    {
        $this->chefLieuRegion = $chefLieuRegion;

        return $this;
    }

    /**
     * Get chefLieuRegion
     *
     * @return string
     */
    public function getChefLieuRegion()
    {
        return $this->chefLieuRegion;
    }

    /**
     * Set numeroDepartement
     *
     * @param integer $numeroDepartement
     *
     * @return CommuneFrance
     */
    public function setNumeroDepartement($numeroDepartement)
    {
        $this->numeroDepartement = $numeroDepartement;

        return $this;
    }

    /**
     * Get numeroDepartement
     *
     * @return int
     */
    public function getNumeroDepartement()
    {
        return $this->numeroDepartement;
    }

    /**
     * Set nomDepartement
     *
     * @param string $nomDepartement
     *
     * @return CommuneFrance
     */
    public function setNomDepartement($nomDepartement)
    {
        $this->nomDepartement = $nomDepartement;

        return $this;
    }

    /**
     * Get nomDepartement
     *
     * @return string
     */
    public function getNomDepartement()
    {
        return $this->nomDepartement;
    }

    /**
     * Set prefecture
     *
     * @param string $prefecture
     *
     * @return CommuneFrance
     */
    public function setPrefecture($prefecture)
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    /**
     * Get prefecture
     *
     * @return string
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * Set numeroCirconscription
     *
     * @param integer $numeroCirconscription
     *
     * @return CommuneFrance
     */
    public function setNumeroCirconscription($numeroCirconscription)
    {
        $this->numeroCirconscription = $numeroCirconscription;

        return $this;
    }

    /**
     * Get numeroCirconscription
     *
     * @return int
     */
    public function getNumeroCirconscription()
    {
        return $this->numeroCirconscription;
    }

    /**
     * Set nomCommune
     *
     * @param string $nomCommune
     *
     * @return CommuneFrance
     */
    public function setNomCommune($nomCommune)
    {
        $this->nomCommune = $nomCommune;

        return $this;
    }

    /**
     * Get nomCommune
     *
     * @return string
     */
    public function getNomCommune()
    {
        return $this->nomCommune;
    }

    /**
     * Set codesPostaux
     *
     * @param integer $codesPostaux
     *
     * @return CommuneFrance
     */
    public function setCodesPostaux($codesPostaux)
    {
        $this->codesPostaux = $codesPostaux;

        return $this;
    }

    /**
     * Get codesPostaux
     *
     * @return int
     */
    public function getCodesPostaux()
    {
        return $this->codesPostaux;
    }

    /**
     * Set codeInsee
     *
     * @param integer $codeInsee
     *
     * @return CommuneFrance
     */
    public function setCodeInsee($codeInsee)
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    /**
     * Get codeInsee
     *
     * @return int
     */
    public function getCodeInsee()
    {
        return $this->codeInsee;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     *
     * @return CommuneFrance
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return int
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param integer $longitude
     *
     * @return CommuneFrance
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set eloignement
     *
     * @param integer $eloignement
     *
     * @return CommuneFrance
     */
    public function seteloignement($eloignement)
    {
        $this->eloignement = $eloignement;

        return $this;
    }

    /**
     * Get eloignement
     *
     * @return int
     */
    public function geteloignement()
    {
        return $this->eloignement;
    }
}

