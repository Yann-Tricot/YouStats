<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int
     *
     * @ORM\Column(name="tag_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tagId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=1000, nullable=true, options={"default"="NULL"})
   #  * @ORM\Column(name="name", type="string", length=1000, nullable=true, options={"default"="NULL"})
     */
    private $name = 'NULL';
    #private $name = 'NULL';

    public function getTagId(){
        return $this->tagId;
    }

    public function getTagName(){
        return $this->name;
    }
}