<?php

namespace Shureban\LaravelLogplex;

use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Monolog\Level;
use Monolog\LogRecord as BaseLogRecord;
use Throwable;

class LogRecord
{
    private string     $message;
    private Level      $level;
    private ?Throwable $exception;
    private ?User      $user;
    private ?Request   $request;

    /**
     * @param Level          $level
     * @param string         $message
     * @param Throwable|null $exception
     */
    public function __construct(Level $level, string $message, ?Throwable $exception)
    {
        $this->level     = $level;
        $this->message   = $message;
        $this->exception = $exception;
        $this->user      = Auth::user();
        $this->request   = \request();
    }

    public static function createFromBase(BaseLogRecord $baseRecord): LogRecord
    {
        return new static($baseRecord->level, $baseRecord->message, $baseRecord->context['exception'] ?? null);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }

    public function getException(): ?Throwable
    {
        return $this->exception;
    }

    /**
     * @return TraceRow[]
     */
    public function getExceptionTrace(): array
    {
        if (is_null($this->exception)) {
            return [];
        }

        return array_map(fn(array $item) => new TraceRow($item), $this->exception->getTrace());
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }
}
