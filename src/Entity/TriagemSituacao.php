<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TriagemSituacaoRepository")
 */
class TriagemSituacao
{
    public const TRIAGEM_SITUACAO_REGISTRADA="TRIAGEM_SITUACAO_REGISTRADA";

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=40)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $descricao;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $dtIni;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $dtFim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Triagem", mappedBy="triagemSituacao")
     */
    private $triagens;

    public function __construct()
    {
        $this->triagems = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDtIni(): ?\DateTimeInterface
    {
        return $this->dtIni;
    }

    public function setDtIni(\DateTimeInterface $dtIni): self
    {
        $this->dtIni = $dtIni;

        return $this;
    }

    public function getDtFim(): ?\DateTimeInterface
    {
        return $this->dtFim;
    }

    public function setDtFim(?\DateTimeInterface $dtFim): self
    {
        $this->dtFim = $dtFim;

        return $this;
    }

    /**
     * @return Collection|Triagem[]
     */
    public function getTriagems(): Collection
    {
        return $this->triagems;
    }

    public function addTriagem(Triagem $triagem): self
    {
        if (!$this->triagems->contains($triagem)) {
            $this->triagems[] = $triagem;
            $triagem->setTriagemSituacaoId($this);
        }

        return $this;
    }

    public function removeTriagem(Triagem $triagem): self
    {
        if ($this->triagems->contains($triagem)) {
            $this->triagems->removeElement($triagem);
            // set the owning side to null (unless already changed)
            if ($triagem->getTriagemSituacaoId() === $this) {
                $triagem->setTriagemSituacaoId(null);
            }
        }

        return $this;
    }
}
