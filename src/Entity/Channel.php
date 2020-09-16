<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity
 */
class Channel
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
     * @var int
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
     */
    private $channelId;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_name", type="string", length=200, nullable=false)
     */
    private $channelName;

    public function getId(): ?int{
        return $this->id;
    }

    public function getChannelName(): ?string{
        return $this->channelName;
    }

    public function getChannelId(): ?int{
        return $this->channelId;
    }

}
