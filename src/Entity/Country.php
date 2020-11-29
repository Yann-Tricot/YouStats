<?php


namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 *Country
 * @ORM\Table(name="COUNTRY")
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     *
     * @ORM\Column(name="country_id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $countryId;

    /**
     *
     * @ORM\Column(name="country_name", type="string", length=80, nullable=false)
     */
    private $countryName;


    public function getSlug()
    {
        return (new Slugify())->slugify($this->countryId);
    }

    public function getId()
    {
        return $this->countryId;
    }

    public function getName()
    {
        return $this->countryName;
    }

}