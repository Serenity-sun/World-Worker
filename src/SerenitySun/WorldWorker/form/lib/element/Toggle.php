<?php

declare(strict_types=1);

namespace SerenitySun\WorldWorker\form\lib\element;

use pocketmine\form\FormValidationException;
use function gettype;
use function is_bool;

/** @phpstan-extends BaseElementWithValue<bool> */
class Toggle extends BaseElementWithValue
{
    public function __construct(
        string $text,
        public readonly bool $default = false,
    ) {
        parent::__construct($text);
    }

    protected function getType(): string
    {
        return "toggle";
    }

    protected function validateValue(mixed $value): void
    {
        if(!is_bool($value)) {
            throw new FormValidationException("Expected bool, got " . gettype($value));
        }
    }

    protected function serializeElementData(): array
    {
        return [
            "default" => $this->default,
        ];
    }
}
