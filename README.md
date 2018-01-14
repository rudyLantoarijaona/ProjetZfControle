# ProjetZfControle
# Rudy LANTOARIJAONA - 4A IW2
* Projet liste de meetups utilisant Zend Framework 3 + Doctrine


* /!\ **Rewrite : Il se peut que la réecriture ne s'effectue pas correctement. (Mon cas) il faut daonc ajouter "index.php"(Ex : index.php/meetup) à la page home afin que les liens fonctionnent** /!\

* Installation du projet :
     * 1 -Cloner le projet
     * 2 - Se rendre à la racine du projet avec le terminal
     * 3 - Lancer les commandes suivantes :
        * composer install
        * docker compose up -d --build
     * 4 - Pour la base de données lancer les commandes suivantes :
        * docker-compose run --rm zf php vendor/bin/doctrine-module orm:info - ( Retirer php sous Windows)
          * Cette commande de vérifier que notre entité exsite
        * php vendor/bin/doctrine-module orm:schema-tool:update --force ( Retirer php sous Windows)
     * 5 - L'application est maintenant prête a étre utilisé à l'adresse http://localhost:8080

* Routes :
  * Home (/) : Affiche la liste des meetups disponibles.
  * Add a meetup (/new) : Affiche le formulaire d'ajout d'un meetup.
  * Meetup page (/meetup/:id) : Affiche les détails sur un meetup.
  * Update meetup page (/meetup/:id/update) : Affiche le formulaire de modification du meetup.
  

* PS : La vérification de la date n'a pas été gérer car je n'ai pas réussi à le faire. Par conséquent j'ai préférer retirer ce code afin d'éviter d'avoir du code mort. Mais pour vous prouver que j'avais bien l'intention de le faire voici un bout de  code qui permet la verification de la date :
    
        const DATE_START_POST = 'dateStart';
        const DATE_END_POST = 'dateEnd';
        'dateStart' => [           
                    'validators' => [
                    [
                        'name' => 'Callback',
                        'options' => [
                            'callback' => [$this, 'checkDate'],
                            'callbackOptions' => [
                                'compare' => 'dateEnd'
                            ],
                            'messages' => [
                                Validator\Callback::INVALID_VALUE => 'La date de début doit être avant la date de fin.',
                            ]
                        ],
                    ],
                ],
            ],
            'dateEnd' => [
                    'validators' => [
                    [
                        'name' => 'Callback',
                        'options' => [
                            'callback' => [$this, 'checkDate'],
                            'callbackOptions' => [
                                'compare' => 'dateStart'
                            ],
                            'messages' => [
                                Validator\Callback::INVALID_VALUE => 'La date de fin ne peut pas être avant la date de debut.',
                            ]
                        ],
                    ],
                ],
            ],*/
            
        ];
         }
         public function checkDate($value, $context, $compare)
        {
        
        if ($compare === self::DATE_START_POST || $compare === self::DATE_END_POST) {
            $currentDate = new \DateTime($value);
            $compareDate = new \DateTime($context[$compare]);
         
        }
        return false;
         }

In progress...
