<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\{
    File, UploadedFile
};
use Symfony\Component\Validator\Constraints as Assert;


/**
 * FileStorage
 *
 * @ORM\Table(name="file_storage")
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\FileStorageRepository")
 * @Vich\Uploadable
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class FileStorage extends AdminEntity
{
    /**
     * @ORM\Column(length=20)
     * @Assert\NotBlank
     *
     * @var string name
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="files", fileNameProperty="file.name", size="file.size", mimeType="file.mimeType", originalName="file.originalName")
     *
     * @var File
     */
    private $uploadedFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length = 20, nullable=true)
     */
    private $context;

    /**
     * FileStorage constructor.
     */
    public function __construct()
    {
        $this->file = new EmbeddedFile();
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return File|null
     */
    public function getUploadedFile(): ? File
    {
        return $this->uploadedFile;
    }

    /**
     * @param File|UploadedFile $image
     */
    public function setUploadedFile(File $image = null)
    {
        $this->uploadedFile = $image;

//@todo check - is it working without
//        if ($image)
//            $this->updated = new \DateTimeImmutable();

    }

    /**
     * @return EmbeddedFile
     */
    public function getFile(): EmbeddedFile
    {
        return $this->file;
    }

    /**
     * @param EmbeddedFile $file
     */
    public function setFile(EmbeddedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getContext(): ?string
    {
        return $this->context;
    }

    /**
     * @param string $context
     */
    public function setContext(string $context)
    {
        $this->context = $context;
    }

    public function __toString()
    {
        return $this->getName() ?: 'New file';
    }
}
