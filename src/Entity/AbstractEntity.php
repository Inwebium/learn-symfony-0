<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractEntity implements EntityInterface
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     * 
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;
    
    /**
     * 
     * @Groups({"base", "full"})
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
