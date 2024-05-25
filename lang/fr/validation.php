<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Le :attribute doit être accepté.',
    'active_url' => "Le :attribute n'est pas une URL valide.",
    'after' => 'Le :attribute doit être apres :date.',
    'after_or_equal' => 'Le :attribute doit être une date avant ou égal a :date.',
    'alpha' => 'Le :attribute doit seulement contenir des lettres.',
    'alpha_dash' => 'Le :attribute doit seulement contenir des lettres, nombres, tirets et underscores',
    'alpha_num' => 'Le :attribute doit seulement contenir des lettres et des nombres',
    'array' => 'Le :attribute doit être un tableau',
    'before' => 'Le :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le :attribute doit être une date avant ou égal a  :date.',
    'between' => [
        'numeric' => 'Le :attribute doit être entre :min et :max.',
        'file' => 'Le :attribute doit être entre :min et :max kilo-octets.',
        'string' => 'Le :attribute doit être entre :min et :max caractères.',
        'array' => 'Le :attribute doit avoir entre :min et :max elements.',
    ],
    'boolean' => 'Le :attribute field doit être vrai ou faux.',
    'confirmed' => 'Le :attribute de confirmation ne correspond pas.',
    'date' => "Le :attribute n'est pas une date valide.",
    'date_equals' => 'Le :attribute doit être a date égal à :date.',
    'date_format' => 'Le :attribute ne correspond pas au format :format.',
    'different' => 'Le :attribute et :other doit être différent.',
    'digits' => 'Le :attribute doit être :digits chiffres.',
    'digits_between' => 'Le :attribute doit être entre :min et :max chiffres.',
    'dimensions' => "Le :attribute a des dimensions d'image non valides.",
    'distinct' => 'Le :attribute champ a une valeur en double.',
    'email' => 'Le :attribute doit être une adresse mail valide.',
    'ends_with' => "Le :attribute doit se terminer par l'un des following: :values.",
    'exists' => "Le choix :attribute n'est pas valide.",
    'file' => 'Le :attribute doit être un fichier.',
    'filled' => 'Le :attribute doit avoir une valeur.',
    'gt' => [
        'numeric' => 'Le :attribute doit être plus grand que :value.',
        'file' => 'Le :attribute doit être plus grand que :value kilo-octets.',
        'string' => 'Le :attribute doit être plus grand que :value caractères.',
        'array' => 'Le :attribute doit avoir more than :value elements.',
    ],
    'gte' => [
        'numeric' => 'Le :attribute doit être plus grand que ou égal a :value.',
        'file' => 'Le :attribute doit être plus grand que ou égal a :value kilo-octets.',
        'string' => 'Le :attribute doit être plus grand que ou égal a :value caractères.',
        'array' => 'Le :attribute doit avoir :value elements ou plus.',
    ],
    'image' => 'Le :attribute doit être une image.',
    'in' => "Le choix :attribute n'est pas valide.",
    'in_array' => "Le :attribute n'existe pas :other.",
    'indisposable' => 'Les adresses e-mail jetables ne sont pas autorisées.',
    'integer' => 'Le :attribute doit être un entier.',
    'ip' => 'Le :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le :attribute doit être une adresse IPV4 valide.',
    'ipv6' => 'Le :attribute doit être une adresse IPV6 valide..',
    'json' => 'Le :attribute doit être un json valide.',
    'lt' => [
        'numeric' => 'Le :attribute doit être moins que :value.',
        'file' => 'Le :attribute doit être moins que :value kilo-octets.',
        'string' => 'Le :attribute doit être moins que :value caractères.',
        'array' => 'Le :attribute doit avoir moins que :value elements.',
    ],
    'lte' => [
        'numeric' => 'Le :attribute doit être moins que ou égal a :value.',
        'file' => 'Le :attribute doit être moins que ou égal a :value kilo-octets.',
        'string' => 'Le :attribute doit être moins que ou égal a :value caractères.',
        'array' => 'Le :attribute ne doit pas avoir plus de :value elements.',
    ],
    'max' => [
        'numeric' => 'Le :attribute ne peut être plus grand que :max.',
        'file' => 'Le :attribute ne peut être plus grand que :max kilo-octets.',
        'string' => 'Le :attribute ne peut être plus grand que :max caractères.',
        'array' => 'Le :attribute ne peut pas avoir plus de :max elements.',
    ],
    'mimes' => 'Le :attribute doit être un fichier de type: :values.',
    'mimetypes' => 'Le :attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => 'Le :attribute doit contenir au moins :min.',
        'file' => 'Le :attribute doit avoir au moins :min kilo-octets.',
        'string' => 'Le :attribute doit contenir au moins :min caractères.',
        'array' => 'Le :attribute doit avoir au moins :min elements.',
    ],
    'not_in' => "Le choix :attribute n'est pas valide",
    'not_regex' => "Le :attribute format n'est pas valide",
    'numeric' => 'Le :attribute doit être un chiffre.',
    'password' => [
        'letters' => 'Le :attribute doit au moins contenir  une lettre.',
        'mixed' => 'Le :attribute doit au moins contenir  une lettre majuscule et une lettre minuscule.',
        'numbers' => 'Le :attribute doit au moins contenir  un numéro.',
        'symbols' => 'Le :attribute doit au moins contenir  un symbole.',
        'uncompromised' => 'Le :attribute donné est apparu dans une fuite de données.Veuillez choisir un autre :attribute.',
    ],

    'present' => 'Le :attribute field doit être present.',
    'regex' => "Le :attribute format n'est pas valide",
    'required' => 'Le :attribute est requis(e).',
    'required_if' => 'Le :attribute est requis lorsque :other est :value.',
    'required_unless' => 'Le :attribute est requis à moins que :other soit dans :values.',
    'required_with' => 'Le :attribute est requis lorsque :values est present.',
    'required_with_all' => 'Le :attribute est requis lorsque :values est present.',
    'required_without' => "Le :attribute est requis lorsque :values n'est pas present.",
    'required_without_all' => 'Le :attribute est requis quand aucun de :values est present.',
    'same' => 'Le :attribute et :other doit correspondre.',
    'size' => [
        'numeric' => 'Le :attribute doit être :size.',
        'file' => 'Le :attribute doit être :size kilo-octets.',
        'string' => 'Le :attribute doit être :size caractères.',
        'array' => 'Le :attribute must contain :size elements.',
    ],
    'starts_with' => "Le :attribute doit commencer par l'un des following: :values.",
    'string' => 'Le :attribute doit être une chaines de caractères.',
    'timezone' => 'Le :attribute doit être une zone valide.',
    'today' => 'aujourd’hui.',
    'tomorrow' => 'demain.',
    'unique' => 'Ce :attribute est deja utilisé.',
    'uploaded' => "Le :attribute n'a pas pu être téléchargé",
    'url' => "Le :attribute format n'est pas valide",
    'uuid' => 'Le :attribute doit être un UUID valide.',
    'mixedCase' => 'le :attribute doit avoir au moins  une lettre minuscule et une lettre majuscule',
    'numbers' => 'le :attribute doit avoir au moins un chiffre',
    'symbols' => 'le :attribute doit avoir au moins un symbole',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'nom',
        'address' => 'adresse',
        'password' => 'mot de passe',
        'city' => 'ville',
        'phone' => 'numéro de telephone',
        'validated' => 'validation',
        'created_by' => 'créateur',
        'old_password' => 'ancien mot de passe',
        'new_password' => 'nouveau mot de passe',
        'user_id' => 'utilisateur',
        'employee_id' => 'employé',
        'description' => 'description',
        'date' => 'date',
        'quantity' => 'quantité',
        'asset_id' => 'actif',
        'fee' => 'frais',
        'gender' => 'genre',
        'company' => 'entreprise',
        'completed' => 'complet',
        'deleted_at' => 'supprimé à',
        'created_at' => 'créé à',
        'updated_at' => 'mis à jour à',
        'number' => 'numéro',
        'status' => 'statut',
        'type' => 'type',
        'days' => 'jours',
        'description' => 'description',
        'file' => 'fichier',
        'location' => 'emplacement',
        'vacancies' => 'postes vacants',
        'experience' => 'expérience',
        'age' => 'âge',
        'salary_from' => 'salaire de',
        'salary_to' => 'salaire à',
        'checkin' => 'arrivée',
        'checkout' => 'départ',
        'subject' => 'sujet',
        'tk_id' => 'identifiant TK',
        'priority' => 'priorité',
        'cc' => 'cc',
        'followers' => 'suiveurs',
        'files' => 'fichiers',
        'start_date' => 'date de début',
        'expire_date' => 'date d\'expiration',
        'inv_id' => 'ID de la facture',
        'customer_id' => 'client',
        'tax_id' => 'taxe',
        'project_id' => 'projet',
        'department_id' => 'department',
        'email' => 'email',
        'address' => 'adresse du client',
        'billing_address' => 'adresse de facturation',
        'invoice_date' => 'date de la facture',
        'due_date' => 'date d\'échéance',
        'items' => 'articles',
        'note' => 'note',
        'discount' => 'remise',
        'total' => 'total',
        'employee_share_amount' => 'montant de la part de l\'employé',
        'org_share_amount' => 'montant de la part de l\'organisation',
        'employee_share_percent' => 'pourcentage de part de l\'employé',
        'org_share_percent' => 'pourcentage de part de l\'organisation',
        'percentage' => 'pourcentage',
        'purchased_from' => 'acheté de',
        'purchased_date' => 'date d\'achat',
        'payment_method' => 'méthode de paiement',
        'purchase_date' => 'date d\'achat',
        'purchase_from' => 'acheté de',
        'manufacturer' => 'fabricant',
        'model' => 'modèle',
        'serial_number' => 'numéro de série',
        'condition' => 'état',
        'warranty' => 'garantie',
        'value' => 'valeur',
        'description' => 'description',
        'status' => 'statut',
        'supplier' => 'fournisseur',
        'designation_id' => 'désignation',
    ],
];
