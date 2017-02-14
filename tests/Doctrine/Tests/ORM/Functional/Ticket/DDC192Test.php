<?php

namespace Doctrine\Tests\ORM\Functional\Ticket;

use Doctrine\ORM\Annotation as ORM;
use Doctrine\Tests\OrmFunctionalTestCase;

class DDC192Test extends OrmFunctionalTestCase
{
    public function testSchemaCreation()
    {
        $this->schemaTool->createSchema(
            [
            $this->em->getClassMetadata(DDC192User::class),
            $this->em->getClassMetadata(DDC192Phonenumber::class)
            ]
        );
    }
}


/**
 * @ORM\Entity @ORM\Table(name="ddc192_users")
 */
class DDC192User
{
    /**
     * @ORM\Id @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    public $name;
}


/**
 * @ORM\Entity @ORM\Table(name="ddc192_phonenumbers")
 */
class DDC192Phonenumber
{
    /**
     * @ORM\Id @ORM\Column(name="phone", type="string", length=40)
     */
    protected $phone;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="DDC192User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $User;

    public function setPhone($value) { $this->phone = $value; }

    public function getPhone() { return $this->phone; }

    public function setUser(User $user)
    {
        $this->User = $user;
    }

    public function getUser() { return $this->User; }
}
