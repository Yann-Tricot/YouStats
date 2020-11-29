<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 *
 * @ORM\Table(name="CHANNEL")
 * @ORM\Entity(repositoryClass="App\Repository\ChannelRepository")
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

    private $channelName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="country_id", type="string", length=50, nullable=true)
     */
    private $countryId;


    public function getSlug()
    {
        $slug = (new Slugify())->slugify($this->channelName);
    }

    public function getChannelCountryID(){
        return $this->countryId;
    }

    public function getChannelId(){
        return $this->channelId;
    }

    public function getChannelName(){
        return $this->channelName;
    }

}
