<?php

namespace AppBundle\Entity;

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
class Solution extends AdminEntity
{
    /**
     * @ORM\Column(length=40)
     * @Assert\NotBlank
     *
     * @var string name
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\FileStorage")
     *
     * @var FileStorage
     */
    private $logo;

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

    /**
     * @return FileStorage
     */
    public function getLogo(): ?FileStorage
    {
        return $this->logo;
    }

    /**
     * @param FileStorage $logo
     */
    public function setLogo(FileStorage $logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName() ?: "New Solution";
    }
}
