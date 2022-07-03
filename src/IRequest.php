<?php

namespace Libsstack\Request;

interface IRequest
{
  public static function create(): static;

  public function query(string|array $key = null): Params|string|array;

  public function body(string|array $key = null): Params|string|array;

  public function session(string|array $key = null): Session|string|array;

  public function cookie(string|array $key = null): Cookie|string|array;

  public function file(): ?File;

  public function server(): Server;
}