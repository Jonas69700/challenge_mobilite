# Challenge Mobilité - Laravel 12

Application de gestion de challenge mobilité en entreprise.  
Les employés peuvent déclarer leurs trajets (vélo / marche), voir leur classement individuel et celui de leur équipe.

---

## Technologies

- Laravel 12 (Breeze avec Blade)
- MySQL
- Tailwind CSS
- Chart.js
- API RESTful (format JSON standardisé)
- Export CSV
- Interface Admin

---

## Fonctionnalités principales

- Déclaration d’activités (1 par jour)
- Conversion automatique des pas → kilomètres
- Classements :
  - Général (top 10 & complet)
  - Par équipe (total & moyenne)
  - Statistiques globales
- Tableau de bord personnel
- Admin : gestion des utilisateurs et export CSV
- API publique avec endpoints REST

---

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/Jonas69700/challenge_mobilite.git
cd challenge-mobilite
```

### 2. Installer les dépendances

```bash
composer install
npm install && npm run build
```

### 3. Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Configurez la base de données dans `.env` :

```
DB_DATABASE=challenge
DB_USERNAME=votre_user_db
DB_PASSWORD=votre_passwd_db
```

### 4. Lancer les migrations + seeders

```bash
php artisan migrate --seed
```

### 5. Démarrer le serveur et le client

```bash
php artisan serve
npm run dev
```

---

## Admin par défaut (base seedée)

- Email : `admin@admin.com`
- Mot de passe : `password`

Modifiable dans `database/seeders/UserSeeder.php`.

---

## API REST

Voir la documentation complète ici :  
[`/public/docs`]

Format de réponse :
```json
{
  "status": "success",
  "data": {...},
  "meta": {...}
}
```

---

## Tests

À venir :  
- Tests unitaires Laravel
- Tests des endpoints API avec Pest ou PHPUnit

---

## Déploiement

Compatible avec Railway
Prévoir :
- `.env.production`
- Base de données distante (Railway)

---

## Contribution

Pull requests bienvenues !  
Structure du code claire avec séparation des contrôleurs Web/API, services, seeders.

---

## Licence

MIT © 2025 - Jonas Flacher / démonstration