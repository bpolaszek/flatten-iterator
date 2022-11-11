<?php

namespace BenTools\FlattenIterator;

use IteratorAggregate;
use Traversable;

class FlattenIterator implements IteratorAggregate
{
    /**
     * @var iterable<iterable>
     */
    private iterable $iterables;

    private bool $preserveKeys;

    /**
     * @param iterable<iterable> $iterables
     */
    public function __construct(iterable $iterables, bool $preserveKeys = false)
    {
        $this->iterables = $iterables;
        $this->preserveKeys = $preserveKeys;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        foreach ($this->iterables as $iterable) {
            if (!is_iterable($iterable)) {
                throw new \InvalidArgumentException('All iterables must be iterable.');
            }
            if (true === $this->preserveKeys) {
                foreach ($iterable as $key => $value) {
                    yield $key => $value;
                }
            } else {
                foreach ($iterable as $value) {
                    yield $value;
                }
            }
        }
    }

    /**
     * @return array|FlattenIterator
     */
    public function asArray(): array
    {
        return iterator_to_array($this);
    }
}
