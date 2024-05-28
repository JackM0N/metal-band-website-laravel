<?php

return [
    'attributes' => [
        'title' => 'Tytuł',
        'contents' => 'Zawartość',
        'image' => "Miniaturka news'a (zdjęcie)"
    ],
    'actions' => [
        'create' => 'Dodaj news',
        'edit' => 'Edytuj news',
        'destroy' => 'Usuń news',
        'restore' => 'Przywróć news',
    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej newsa',
        'edit_form_title' => "Edycja news'a",
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano news :title',
            'updated' => 'Zaktualizowano news :title',
            'destroyed' => 'Usunięto news :title',
            'restored' => 'Przywrócono news :title',
            'image_deleted' => 'Miniaturka dla newsa :title zostało usunięte',
        ],
        'errors' => [
            'image_deleted' => 'Nie udało się usunąć miniaturki dla newsa :title',
        ]
    ],
    'dialogs' => [
        'soft_deletes' => [
            'title' => "Usuwanie news'a",
            'description' => 'Czy na pewno usunąć news :title',
        ],
        'restore' => [
            'title' => "Przywracanie news'a",
            'description' => 'Czy na pewno przywrócić news :title',
        ],
        'image_delete' => [
            'title' => 'Usuwanie zdjęcia',
            'description' => 'Czy na pewno usunąć miniaturkę dla newsa :title'
        ]
    ],
];
