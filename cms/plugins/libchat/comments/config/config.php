<?php

use LibChat\Comments\Models\Comment;
use LibChat\Comments\Http\Resources\AuthorResource;

return [
    'unregistered_user_allowed_to_read' => true,
    'models_map'                        => [
        'comment' => [
            'class' => Comment::class,
        ],
    ],
    'resources'                         => [
        'author' => AuthorResource::class,
    ],
];