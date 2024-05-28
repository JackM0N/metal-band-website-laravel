<?php

return [
    'attributes' => [
        'name' => 'Nazwa',
        'publicationYear' => 'Rok wydania',
        'image' => 'Okładka albumu'
    ],
    'actions' => [
        'create' => 'Dodaj album',
        'edit' => 'Edytuj album',
        'destroy' => 'Usuń album',
        'restore' => 'Przywróć album',
        'youtube' => 'Znajdź album na YouTube',
        'spotify' => 'Znajdź album na Spotify',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego albumu',
        'edit_form_title' => 'Edycja albumu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano album :name',
            'updated' => 'Zaktualizowano album :name',
            'destroyed' => 'Usunięto album :name',
            'restored' => 'Przywrócono album :name',
            'image_deleted' => 'Zdjęcia dla albumu :name zostało usunięte',
        ],
        'errors' => [
            'image_deleted' => 'Nie udało się usunąć zdjęcia dla produktu :name',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie albumu',
            'description' => 'Czy na pewno usunąć album :name',
        ],
        'restore' => [
            'title' => 'Przywracanie albumu',
            'description' => 'Czy na pewno przywrócić album :name',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia',
            'description' => 'Czy na pewno usunąć zdjęcie dla produktu :name'
        ]
    ],
    'email_notification' => [
        'subject' => 'Nowy album :title już wyszedł!'
    ],
    'email_content' => [
        'content' => 'Nasz zespół dumnie oświadcza że opublikował właśnie nowy album!',
        'contentToo' => 'Posłuchaj go na swojej ulubinej platformie streamingowej lub wpadnij na naszą stronę by sprawdzić gdzie możesz jej posłuchać!',
        'regards' => 'Z pozdrowieniami',
        'regardsToo' => '2FDP Team'
    ]
];