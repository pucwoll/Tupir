<?php

use LibChat\Comments\Models\Comment;
use AppTupir\Catchphrase\Models\Catchphrase;
use LibChat\Comments\Http\Resources\AuthorResource;

return [
    'unregistered_user_allowed_to_read' => true,
    'models_map'                        => [
        'catchphrase'  => [
            'class' => Catchphrase::class,
        ],
        'comment' => [
            'class' => Comment::class,
        ],
    ],
    'resources'                         => [
        'author' => AuthorResource::class,
    ],
];
