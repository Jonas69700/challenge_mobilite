# 🚀 Guide Utilisateur – Challenge Mobilité

Bienvenue sur l’application **Challenge Mobilité** !  
Cette plateforme permet de suivre vos déplacements doux (vélo, marche) dans le cadre d’un challenge d’entreprise ou associatif.

---

## Accès à l’application

1. **URL de l’application**  
   [https://challenge-mobilite.onrender.com](https://challenge-mobilite.onrender.com)

2. **Connexion / Inscription**
   - Cliquez sur **"Log in"** ou **"Register"**.
   - Remplissez vos informations (nom, email, mot de passe).
   - Une fois connecté, vous êtes redirigé vers votre **tableau de bord**.

---

## Fonctions principales

### Déclarer une activité
- Allez dans l’onglet **"Activités"**.
- Remplissez le formulaire :
  - **Type** : `vélo` ou `marche`
  - **Distance** : en kilomètres (vélo) ou en pas (marche)
- Cliquez sur le bouton **"Enregistrer l'activité"**

---

### Voir les classements
Rendez-vous dans **"Classements"** pour voir :

- **Ma position** dans le classement
- **Classement individuel** : Top 10 + tous les utilisateurs
- **Classement par équipe** :
  - Distance totale parcourue
  - Moyenne par membre
- **Statistiques globales** :
  - Nombre d’utilisateurs
  - Distance totale
  - Moyenne par utilisateur

---

## Fonctions Admin (si vous êtes administrateur)

Accessible via l’onglet **"Admin"** :

- Voir la liste des utilisateurs
- Modifier ou supprimer un utilisateur
- Attribuer un rôle administrateur
- Exporter les données du challenge en **CSV**

---

## API Publique (développeurs)

Les endpoints suivants sont disponibles au format JSON :

| Endpoint | Description |
|----------|-------------|
| `GET /api/stats/general` | Statistiques globales |
| `GET /api/stats/teams` | Classement des équipes |
| `GET /api/stats/users` | Classement des utilisateurs |
| `GET /api/activities` | Liste des activités (pagination incluse) |
| `GET /api/activities/user/{id}` | Activités d’un utilisateur |

---

## Recommandations

- Déclarez vos trajets régulièrement.
- Utilisez une adresse e-mail valide.
- Restez honnête – le but est de promouvoir la **mobilité douce**