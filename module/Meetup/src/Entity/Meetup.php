<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Film
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $dateStart = '';

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $dateEnd = '';


    public function __construct(string $title, string $description = '')
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;

    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

     public function getDateStart() : date
    {
        return $this->dateStart;
    }

    public function setDateStart(date $dateStart) : void
    {
        $this->dateStart = $dateStart;
    }

     public function getDateEnd() : date
    {
        return $this->dateEnd;
    }

    public function setDateEnd(date $dateEnd) : void
    {
        $this->dateEnd = $dateEnd;
    }

}
