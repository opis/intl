<?php
// Javanese (jv)
return [
    'forms' => 2,
    'rule' => '(n != 0)',
    'func' => static function (int $n): int {
        return (int)($n != 0);
    },
];
