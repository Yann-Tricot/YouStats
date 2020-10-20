<?php



namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;



/**

 * Video

 *

 * @ORM\Table(name="video")

 * @ORM\Entity(repositoryClass="YouStats\src\Repository\ChannelRepository")

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

     * @ORM\Column(name="title_video", type="string", length=100, nullable=true)

    # @ORM\Column(name="title_video", type="string", length=100, nullable=true, options={"default"="NULL"})

     */

    #private $titleVideo = 'NULL';

    private $titleVideo;



    /**

     *

     * @ORM\Column(name="published_date", type="date", nullable=true)

    #* @ORM\Column(name="published_date", type="date", nullable=true, options={"default"="NULL"})

     */

    private $publishedDate;

    #private $publishedDate = 'NULL';



    /**

     *

     * @ORM\Column(name="count_like", type="integer", nullable=true)

    #* @ORM\Column(name="count_like", type="integer", nullable=true, options={"default"="NULL"})

     */

    private $countLike;

    #private $countLike = 'NULL';



    /**

     *

     * @ORM\Column(name="count_dislike", type="integer", nullable=true)

    #* @ORM\Column(name="count_dislike", type="integer", nullable=true, options={"default"="NULL"})

     */

    private $countDislike;

    #private $countDislike = 'NULL';



    /**

     *

     * @ORM\Column(name="count_comment", type="integer", nullable=true)

    #* @ORM\Column(name="count_comment", type="integer", nullable=true, options={"default"="NULL"})

     */

    private $countComment;

    #private $countComment = 'NULL';



    /**

     *

     * @ORM\Column(name="category_id", type="integer", nullable=true)

    #* @ORM\Column(name="category_id", type="integer", nullable=true, options={"default"="NULL"})

     */

    private $categoryId;

    #private $categoryId = 'NULL';



    /**

     *

     * @ORM\Column(name="trending_date", type="date", nullable=true)

    #* @ORM\Column(name="trending_date", type="date", nullable=true, options={"default"="NULL"})

     */

    private $trendingDate;

    #private $trendingDate = 'NULL';



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


    /**

     *

     * @ORM\Column(name="count_view", type="int", length=11, nullable=true)

    #* @ORM\Column(name="count_view", type="int", length=11, nullable=true, options={"default"="NULL"})

     */
    private $count_view;

    /**
     * @return mixed
     */
    public function getCountView()
    {
        return $this->count_view;
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

    public function getMiniatureLinkHD(){

        return $this->miniatureLinkHd;

    }



}