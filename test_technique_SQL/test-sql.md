# Test technique (SQL)

## Description

Nous avons deux tables en base de donnée:

### Artisan (`artisan`)

Un ouvrier en batiment.

| id | name      |
|----|-----------|
| 1  | SuperElec |
| 2  | MegaPool  |

### UserReview (`user_review` lié à la table aritsan par artisan_id)

Un avis d'un particulier sur l'ouvrier en batiment.

| id | artisan_id | author   | grade | comment           | review_date         |
|----|------------|----------|-------|-------------------|---------------------|
| 1  |     1      | Paul     |  4    | Super electricien | 05/02/2020 15:02:11 |
| 2  |     2      | Michel   |  2    | Ouai bof          | 05/02/2020 15:02:11 |
| ...|            |          |       |                   |                     |


## Objectif

Faire une requete SQL pour retourner les 3 `UserReview` les plus récentes pour chacun des `Artisan`.
