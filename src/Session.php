<?php

namespace Libsstack\Request;

class Session extends Params
{
  public function __construct(array $params = [])
  {
    parent::__construct($params);
    static::active();
  }

  public static function isActive(): bool
  {
    return isset($_SESSION);
  }

  public static function active(): void
  {
    if (!static::isActive())
      session_start();
  }

  public static function start(): static
  {
    static::active();

    return new static($_SESSION);
  }

  public function set(string $key, string $value): static
  {
    $_SESSION[$key] = $value;

    return $this;
  }

  public function remove(string $key): static
  {
    unset($_SESSION[$key]);

    return $this;
  }

  public function clean(): static
  {
    unset($_SESSION);

    return $this;
  }

  public function __destruct()
  {
    session_destroy();
  }
}
