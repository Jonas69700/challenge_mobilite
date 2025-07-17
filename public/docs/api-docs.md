# API - Challenge Mobilité

Base URL : `http://localhost:8000/api`

---

## Authentification
> Tous les endpoints publics ne nécessitent pas d'auth pour le moment.  
> Si besoin d’auth à terme, prévoir un token ou une session.

---

## Statistiques

### `GET /api/stats/general`

**Description :** Statistiques globales du challenge (total utilisateurs, équipes, km, moyenne).

**Réponse :**
```json
{
  "status": "success",
  "data": {
    "total_users": 32,
    "total_teams": 5,
    "total_km": 873.2,
    "average_per_user": 27.3
  },
  "meta": null
}
```

---

### `GET /api/stats/teams`

**Description :** Classement des équipes par distance totale + moyenne.

**Réponse :**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Team Alpha",
      "members_count": 5,
      "total_km": 210.5,
      "average_km": 42.1
    }
    // ...
  ],
  "meta": null
}
```

---

### `GET /api/stats/users`

**Description :** Classement de tous les utilisateurs par distance.

**Réponse :**
```json
{
  "status": "success",
  "data": [
    {
      "id": 2,
      "name": "Alice",
      "total_km": 72.5
    }
    // ...
  ],
  "meta": null
}
```

---

## Activités

### `GET /api/activities`

**Description :** Liste paginée de toutes les activités enregistrées.

**Paramètres query :**
- `page` : numéro de page (ex: `?page=2`)

**Réponse :**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "user_id": 2,
      "type": "bike",
      "distance_km": 15.2,
      "date": "2025-07-17"
    }
    // ...
  ],
  "meta": {
    "total": 150,
    "page": 1,
    "per_page": 20
  }
}
```

---

### `GET /api/activities/user/{id}`

**Description :** Toutes les activités d’un utilisateur donné.

**Réponse :**
```json
{
  "status": "success",
  "data": [
    {
      "type": "walk",
      "steps": 3000,
      "distance_km": 2,
      "date": "2025-07-16"
    }
    // ...
  ],
  "meta": {
    "total": 8,
    "page": 1,
    "per_page": 20
  }
}
```

---

## Export

### `GET /admin/export/csv`

**Description :** Export global du challenge en CSV (admin uniquement)

---

## Fin
> Toutes les réponses suivent le format :
```json
{
  "status": "success" | "error",
  "data": ...,
  "meta": { optional }
}
```
