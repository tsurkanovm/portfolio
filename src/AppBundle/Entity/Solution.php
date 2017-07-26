<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\{
    File, UploadedFile
};
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Solution
 *
 * @ORM\Table(name="solutions")
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\SolutionRepository")
 * @Vich\Uploadable
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

    /**
     * @Vich\UploadableField(mapping="solution_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /**
     * Solution constructor.
     */
    public function __construct()
    {
        $this->image = new EmbeddedFile();
    }

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
     * @param File|UploadedFile $image
     */
    public function setImageFile(File $image = null): void
    {
        $this->imageFile = $image;

        if ($image)
            $this->updated = new \DateTimeImmutable();

    }

    /**
     * @return File|null
     */
    public function getImageFile(): ? File
    {
        return $this->imageFile;
    }

    /**
     * @param EmbeddedFile $image
     */
    public function setImage(EmbeddedFile $image): void
    {
        $this->image = $image;
    }

    /**
     * @return EmbeddedFile
     */
    public function getImage(): EmbeddedFile
    {
        return $this->image;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
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

    /**
     * @return string
     */
    public function __toString():string
    {
        return $this->getName() ? : "New Solution";
    }
}
