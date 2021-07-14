<?php

declare(strict_types=1);

namespace ArchTools\Bundle\ExtensiveAutomationBundle\Exception;

class ValidationFailedException extends \RuntimeException
{
    public const DEFAULT_MESSAGE = 'exception.validation_failed';

    private array | null $constraintValidations = null;

    public static function create(array $constraintValidations, string $message = self::DEFAULT_MESSAGE): self
    {
        $self = new self($message);
        $self->constraintValidations = $constraintValidations;

        return $self;
    }

    public function getConstraintValidations(): ?array
    {
        return $this->constraintValidations;
    }
}
