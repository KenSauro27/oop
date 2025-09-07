<?php
class Quadratic {
    public $a;
    public $b;
    public $c;

    // Constructor with coefficients
    function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    // Calculate discriminant
    function discriminant() {
        return $this->b * $this->b - 4 * $this->a * $this->c;
    }

    // Calculate roots
    function roots() {
        $d = $this->discriminant();
        if ($d < 0) {
            return "No real roots";
        }
        $r1 = (-$this->b + sqrt($d)) / (2 * $this->a);
        $r2 = (-$this->b - sqrt($d)) / (2 * $this->a);
        return [$r1, $r2];
    }
}

// ----------- TEST OUTPUT -----------
$eq = new Quadratic(1, -3, 2); // x² - 3x + 2 = 0

echo "Discriminant: " . $eq->discriminant() . "<br>";
$roots = $eq->roots();
if (is_array($roots)) {
    echo "Root 1: " . $roots[0] . "<br>";
    echo "Root 2: " . $roots[1] . "<br>";
} else {
    echo $roots; // message if no real roots
}
?>
