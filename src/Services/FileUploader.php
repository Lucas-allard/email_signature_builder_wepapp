<?php

namespace App\Services;

use App\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileUploader
{
    /**
     * @var
     */
    private $targetDirectory;

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
    public function upload(UploadedFile $file, EntityInterface $entity)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDirectory, $fileName);

        $entity->setPicture($fileName);
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function removePreviousPicture(EntityInterface $entity)
    {
        $previousPicture = $entity->getPicture();
        if ($previousPicture) {
            unlink($this->targetDirectory.'/'.$previousPicture);
        }
    }
}
