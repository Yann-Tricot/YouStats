<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videos
 *
 * @ORM\Table(name="videos")
 * @ORM\Entity
 */
class Videos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=200, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @var int
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     */
    private $channelId;


    public function getId(): ?int{
        return $this->id;
    }

    public function getCategoryId(): ?int{
        return $this->categoryId;
    }

    public function getCountry(): ?string{
        return $this->country;
    }

    public function getTitle(): ?int{
        return $this->title;
    }

    public function getChannelId(): ?int{
        return $this->channelId;
    }

}
