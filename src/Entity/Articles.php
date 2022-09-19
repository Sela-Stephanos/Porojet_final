<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    #[ORM\OneToMany(mappedBy: 'article_type', targetEntity: Casques::class)]
    private Collection $casques;

    #[ORM\OneToMany(mappedBy: 'article_type', targetEntity: Accessoires::class)]
    private Collection $accessoires;

    #[ORM\OneToMany(mappedBy: 'article_type', targetEntity: Epauliere::class)]
    private Collection $epaulieres;

    #[ORM\OneToMany(mappedBy: 'article_type', targetEntity: Crampons::class)]
    private Collection $crampons;

    public function __construct()
    {
        $this->casques = new ArrayCollection();
        $this->accessoires = new ArrayCollection();
        $this->epaulieres = new ArrayCollection();
        $this->crampons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection<int, Casques>
     */
    public function getCasques(): Collection
    {
        return $this->casques;
    }

    public function addCasque(Casques $casque): self
    {
        if (!$this->casques->contains($casque)) {
            $this->casques->add($casque);
            $casque->setArticleType($this);
        }

        return $this;
    }

    public function removeCasque(Casques $casque): self
    {
        if ($this->casques->removeElement($casque)) {
            // set the owning side to null (unless already changed)
            if ($casque->getArticleType() === $this) {
                $casque->setArticleType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Accessoires>
     */
    public function getAccessoires(): Collection
    {
        return $this->accessoires;
    }

    public function addAccessoire(Accessoires $accessoire): self
    {
        if (!$this->accessoires->contains($accessoire)) {
            $this->accessoires->add($accessoire);
            $accessoire->setArticleType($this);
        }

        return $this;
    }

    public function removeAccessoire(Accessoires $accessoire): self
    {
        if ($this->accessoires->removeElement($accessoire)) {
            // set the owning side to null (unless already changed)
            if ($accessoire->getArticleType() === $this) {
                $accessoire->setArticleType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Epauliere>
     */
    public function getEpaulieres(): Collection
    {
        return $this->epaulieres;
    }

    public function addEpauliere(Epauliere $epauliere): self
    {
        if (!$this->epaulieres->contains($epauliere)) {
            $this->epaulieres->add($epauliere);
            $epauliere->setArticleType($this);
        }

        return $this;
    }

    public function removeEpauliere(Epauliere $epauliere): self
    {
        if ($this->epaulieres->removeElement($epauliere)) {
            // set the owning side to null (unless already changed)
            if ($epauliere->getArticleType() === $this) {
                $epauliere->setArticleType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Crampons>
     */
    public function getCrampons(): Collection
    {
        return $this->crampons;
    }

    public function addCrampon(Crampons $crampon): self
    {
        if (!$this->crampons->contains($crampon)) {
            $this->crampons->add($crampon);
            $crampon->setArticleType($this);
        }

        return $this;
    }

    public function removeCrampon(Crampons $crampon): self
    {
        if ($this->crampons->removeElement($crampon)) {
            // set the owning side to null (unless already changed)
            if ($crampon->getArticleType() === $this) {
                $crampon->setArticleType(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->Type;
    }
}
