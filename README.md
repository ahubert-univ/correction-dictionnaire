
# Mon dictionnaire

Travail à réaliser:

- Cloner votre repository personnel
-  Créer Les entitées en suivant le schema ( attention on passe du snake_case ou camelCase)
   voir le fichier bdd_schema.png dans le repository

-  Créer une migration
- Ajouter à votre migration 3 entrées dans la table langue
- Ajouter 2 entrées  dans la table dictionary ( pour des tests !!)
- Créer une classe DictionaryMapper
    - avec un function map()
    - Cette fonction renvoie un objet Dictionary  instancié et initialisé avec les valeurs (on dit "mappé")
    - Paramètre en entrée
        - string $word,
        - string $translation,
        - Language $sourceLanguage,
        - Language $translationLanguage,
        - ?Dictionary $dictionary = null
- Créer une classe DictionaryService
    - Créer 3 methode create,update,delete
    - retrouver les parametres avec le controller !

- Commiter et pusher votre fichier AVANT LE 22 OCTOBRE (23h59)
