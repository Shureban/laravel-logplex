<?php

namespace Shureban\LaravelLogplex;

class TraceRow
{
    private array $baseTrace;

    /**
     * @param array $baseTrace
     */
    public function __construct(array $baseTrace)
    {
        $this->baseTrace = $baseTrace;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        $file = $this->baseTrace['file'] ?? '';

        return str_replace(base_path('/'), '', $file);
    }

    /**
     * @return string
     */
    public function getFileWithLine(): string
    {
        return sprintf('%s:%d', $this->getFile(), $this->getLine());
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->baseTrace['class'] ?? '';
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->baseTrace['line'] ?? 0;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->baseTrace['function'] ?? '';
    }

    /**
     * @return bool
     */
    public function isVendorFile(): bool
    {
        return str_contains($this->getFile(), 'vendor');
    }
}
