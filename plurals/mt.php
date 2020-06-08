<?php
// Maltese (mt)
return [
    'forms' => 4,
    'rule' => '(n == 1 ? 0 : n == 0 || (n % 100 > 1 && n % 100 < 11) ? 1 : (n % 100 > 10 && n % 100 < 20) ? 2 : 3)',
    'func' => static function (int $n): int {
        return (int)(($n == 1 ? 0 : ($n == 0 || ($n % 100 > 1 && $n % 100 < 11) ? 1 : (($n % 100 > 10 && $n % 100 < 20) ? 2 : 3))));
    },
];
