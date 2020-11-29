<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="CATEGORY")
 */

 //@ORM\Entity(repositoryClass="App\Repository\CategoryRepository")

class Category
{
    /**
     *
     * @ORM\Column(name="category_id", type="string", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     *
     * @ORM\Column(name="cateory_name", type="string", length=80, nullable=false)
     */
    private $categoryName;


    public function getSlug()
    {
        return (new Slugify())->slugify($this->categoryName);
    }

    public function getId()
    {
        return $this->categoryId;
    }

    public function getName()
    {
        return $this->categoryName;
    }


}