<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FrontendBlock
 *
 * @ORM\Table(name="frontend_block")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FrontendBlockRepository")
 */
class FrontendBlock extends AdminEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, unique=true)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return FrontendBlock
     */
    public function setName(string $name): FrontendBlock
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return FrontendBlock
     */
    public function setContent(string $content): FrontendBlock
    {
        $this->content = $content;

        return $this;
    }
}
