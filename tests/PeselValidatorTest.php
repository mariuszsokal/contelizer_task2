<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\PeselValidator;

class PeselValidatorTest extends TestCase
{
    private readonly PeselValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new PeselValidator();
    }

    public function testValidPesel(): void
    {
        $validPesels = [
            '94210643324', // 1994-01-06
            '78221646457', // 1978-12-16
            '98070234261', // 1998-07-02
            '83021043146', // 1983-02-10
            '60321072762', // 2060-12-10
            '20101653291', // 2020-10-16
            '67212644471', // 2067-01-26
            '57062123875', // 1957-06-21
        ];

        foreach ($validPesels as $pesel) {
            $this->assertTrue(
                $this->validator->validate($pesel),
                "Expected valid PESEL: $pesel"
            );
        }
    }

    public function testInvalidPesel(): void
    {
        $invalidPesels = [
            '27261881149',
            '44051401358',
            '55010112342',
            '97010112340',
            'abcdefghijk',
            '4405140135',
            '',
        ];

        foreach ($invalidPesels as $pesel) {
            $this->assertFalse(
                $this->validator->validate($pesel),
                "Expected invalid PESEL: $pesel"
            );
        }
    }
}
