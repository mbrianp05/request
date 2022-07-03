<?php

namespace Libsstack\Request;

class Cookie extends Params
{
  public static function create(): static
  {
    return new static($_COOKIE);
  }

  public function set(string $name, string $value, int $expires = null): static
  {
    setcookie($name, $value, $expires);
    $this->params[] = $_COOKIE[$name];

    return $this;
  }

  public function remove(string $name): static
  {
    unset($_COOKIE[$name]);

    return $this;
  }
}