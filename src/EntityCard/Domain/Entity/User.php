<?php

declare(strict_types=1);

namespace src\EntityCard\Domain\Entity;

class User
{
    private ?int $id;
    private string $name;
    private int $chatId;
    /**
     * @var array<EntityCard>
     */
    private array $entities;

    public function __construct(?int $id, string $name, int $chatId, array $entities = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->chatId = $chatId;
        $this->entities = $entities;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function getEntities(): array
    {
        return $this->entities;
    }
}
