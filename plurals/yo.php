<?php
// Yoruba (yo)
return [
    'forms' => 2,
    'rule' => '(n != 1)',
    'func' => static function (int $n): int {
        return (int)($n != 1);
    },
];
