<?php

declare(strict_types=1);

namespace App;


readonly class PeselValidator
{
    private const array WEIGHTS = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];

    public function validate(string $pesel): bool
    {
        return $this->hasValidFormat($pesel)
            && $this->hasValidDate($pesel)
            && $this->hasValidChecksum($pesel);
    }

    private function hasValidFormat(string $pesel): bool
    {
        return preg_match('/^\d{11}$/', $pesel) === 1;
    }

    private function hasValidDate(string $pesel): bool
    {
        [$year, $month, $day] = [
            (int) substr($pesel, 0, 2),
            (int) substr($pesel, 2, 2),
            (int) substr($pesel, 4, 2)
        ];

        $century = match (true) {
            $month >= 1 && $month <= 12 => 1900,
            $month >= 21 && $month <= 32 => 2000,
            $month >= 41 && $month <= 52 => 2100,
            $month >= 61 && $month <= 72 => 2200,
            $month >= 81 && $month <= 92 => 1800,
            default => null,
        };

        if ($century === null) {
            return false;
        }

        $month = $month % 20 ?: $month;

        $year += $century;
        $dateString = sprintf('%04d-%02d-%02d', $year, $month, $day);

        $date = \DateTime::createFromFormat('Y-m-d', $dateString);

        return $date && $date->format('Y-m-d') === $dateString;
    }

    private function hasValidChecksum(string $pesel): bool
    {
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int)$pesel[$i] * self::WEIGHTS[$i];
        }

        $checksum = (10 - ($sum % 10)) % 10;

        return $checksum === (int)$pesel[10];
    }
}
