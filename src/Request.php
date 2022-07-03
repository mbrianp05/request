<?php

namespace Libsstack\Request;

class Request implements IRequest
{
  protected Params $query;
  protected Params $body;
  protected Session $session;
  protected Server $server;
  protected Cookie $cookie;
  protected ?File $file;

  public function __construct(
    array $queries = null,
    array $body = null,
  ) {
    $this->query = Params::fromArray($queries ?? $_GET);
    $this->body = Params::fromArray($body ?? $_POST);
    $this->session = Session::start();
    $this->server = Server::create();
    $this->cookie = Cookie::create();
    $this->file = File::load();
  }

  public static function create(): static
  {
    return new static($_GET, $_POST);
  }

  public function query(string|array $key = null): Params|string|array
  {
    if ($key == null)
      return $this->queries;

    if (is_string($key))
      return $this->query->get($key);

    $queries = [];

    foreach ($key as $singleKey) {
      $queries = $this->query->get($singleKey);
    }

    return $queries;
  }

  public function body(string|array $key = null): Params|string|array
  {
    if ($key == null)
      return $this->body;

    if (is_string($key))
      return $this->body->get($key);

    $bodies = [];

    foreach ($key as $singleKey) {
      $bodies[] = $this->body->get($singleKey);
    }

    return $bodies;
  }

  public function cookie(string|array $key = null): Cookie|string|array
  {
    if ($key == null)
      return $this->cookie;

    if (is_string($key))
      return $this->cookie->get($key);

    $cookies = [];

    foreach ($key as $singleKey) {
      $cookies[] = $this->cookie->get($singleKey);
    }

    return $cookies;
  }

  public function session(string|array $key = null): Session|string|array
  {
    if ($key == null)
      return $this->session;

    if (is_string($key))
      return $this->session->get($key);

    $sessions = [];

    foreach ($key as $singleKey) {
      $sessions = $this->session->get($singleKey);
    }

    return $sessions;
  }

  public function file(): ?File
  {
    return $this->file;
  }

  public function server(): Server
  {
    return $this->server;
  }

  public function path(bool $withQuery = true): string
  {
    if ($withQuery)
      return $this->server()->uri();

    return str_contains($this->server()->uri(), '?') ? strstr($this->server()->uri(), '?', true) : $this->server()->uri();
  }

  public function accepts(string $format = null): bool|array
  {
    if (null == $format)
      return $this->server()->accepts();

    return \in_array($format, $this->server()->accepts());
  }

  public function method(string $method = null): bool|string
  {
    if (null == $method)
      return $this->server()->method();

    return mb_convert_case($method, MB_CASE_UPPER) == $method;
  }
}
