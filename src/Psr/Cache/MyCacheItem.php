<?php
    namespace Psr\Cache;
    use Psr\Cache\CacheItemInterface;

class MyCacheItem implements CacheItemInterface
{
    private string $key;
    private $value;
    private bool $hit = false;

    public function __construct(string $key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey(): string
    {
       return $this->key;
    }

    public function get(): string
    {
    return $this->value;
    }

    public function isHit(): bool
    {
    return $this->hit;
    }

    public function set(mixed $value): static
    {
        $this->value = $value;
        $this->hit = true;
        return $this;
    }

    public function expiresAt($expiration): static
    {
        // Логика установки времени истечения
        return $this;
    }

    public function expiresAfter($time): static
    {
        // Логика установки времени истечения
        return $this;
    }
}
