<?php

declare(strict_types=1);

namespace ArchTools\Bundle\ExtensiveAutomationBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class OpenApiResponse extends JsonResponse
{
    private $isError = false;

    private function __construct(
        mixed $data = null,
        string|null $message = null,
        int $status = self::HTTP_OK,
        array $headers = []
    ) {
        $content = [
            'code' => $status,
            'message' => self::$statusTexts[$status],
            'details' => $message,
            'data' => $data,
        ];

        parent::__construct($content, $status, $headers, false);
    }

    public static function empty(string|null $message = null, int $status = self::HTTP_NO_CONTENT): self
    {
        if (null === $message) {
            $message = self::$statusTexts[$status];
        }

        return new self(null, $message, $status);
    }

    public static function ok(string|null $message = null, array|null $data = null): self
    {
        return new self($data, $message, self::HTTP_OK);
    }

    public static function created(mixed $id, string $message): self
    {
        return new self(['id' => $id], $message, self::HTTP_CREATED);
    }

    public static function collection(array $resources, int $status = self::HTTP_OK): self
    {
        return new self($resources, null, $status);
    }

    public static function item(mixed $item, int $status = self::HTTP_OK): self
    {
        return new self($item, null, $status);
    }

    public static function notFound(string|null $message): self
    {
        return new self(null, $message, self::HTTP_NOT_FOUND);
    }

    public static function validationFail(array $constraintViolations): self
    {
        return new self($constraintViolations, 'validation.fail', self::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function exception(string $message = null, int $code = self::HTTP_INTERNAL_SERVER_ERROR): self
    {
        $self = new self(null, $message, $code);
        $self->isError = true;

        return $self;
    }

    public function isError(): bool
    {
        return $this->isError;
    }
}
