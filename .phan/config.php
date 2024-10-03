<?php

use Phan\Issue;

return [
    'target_php_version' => '8.2',
    'allow_missing_properties' => false,
    'null_casts_as_any_type' => false,
    'null_casts_as_array' => true,
    'array_casts_as_null' => true,
    'scalar_implicit_cast' => false,
    'scalar_array_key_cast' => true,
    'scalar_implicit_partial' => [],
    'strict_method_checking' => false,
    'strict_object_checking' => false,
    'strict_param_checking' => false,
    'strict_property_checking' => false,
    'strict_return_checking' => false,
    'ignore_undeclared_variables_in_global_scope' => true,
    'ignore_undeclared_functions_with_known_signatures' => true,
    'backward_compatibility_checks' => false,
    'check_docblock_signature_return_type_match' => false,
    'phpdoc_type_mapping' => [],
    'dead_code_detection' => false,
    'unused_variable_detection' => false,
    'redundant_condition_detection' => false,
    'assume_real_types_for_internal_functions' => false,
    'quick_mode' => false,
    'globals_type_map' => [],
    'minimum_severity' => Issue::SEVERITY_LOW,
    'suppress_issue_types' => [],
    'exclude_file_regex' => '@^vendor/.*/(tests?|Tests?)/@',
    'exclude_file_list' => [],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
    'enable_include_path_checks' => true,
    'processes' => 1,
    'analyzed_file_extensions' => [
        'php',
    ],
    'plugins' => [
        'AlwaysReturnPlugin',
        'UnreachableCodePlugin',
        'DollarDollarPlugin',
        'DuplicateArrayKeyPlugin',
        'PregRegexCheckerPlugin',
        'PrintfCheckerPlugin',
    ],
    'directory_list' => [
        'src',
        'vendor/phan/phan/src/Phan',
    ],
    'file_list' => [
        './config.php',
        './index.php'
    ],
];
