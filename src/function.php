<?php

namespace BenTools\FlattenIterator;

require_once __DIR__ . '/FlattenIterator.php';

/**
 * @param iterable $iterables
 * @param bool     $preserveKeys
 * @return FlattenIterator
 */
function flatten(iterable $iterables, bool $preserveKeys = false)
{
    return new FlattenIterator($iterables, $preserveKeys);
}
