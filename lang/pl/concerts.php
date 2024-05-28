<?php

return [
    'attributes' => [
        'date' => 'Data',
        'country' => 'Kraj',
        'city' => 'Miasto',
        'place' => 'Miejsce',
        'tour' => 'Nazwa trasy koncertowej'
    ],
    'actions' => [
        'create' => 'Dodaj koncert',
        'edit' => 'Edytuj koncert',
        'destroy' => 'Usuń koncert',
        'restore' => 'Przywróć koncert',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego koncertu',
        'edit_form_title' => 'Edycja koncertu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano koncert :place',
            'updated' => 'Zaktualizowano koncert :place',
            'destroyed' => 'Usunięto koncert :place',
            'restored' => 'Przywrócono koncert :place',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie koncertu',
            'description' => 'Czy na pewno usunąć koncert :place',
        ],
        'restore' => [
            'title' => 'Przywracanie koncertu',
            'description' => 'Czy na pewno przywrócić koncert :place',
        ],
    ],
];