<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Strain;
use App\Entity\Finess;

class StrainFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $strain =new Strain();
        $strain->setCreno('123456789');
        $strain->setDatePrelevement(new \ DateTime('06/01/2020'));
        $strain->setTypePrelevement('Hémoculture');
        $strain->setMicroOrganisme('STA AUR-Staphylococcus aureus');
        $strain->setResistance('OXA-48');
        $strain->setFiness($this->getReference('180000259'));
        $manager->persist($strain);
            
        $strain =new Strain();
        $strain->setCreno('345678912');
        $strain->setDatePrelevement(new \ DateTime('06/18/2020'));
        $strain->setTypePrelevement('ECBU');
        $strain->setMicroOrganisme('ENT CLO-Enterobacter cloacae');
        $strain->setResistance('KPC-3');
        $strain->setFiness($this->getReference('180007239'));
        $manager->persist($strain);
            
        $strain =new Strain();
        $strain->setCreno('456789123');
        $strain->setDatePrelevement(new \ DateTime('06/26/2020'));
        $strain->setTypePrelevement('Hémoculture');
        $strain->setMicroOrganisme('STA AUR-Staphylococcus aureus');
        $strain->setResistance('OXA-48');
        $strain->setFiness($this->getReference('280504168'));
        $manager->persist($strain);
       
        $strain =new Strain();
        $strain->setCreno('567891234');
        $strain->setDatePrelevement(new \ DateTime('06/04/2020'));
        $strain->setTypePrelevement('Urine');
        $strain->setMicroOrganisme('LIS MON-Listeria monocytogenes');
        $strain->setResistance('NDM-1');
        $strain->setFiness($this->getReference('280505009'));
        $manager->persist($strain);

        $strain =new Strain();
        $strain->setCreno('678912345');
        $strain->setDatePrelevement(new \ DateTime('06/13/2020'));
        $strain->setTypePrelevement('ECBU');
        $strain->setMicroOrganisme('ENT CLO-Enterobacter cloacae');
        $strain->setResistance('KPC-3');
        $strain->setFiness($this->getReference('280506015'));
        $manager->persist($strain);
          
        $strain =new Strain();
        $strain->setCreno('789123456');
        $strain->setDatePrelevement(new \ DateTime('06/05/2020'));
        $strain->setTypePrelevement('Hémoculture');
        $strain->setMicroOrganisme('STA AUR-Staphylococcus aureus');
        $strain->setResistance('OXA-48');
        $strain->setFiness($this->getReference('370000598'));
        $manager->persist($strain);
           
        $strain =new Strain();
        $strain->setCreno('891234567');
        $strain->setDatePrelevement(new \ DateTime('06/30/2020'));
        $strain->setTypePrelevement('Urine');
        $strain->setMicroOrganisme('LIS MON-Listeria monocytogenes');
        $strain->setResistance('NDM-1');
        $strain->setFiness($this->getReference('370103681'));
        $manager->persist($strain);
            
        $strain =new Strain();
        $strain->setCreno('912345678');
        $strain->setDatePrelevement(new \ DateTime('06/22/2020'));
        $strain->setTypePrelevement('ECBU');
        $strain->setMicroOrganisme('ENT CLO-Enterobacter cloacae');
        $strain->setResistance('KPC-3');
        $strain->setFiness($this->getReference('370011314'));
        $manager->persist($strain);
      
        $manager->flush();
    }
}
