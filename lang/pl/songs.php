<?php

return [
    'attributes' => [
        'title' => 'Tytuł',
        'duration' => 'Długość',
        'album_name' => 'Nazwa albumu'
    ],
    'actions' => [
        'create' => 'Dodaj piosenkę',
        'edit' => 'Edytuj piosenkę',
        'destroy' => 'Usuń piosenkę',
        'restore' => 'Przywróć piosenkę',
        'youtube' => 'Znajdź na YouTube',
        'spotify' => 'Znajdź na Spotify',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej piosenki',
        'edit_form_title' => 'Edycja piosenki',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano piosenkę :title',
            'updated' => 'Zaktualizowano piosenkę :title',
            'destroyed' => 'Usunięto piosenkę :title',
            'restored' => 'Przywrócono piosenkę :title',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie piosenki',
            'description' => 'Czy na pewno usunąć piosenkę :title',
        ],
        'restore' => [
            'title' => 'Przywracanie piosenki',
            'description' => 'Czy na pewno przywrócić piosenkę :title',
        ],
    ],
];