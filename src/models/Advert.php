<?php declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT']."/src/models/User.php";
class Advert
{
    private int $advert_id;
    private ?User $user;
    private string $title;
    private string $description;
    private bool $status;
    private int $price;
    private DateTime $publication_date;
    private array $categories;

    public function __construct(int $advert_id=-1, User $user=null, string $title="", string $description="", bool $status=True, int $price=0, DateTime $publication_date=null,array $categories=array())
    {
        $this->advert_id = $advert_id;
        $this->user= $user;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->price = $price;
        $this->publication_date = $publication_date;
        $this->categories = $categories;
    }

    public function getAdvertId(): int
    {
        return $this->advert_id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPublicationDate(): DateTime
    {
        return $this->publication_date;
    }

    public function setPublicationDate(DateTime $publication_date): void
    {
        $this->publication_date = $publication_date;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
}