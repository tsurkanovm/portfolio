<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\{
    File, UploadedFile
};
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * FileStorage
 *
 * @ORM\Table(name="file_storage")
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\FileStorageRepository")
 * @Vich\Uploadable
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class FileStorage
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
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * FileStorage constructor.
     */
    public function __construct()
    {
        $this->file = new EmbeddedFile();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
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
    public function setUploadedFile(File $image = null): void
    {
        $this->uploadedFile = $image;

        if ($image)
            $this->updated = new \DateTimeImmutable();

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
    public function setFile(EmbeddedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }
}
