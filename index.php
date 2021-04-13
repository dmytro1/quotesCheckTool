<?php

$stringToCheck = '[[((2{} * ( 3[] + x) / (7 - y[])) && (2 || z))]]'; // Correct string
// $stringToCheck = '( 4 / (7 + x)) + 14) && (2 + y) || (3 - z)'; // Wrong string
// $stringToCheck = '((2+x)^2 + (3 - y) * (7 + z)'; // Wrong string

$stringElements = str_split($stringToCheck);

$roundBrackets = ['left' => '(', 'right' => ')'];
$squareBrackets = ['left' => '[', 'right' => ']'];
$figureBrackets = ['left' => '{', 'right' => '}'];

$bracketsCounter = [
    [
        'left'   => $roundBrackets['left'],
        'right'  => $roundBrackets['right'],
        'amount' => 0,
    ],
    [
        'left'   => $squareBrackets['left'],
        'right'  => $squareBrackets['right'],
        'amount' => 0,
    ],
    [
        'left'   => $figureBrackets['left'],
        'right'  => $figureBrackets['right'],
        'amount' => 0,
    ],
];

foreach ($stringElements as $element) {
    foreach ($bracketsCounter as &$bracket) {
        if ($element == $bracket['left']) {
            $bracket['amount']++;
        }

        if ($element == $bracket['right']) {
            if ($bracket['amount'] > 0) {
                $bracket['amount']--;
            } else {
                throw new Exception('String is not correct. Not enough "' . $bracket['left'] . '" brackets');
            }
        }
    }
}

foreach ($bracketsCounter as $counter) {
    if ($counter['amount'] != 0) {
        throw new Exception('String is not correct. Too much "' . $counter['left'] . '" brackets');
    }

//    $this->assertEquals(0, $counter['amount']);
}
