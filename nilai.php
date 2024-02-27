<?php

class Nilai
{

    private $nilaiPartisipasi;
    private $nilaiTugas;
    private $nilaiUTS;
    private $nilaiUAS;

    public function __construct($nilaiPartisipasi, $nilaiTugas, $nilaiUTS, $nilaiUAS)
    {
        $this->nilaiPartisipasi = $nilaiPartisipasi;
        $this->nilaiTugas = $nilaiTugas;
        $this->nilaiUTS = $nilaiUTS;
        $this->nilaiUAS = $nilaiUAS;
    }

    public function hitungNA()
    {
        $na = (0.1 * $this->nilaiPartisipasi) + (0.2 * $this->nilaiTugas) + (0.3 * $this->nilaiUTS) + (0.4 * $this->nilaiUAS);
        return $na;
    }

    public function konversiNH($na)
    {
        if ($na >= 85) {
            return 'A';
        } elseif ($na >= 80) {
            return 'A-';
        } elseif ($na >= 75) {
            return 'B+';
        } elseif ($na >= 70) {
            return 'B';
        } elseif ($na >= 65) {
            return 'B-';
        } elseif ($na >= 60) {
            return 'C+';
        } elseif ($na >= 55) {
            return 'C';
        } elseif ($na >= 50) {
            return 'C-';
        } elseif ($na >= 40) {
            return 'D';
        } else {
            return 'E';
        }
    }
}
