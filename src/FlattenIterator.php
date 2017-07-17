<?php

namespace BenTools\FlattenIterator;

use IteratorAggregate;

class FlattenIterator implements IteratorAggregate
{
    /**
     * @var iterable
     */
    private $iterables;

    /**
     * @var bool
     */
    private $preserveKeys;

    /**
     * FlattenIterator constructor.
     * @param iterable $iterables
     * @param bool     $preserveKeys
     */
    public function __construct(iterable $iterables, bool $preserveKeys = false)
    {
        $this->iterables = $iterables;
        $this->preserveKeys = $preserveKeys;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): iterable
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
