<?php

namespace App\Model;

use App\Repository\UploadRepository;

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
