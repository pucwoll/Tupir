# Wezeo Feature - Comment
Univerzalny plugin na komentovanie akehokolvek modelu s roznymi nastaveniami.

## Usage
Treba overridenut config (cez `config/libchat/comments/config.php` resp. ak to ma byt project specific `config/libchat/comments/gamisfera-dev/config.php`) a pridat do pola `models_map` zoznam modelov, ktore su povolene komentovat.

napr:
```
'models_map' => [
    'lesson' => [
        'class' => 'LibFeature\Lesson\Models\Lesson',
    ],
    ...
```

Pre povolenie pisania odpovedi staci pridat do `models_map` samotny Comment model
```
'models_map' => [
    'lesson' => [
        'class' => 'LibFeature\Lesson\Models\Lesson',
    ],
    'comment' => [
        'class' => 'LibChat\Comments\Models\Comment',
    ]
]
```

By default je povolene, aby komentare citali aj neprihlaseni uzivatelia ... pre vypnutie tejto funkcionality, staci nastavit v configu `unregistered_user_allowed_to_read` na `false`.

V pripade, ze potrebujes aby sa komentare sortovali podla custom predpisu, tak v configu sa daju nastavit dva nepovinne parametre `order_column` a `order_direction` ... by default je `order_column` nastaveny na `created_at` a `order_direction` na `desc`. Kazdy model moze mat toto nastavenie custom podla seba.

napr:
```
'models_map' => [
    'lesson' => [
        'class' => 'LibFeature\Lesson\Models\Lesson',
        'order_column' => 'updated_at',
        'order_direction' => 'desc'
    ],
    'comment' => [
        'class' => 'LibChat\Comments\Models\Comment',
        'order_column' => 'custom_field',
        'order_direction' => 'asc'
    ]
]
```

## API Endpointy
1. get         comments/project/${pid}         -> comments/${model}/${mid}
2. post_auth   comments/project/${pid} {text}  -> comments/${model}/${mid} {text}
3. post_auth   comments/${cid} {text}          -> comments/comment/${cid} {text}
4. delete_auth comments/${cid}
5. patch_auth  comments/${cid} {text}

### FEATURES
Su tu este nejake predpripravene Behaviors a BE Controllers ... pre viac info sa treba informovat u Pata alebo Halasa :)