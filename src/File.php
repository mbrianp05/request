<?php

namespace Libsstack\Request;

class File
{
  public function __construct(protected array $file)
  {
  }

  public static function load(): ?static
  {
    $file = $_FILES[\array_key_first($_FILES)] ?? null;

    if (null == $file)
      return null;

    return new static($file);
  }

  public function name(): string
  {
    return $this->file['name'];
  }

  public function type(string $type = null): string
  {
    if (null == $type)
      return $this->file['type'];

    return str_contains($this->file['type'], $type);
  }

  public function size(): int
  {
    return $this->file['size'];
  }

  public function relativePath(): string
  {
    return $this->file['tmp_name'];
  }

  public function upload(string $directory, string $name = null): void
  {
    if (!str_ends_with($directory, '/'))
      $directory = $directory . '/';

    echo $directory. $this->name();

    move_uploaded_file($this->relativePath(), $directory . ($name ?? $this->name()));
  }
}
