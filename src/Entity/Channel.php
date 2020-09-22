<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 *
 * @ORM\Table(name="channel")
 * @ORM\Entity(repositoryClass="YouStats\src\Repository\ChannelRepository")
 */
class Channel
{
    /**
     * @var string
     *
     * @ORM\Column(name="channel_id", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $channelId;

    /**
     * @var string|null
     *
    #@ORM\Column(name="channel_name", type="string", length=50, nullable=true, options={"default"="NULL"})
     * @ORM\Column(name="channel_name", type="string", length=50, nullable=true)
     */
  #  private $channelName = 'NULL';
    private $channelName;

    public function getChannelId(){
        return $this->channelId;
    }

    public function getChannelName(){
        return $this->channelName;
    }

}
