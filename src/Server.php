<?php

namespace Libsstack\Request;

class Server
{
  public function __construct(
    protected array $params,
  ) {
  }

  public static function create(): static
  {
    return new static($_SERVER);
  }

  public function ip(): string
  {
    return $this->params['REMOTE_ADDR'];
  }

  public function port(): string
  {
    return $this->params['SERVER_PORT'];
  }

  public function host(): string
  {
    return $this->params['SERVER_NAME'];
  }

  public function directory(): string
  {
    return $this->params['DOCUMENT_ROOT'];
  }

  public function accepts(): array
  {
    return explode(',', $this->params['HTTP_ACCEPT']);
  }

  public function uri(): string
  {
    return $this->params['REQUEST_URI'];
  }

  public function protocol(): string
  {
    return $this->params['SERVER_PROTOCOL'];
  }

  public function method(): string
  {
    return $this->params['HTTP_METHOD'];
  }
}
