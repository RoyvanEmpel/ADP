<?php

enum PastaType: string {
    case Spaghetti = 'Spaghetti';
    case Penne = 'Penne';
    case Fusilli = 'Fusilli';
    case Tagliatelle = 'Tagliatelle';
}

enum SauceType: string {
    case Tomatensaus = 'Tomatensaus';
    case Alfredo = 'Alfredo';
    case Pesto = 'Pesto';
    case Carbonara = 'Carbonara';
}

class Pasta {
    public function __construct(
        private PastaType $type,
        private SauceType $sauce
    ) {}

    public function description(): string {
        return "Een heerlijke " . $this->type->value . " met " . $this->sauce->value . " saus.";
    }
}
