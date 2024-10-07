<?php

return [
    "target_php_version" => '8.2',
    'directory_list' => [
        'src',
        'config',
        'public',
        'vendor/phan/phan/src/Phan',
    ],
    "exclude_analysis_directory_list" => [
        'vendor/'
    ],
    'plugins' => [
        'AlwaysReturnPlugin',
        'UnreachableCodePlugin',
        'DollarDollarPlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
    ],
];
