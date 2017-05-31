<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Solution
 *
 * @ORM\Table(name="solutions")
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\SolutionRepository")
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class Solution
{
    /**
     * Primary key
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(length=40)
     * @Assert\NotBlank
     *
     * @var string name
     */
    private $name;

//    /**
//     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
//     *
//     * @var Media image
//     */
//    private $image;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Solution
     */
    public function setName(string $name):Solution
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName():?string
    {
        return $this->name;
    }

//    /**
//     * Set image
//     *
//     * @param Media $image
//     * @return Solution
//     */
//    public function setImage(Media $image = null):Solution
//    {
//        $this->image = $image;
//
//        return $this;
//    }
//
//    /**
//     * Get image
//     *
//     * @return Media
//     */
//    public function getImage():?Media
//    {
//        return $this->image;
//    }

    public function __toString():string
    {
        return $this->getName() ? : "New Solution";
    }
}
