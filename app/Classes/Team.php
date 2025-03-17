<?php

namespace App\Classes;

class Team {
    public string $name;
    public int $rating;
    public int $points = 0;
    public int $scored = 0;
    public int $conceded = 0;

    public int $wins = 0;
    public int $losses = 0;
    public int $draws = 0;
    private array $lastMatches = [];

    public function __construct(string $name) {
        $this->name = $name;
        $this->rating = rand(1, 100); // Randomize power of each team
    }

    public function addPoints(int $points) {
        $this->points += $points;
    }

    public function recordMatch(string $result) {
        array_unshift($this->lastMatches, $result);

        if (count($this->lastMatches) > 5) {
            array_pop($this->lastMatches);
        }
    }

    public function getFormFactor(): float {
        $weights = ['W' => 1.2, 'D' => 1.0, 'L' => 0.8];
        $factor = 1.0;

        foreach ($this->lastMatches as $match) {
            $factor *= $weights[$match];
        }
        return $factor;
    }
}
