<?php

namespace BenTools\FlattenIterator\Tests;

use ArrayIterator;
use InvalidArgumentException;
use function BenTools\FlattenIterator\flatten;
use PHPUnit\Framework\TestCase;

class FlattenIteratorTest extends TestCase
{
    public function testItThrowsAnExceptionOnInvalidIterable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        foreach (flatten($this->getInValidIterable()) as $item) {
            continue;
        }
    }

    public function testNotPreservingKeys(): void
    {
        $this->assertEquals([1, 2, 3, 4, 5, 6], iterator_to_array(flatten($this->getValidIterable())));
        $this->assertEquals([1, 2, 3, 4, 5, 6], flatten($this->getValidIterable())->asArray());
    }

    public function testPreservingKeys(): void
    {
        $this->assertEquals([5, 6], iterator_to_array(flatten($this->getValidIterable(), true)));
        $this->assertEquals([5, 6], flatten($this->getValidIterable(), true)->asArray());
    }

    private function getValidIterable(): array
    {
        return [
            [
                1,
                2,
            ],
            new ArrayIterator([
                3,
                4,
            ]),
            (function () {
                yield 5;
                yield 6;
            })(),
        ];
    }

    private function getInValidIterable(): array
    {
        return [
            [
                1,
                2,
            ],
            new ArrayIterator([
                3,
                4,
            ]),
            5
        ];
    }

}
