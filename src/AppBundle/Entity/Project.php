<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="projects",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="name_idx",columns={"name"})})
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\ProjectRepository")
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class Project extends AdminEntity
{


    /**
     * @ORM\Column(length=20)
     * @Assert\NotBlank
     *
     * @var string name
     */
    private $name;

    /**
     * @ORM\Column(length=40, name="full_name", nullable=true)
     *
     * @var string name
     */
    private $fullName;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string description
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true, name="work_description")
     *
     * @var string description
     */
    private $workDescription;

    /**
     * @ORM\Column(type="text", nullable=true, name="my_role")
     *
     * @var string challenge
     */
    private $myRole;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string challenge
     */
    private $challenge;

    /**
     * @ORM\Column(type="smallint", options={"default":0})
     *
     * @var integer weight
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     *
     * @var bool status
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="Solution")
     *
     * @var ArrayCollection
     */
    private $solutions;

    /**
     * @ORM\Column(type="boolean", name="display_on_home_page", options={"default":0})
     *
     * @var bool status
     */
    private $displayOnHome;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\FileStorage")
     *
     * @var FileStorage
     */
    private $imageTemplate;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\FileStorage")
     *
     * @var FileStorage
     */
    private $imageLogo;

    public function __construct()
    {
        $this->solutions     = new ArrayCollection();
        $this->weight        = 0;
        $this->status        = false;
        $this->displayOnHome = false;
    }

    /**
     * @return string|null
     */
    public function getFullName():?string
    {
        return $this->fullName;
    }


    /**
     * @param string $fullName
     * @return $this
     */
    public function setFullName(string $fullName):Project
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorkDescription():?string
    {
        return $this->workDescription;
    }


    /**
     * @param string $workDescription
     * @return $this
     */
    public function setWorkDescription(string $workDescription):Project
    {
        $this->workDescription = $workDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMyRole():?string
    {
        return $this->myRole;
    }


    /**
     * @param string $myRole
     * @return $this
     */
    public function setMyRole(string $myRole):Project
    {
        $this->myRole = $myRole;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name):Project
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName():?string
    {
        return $this->name;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description):Project
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription():?string
    {
        return $this->description;
    }

    /**
     * @param string $challenge
     *
     * @return $this
     */
    public function setChallenge(string $challenge):Project
    {
        $this->challenge = $challenge;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChallenge():?string
    {
        return $this->challenge;
    }

    /**
     * @param integer $weight
     *
     * @return $this
     */
    public function setWeight(int $weight):Project
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight():int
    {
        return $this->weight;
    }

    /**
     * @param boolean $status
     * @return $this
     */
    public function setStatus(bool $status):Project
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getStatus():bool
    {
        return $this->status;
    }

    /**
     * @param Solution $solutions
     *
     * @return $this
     */
    public function addSolution(Solution $solutions):Project
    {
        if (!$this->solutions->contains($solutions)) {
            $this->solutions->add($solutions);
        }

        return $this;
    }

    /**
     * @param Solution $solutions
     *
     * @return $this
     */
    public function removeSolution(Solution $solutions):Project
    {
        $this->solutions->removeElement($solutions);

        return $this;
    }

    /**
     * @return ArrayCollection|Solution[]
     */
    public function getSolutions(): ArrayCollection
    {
        return $this->solutions;
    }

    /**
     * @param boolean $displayOnHome
     *
     * @return $this
     */
    public function setDisplayOnHome(bool $displayOnHome):Project
    {
        $this->displayOnHome = $displayOnHome;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDisplayOnHome():bool
    {
        return $this->displayOnHome;
    }

    /**
     * @return FileStorage
     */
    public function getImageTemplate(): ?FileStorage
    {
        return $this->imageTemplate;
    }

    /**
     * @param FileStorage $imageTemplate
     *
     * @return $this
     */
    public function setImageTemplate(FileStorage $imageTemplate)
    {
        $this->imageTemplate = $imageTemplate;

        return $this;
    }

    /**
     * @return FileStorage
     */
    public function getImageLogo(): ?FileStorage
    {
        return $this->imageLogo;
    }

    /**
     * @param FileStorage $imageLogo
     *
     * @return $this
     */
    public function setImageLogo(FileStorage $imageLogo)
    {
        $this->imageLogo = $imageLogo;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->getName() ? : "New Project";
    }
}
