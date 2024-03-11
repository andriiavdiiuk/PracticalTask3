<?php declare(strict_types=1);

class Category
{
    private int $category_id;
    private string $category_name;
    private string $category_description;

    public function __construct(int $category_id=-1, string $category_name="", string $category_description="")
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_description = $category_description;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): void
    {
        $this->category_name = $category_name;
    }

    public function getCategoryDescription(): string
    {
        return $this->category_description;
    }

    public function setCategoryDescription(string $category_description): void
    {
        $this->category_description = $category_description;
    }
}