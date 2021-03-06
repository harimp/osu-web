<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'not_negative' => ':attribute nie może być ujemny.',
    'required' => ':attribute jest wymagany.',
    'too_long' => ':attribute przekroczył maksymalną liczbę znaków - możliwe jest użycie tylko :limit znaków.',
    'wrong_confirmation' => 'Potwierdzenie się nie zgadza.',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'Dyskusja została zablokowana.',
        'first_post' => 'Nie można usunąć wątku rozpoczynającego.',
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'Został ustawiony znacznik czasu, ale nie odnaleziono beatmapy.',
        'beatmapset_no_hype' => 'Nie można nadać priorytetu tej beatmapie.',
        'hype_requires_null_beatmap' => 'Priorytet musi zostać nadany w sekcji Główne (wszystkie poziomy trudności).',
        'invalid_beatmap_id' => 'Ustawiono niewłaściwy poziom trudności.',
        'invalid_beatmapset_id' => 'Ustawiono niewłaściwą beatmapę.',
        'locked' => 'Dyskusja została zablokowana.',
        'mapper_note_wrong_user' => 'Tylko twórca beatmapy może zamieszczać adnotacje.',

        'hype' => [
            'guest' => 'Musisz się zalogować, aby nadać priorytet.',
            'hyped' => 'Już nadano priorytet tej beatmapie.',
            'limit_exceeded' => 'Zużyto całą liczbę możliwych do nadania priorytetów.',
            'not_hypeable' => 'Nie można nadać priorytetu tej beatmapie',
            'owner' => 'Nie można nadać priorytetu własnej beatmapie.',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'Określony znacznik czasu sięga ponad długość beatmapy.',
            'negative' => 'Znacznik czasu nie może być ujemny.',
        ],
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'Można głosować tylko na prośby o funkcję.',
            'not_enough_feature_votes' => 'Niewystarczająco dużo głosów.',
        ],

        'poll_vote' => [
            'invalid' => 'Wybrano nieprawidłową opcję.',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'Usuwanie posta z metadanymi beatmapy jest zabronione.',
            'beatmapset_post_no_edit' => 'Edytowanie posta z metadanymi beatmapy jest zabronione.',
        ],

        'topic_poll' => [
            'duplicate_options' => 'Duplikaty nie są dozwolone.',
            'invalid_max_options' => 'Ilość możliwości wyboru na użytkownika nie może przekroczyć ich całościowej liczby.',
            'minimum_one_selection' => 'Potrzeba minimalnie jedną opcję.',
            'minimum_two_options' => 'Potrzeba minimalnie dwóch opcji.',
            'too_many_options' => 'Przekroczono maksymalną ilość możliwości wyboru.',
        ],

        'topic_vote' => [
            'required' => 'Wybierz jedną z opcji, aby zagłosować.',
            'too_many' => 'Wybrano więcej opcji, niż jest dozwolone.',
        ],
    ],

    'user' => [
        'contains_username' => 'Hasło nie może zawierać pseudonimu.',
        'email_already_used' => 'Ten adres email jest już w użyciu.',
        'invalid_country' => 'Kraj nie występuje w bazie danych.',
        'invalid_email' => 'To nie wygląda na adres email.',
        'too_short' => 'Nowe hasło jest za krótkie.',
        'unknown_duplicate' => 'Nazwa użytkownika lub adres e-mail jest już w użyciu.',
        'username_too_short' => 'Ta nazwa użytkownika jest zbyt krótka.',
        'weak' => 'Hasło jest za słabe.',
        'wrong_current_password' => 'Obecne hasło jest niepoprawne.',
        'wrong_email_confirmation' => 'Email potwierdzający się nie zgadza.',
        'wrong_password_confirmation' => 'Hasło potwierdzające się nie zgadza.',
        'too_long' => 'Przekroczono maksymalną liczbę znaków - możliwe jest użycie tylko :limit znaków.',
    ],
];
