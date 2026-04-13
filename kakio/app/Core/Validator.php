<?php
namespace App\Core;

class Validator
{
    private array $errors = [];

    public function required(string $field, mixed $value, string $message): self
    {
        if ($value === null || $value === '') {
            $this->errors[$field][] = $message;
        }
        return $this;
    }

    public function email(string $field, mixed $value, string $message): self
    {
        if ($value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = $message;
        }
        return $this;
    }

    public function min(string $field, string $value, int $length, string $message): self
    {
        if (mb_strlen($value) < $length) {
            $this->errors[$field][] = $message;
        }
        return $this;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }
}
