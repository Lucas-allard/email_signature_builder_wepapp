<?php

namespace App\Services;

use App\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 *
 */
class FileUploader
{
    /**
     * @var string
     */
    private string $targetDirectory;

    /**
     * @param $targetDirectory
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @param EntityInterface $entity
     * @return void
     */
    public function upload(UploadedFile $file, EntityInterface $entity): void
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDirectory, $fileName);

        $entity->setPicture($fileName);
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function removePreviousPicture(EntityInterface $entity): void
    {
        $previousPicture = $entity->getPicture();
        if ($previousPicture) {
            unlink($this->targetDirectory.'/'.$previousPicture);
        }
    }
}
