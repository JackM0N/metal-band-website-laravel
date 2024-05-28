<?php

return [
    'attributes' => [
        'title' => 'Tytuł',
        'startDate' => 'Data rozpoczęcia',
        'endDate' => 'Data zakończenia',
        'image' => 'Zdjęcie',
    ],
    'actions' => [
        'create' => 'Dodaj trasę koncertową',
        'edit' => 'Edytuj trasę koncertową',
        'destroy' => 'Usuń trasę koncertową',
        'restore' => 'Przywróć trasę koncertową',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej trasy koncertowej',
        'edit_form_title' => 'Edycja trasy koncertowej',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano trasę koncertową :title',
            'updated' => 'Zaktualizowano trasę koncertową :title',
            'destroyed' => 'Usunięto trasę koncertową :title',
            'restored' => 'Przywrócono trasę koncertową :title',
            'image_deleted' => 'Zdjęcie dla trasy :title zostało usunięte',
        ],
        'errors' => [
            'image_deleted' => 'Nie udało się usunąć zdjęcia dla trasy :title',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => 'Usuwanie trasy koncertowej',
            'description' => 'Czy na pewno usunąć trasę koncertową :title',
        ],
        'restore' => [
            'title' => 'Przywracanie trasy koncertowej',
            'description' => 'Czy na pewno przywrócić trasę koncertową :title',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia',
            'description' => 'Czy na pewno usunąć zdjęcie dla trasy :title'
        ]
    ],
    'email_notification' => [
        'subject' => 'Nowa trasa koncertowa :title'
    ],
    'email_content' => [
        'content' => 'Nasz zespół zaplanował nową trasę koncerową! Wpadnij na naszą stronę i sprawdź gdzie będziemy grać!',
        'regards' => 'Z pozdrowieniami',
        'regardsToo' => '2FDP Team'
    ]
];
