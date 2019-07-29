<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptionRepository")
 */
class Option extends AbstractEntity
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="options")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
