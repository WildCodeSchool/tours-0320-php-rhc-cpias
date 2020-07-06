<?php

namespace App\Model;

use App\Entity\Strain;
use Symfony\Component\Validator\Constraints as Assert;

class StrainName
{
    /**
    * @Assert\Choice(choices=Strain::MICRO_ORGANISM)
    */
    private $microOrganisme;


    public function getMicroOrganisme()
    {
        return $this->microOrganisme;
    }

    public function setMicroOrganisme($microOrganisme): self
    {
        $this->microOrganisme = $microOrganisme;

        return $this;
    }
}
