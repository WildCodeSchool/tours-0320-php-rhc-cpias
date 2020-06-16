<?php

namespace App\Model;

use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;

class Upload
{
    private $uploadedFile;


    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    public function setUploadedFile($uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }
}
