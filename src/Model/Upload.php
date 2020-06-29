<?php

namespace App\Model;

use App\Repository\UploadRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

class Upload
{

    /**
     * @Assert\NotBlank(message="Merci de joindre un fichier")
     * @Assert\File(
     *        mimeTypes = {"text/plain"},
     *        mimeTypesMessage = "Veuillez joindre un fichier CSV.")
     */
    private $uploadedFile;


    public function getUploadedFile() : ?File
    {
        return $this->uploadedFile;
    }

    public function setUploadedFile(File $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }
}
