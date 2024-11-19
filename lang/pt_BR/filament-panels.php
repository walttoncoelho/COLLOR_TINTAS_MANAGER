<?php

return [
    'pages' => [
        'dashboard' => [
            'title' => 'Dashboard',
        ],
    ],

    'resources' => [
        'label' => 'Recursos',
        'plural_label' => 'Recursos',
    ],

    'actions' => [
        'cancel' => [
            'label' => 'Cancelar',
        ],
        'create' => [
            'label' => 'Novo',
            'modal' => [
                'heading' => 'Criar :label',
                'actions' => [
                    'create' => [
                        'label' => 'Criar',
                    ],
                    'create_another' => [
                        'label' => 'Criar e criar outro',
                    ],
                ],
            ],
        ],
        'edit' => [
            'label' => 'Editar',
            'modal' => [
                'heading' => 'Editar :label',
                'actions' => [
                    'save' => [
                        'label' => 'Salvar',
                    ],
                ],
            ],
        ],
        'view' => [
            'label' => 'Visualizar',
            'modal' => [
                'heading' => 'Visualizar :label',
            ],
        ],
        'delete' => [
            'label' => 'Excluir',
            'modal' => [
                'heading' => 'Excluir :label',
                'actions' => [
                    'confirm' => [
                        'label' => 'Sim, excluir',
                    ],
                ],
            ],
        ],
    ],
];