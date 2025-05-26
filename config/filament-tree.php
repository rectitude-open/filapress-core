<?php

declare(strict_types=1);

return [
    /**
     * Tree model fields
     */
    'column_name' => [
        'order' => 'weight',
        'parent' => 'parent_id',
        'title' => 'title',
    ],
    /**
     * Tree model default parent key
     */
    'default_parent_id' => -1,
    /**
     * Tree model default children key name
     */
    'default_children_key_name' => 'children',
];
