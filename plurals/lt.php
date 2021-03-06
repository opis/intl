<?php
// Lithuanian (lt)
return [
    'forms' => 3,
    'rule' => '(n % 10 == 1 && n % 100 != 11 ? 0 : n % 10 >= 2 && (n % 100 < 10 || n % 100 >= 20) ? 1 : 2)',
    'func' => function (int $n): int {
        return (int)(($n % 10 == 1 && $n % 100 != 11 ? 0 : ($n % 10 >= 2 && ($n % 100 < 10 || $n % 100 >= 20) ? 1 : 2)));
    },
];
