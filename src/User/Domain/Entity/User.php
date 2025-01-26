<?php

declare(strict_types=1);

namespace src\User\Domain\Entity;

class User
{
    private ?int $id;
    private string $name;
    private int $chatId;
    private string $menuState;
    private ?int $entityIdInteraction;

    public function __construct(
        ?int   $id,
        string $name,
        int    $chatId,
        string $menuState,
        ?int   $entityIdInteraction = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->chatId = $chatId;
        $this->menuState = $menuState;
        $this->entityIdInteraction = $entityIdInteraction;
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

    public function getMenuState(): string
    {
        return $this->menuState;
    }

    public function getEntityIdInteraction(): ?int
    {
        return $this->entityIdInteraction;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function setMenuState(string $menuState): User
    {
        $this->menuState = $menuState;
        return $this;
    }

    public function setEntityIdInteraction(?int $entityIdInteraction): User
    {
        $this->entityIdInteraction = $entityIdInteraction;
        return $this;
    }
}
