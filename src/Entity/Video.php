<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Cocur\Slugify\Slugify;


/**
 * Video
 *
 * @ORM\Table(name="VIDEO")
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
{
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="video_id", type="string", length=80, nullable=false)
     */
    private $videoId;

    /**
     *
     * @ORM\Column(name="duration", type="string", length=80, nullable=false)
     */
    private $duration;

    /**
     *
     * @ORM\Column(name="title_video", type="string", length=100, nullable=true)
     */
    private $titleVideo;

    /**
     *
     * @ORM\Column(name="published_date", type="date", nullable=true)
     #* @ORM\Column(name="published_date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $publishedDate;

    /**
     *
     * @ORM\Column(name="count_like", type="integer", nullable=true)
     #* @ORM\Column(name="count_like", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $countLike;

    /**
     *
     * @ORM\Column(name="count_dislike", type="integer", nullable=true)
     #* @ORM\Column(name="count_dislike", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $countDislike;

    /**
     *
     * @ORM\Column(name="count_comment", type="integer", nullable=true)
     */
    private $countComment;
    /**
     *
     * @ORM\Column(name="classement", type="integer", nullable=true)
     */
    private $classement;

    /**
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     #* @ORM\Column(name="category_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $categoryId;

    /**
     *
     * @ORM\Column(name="trending_date", type="date", nullable=true)
     #* @ORM\Column(name="trending_date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $trendingDate;

    /**
     *
     * @ORM\Column(name="miniature_link", type="string", length=50, nullable=true)
     #* @ORM\Column(name="miniature_link", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $miniatureLink;
    #private $miniatureLink = 'NULL';

    /**
     *
     * @ORM\Column(name="miniature_link_hd", type="string", length=50, nullable=true)
     #* @ORM\Column(name="miniature_link_hd", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $miniatureLinkHd;	
    #private $miniatureLinkHd = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="tag_id", type="integer", nullable=true)
     #* @ORM\Column(name="tag_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $tagId;
    #private $tagId = 'NULL';

    /**
     *
     * @ORM\Column(name="channel_id", type="string", length=50, nullable=true)
     #* @ORM\Column(name="channel_id", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $channelId;
    #private $channelId = 'NULL';

    /**
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     #* @ORM\Column(name="country", type="string", length=2, nullable=true, options={"default"="NULL"})
     */
    private $country;
    #private $country = 'NULL';


    public function getSlug()
    {
        return (new Slugify())->slugify($this->videoId);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getVidTagId(){
        return $this->tagId;
    }
    public function getVidCountry(){
        return $this->country;
    }
    public function getVidChannelId(){
        return $this->channelId;
    }
    public function getVidCategoryId(){
        return $this->categoryId;
    }
    public function getVidCommentCount(){
        return $this->countComment;
    }
    public function getVidDislikeCount(){
        return $this->countDislike;
    }
    public function getVidLikeCount(){
        return $this->countLike;
    }
    public function getVidPublishDate(){
        return $this->publishedDate;
    }
    public function getVidTitle(){
        return $this->titleVideo;
    }
    public function getVidId(){
        return $this->videoId;
    }
    public function getVidTrendingDate(){
        return $this->trendingDate;
    }

    public function getMiniatureLink(){
        return $this->miniatureLink;
    }

}
