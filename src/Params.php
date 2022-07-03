<?php

namespace Libsstack\Request;

use ArrayAccess;
use InvalidArgumentException;

class Params implements ArrayAccess
{
  public function __construct(protected array $params = [])
  {
  }

  public static function fromArray(array $array): static
  {
    return new static($array);
  }
  
  public function offsetUnset(mixed $offset): void
  {
    unset($this->params[$offset]);
  }

  public function offsetExists(mixed $offset): bool
  {
    return isset($this->params[$offset]);    
  }

  public function offsetGet($key)
  {
    return $this->params[$key];
  }

  public function offsetSet(mixed $offset, mixed $value): void
  {
    if (!is_string($offset))
      throw new InvalidArgumentException(sprintf('Parameter $offset can only be of type string'));

    if (!is_string($value))
      throw new InvalidArgumentException(sprintf('Parameter $value can only be of type string'));

    $this->params[$offset] = $value;
  }

  public function get(string $key, string $default = ''): string
  {
    return $this->params[$key] ?? $default;
  }

  public function has(string $key): bool
  {
    return $this->offsetExists($key);
  }
}