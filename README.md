# 🎓 Projet de Stage d'Initiation — match job  Platform

> Projet réalisé par **Nora El-Fettouchi** — Étudiante 1ère année cycle ingénieur  
> Stage d'initiation · 2025

---

## 📌 Description du projet

Ce projet est une **application web de recommandation de carrière** pour les étudiants. Il combine un **front-end HTML/CSS**, un **back-end PHP**, une **base de données MySQL/SQLite**, et un **traitement de données Python** basé sur des datasets réels pour analyser les profils étudiants et suggérer des parcours professionnels adaptés.

L'objectif principal : aider les étudiants à trouver leur voie en analysant leurs centres d'intérêt et en les associant à des filières ou métiers correspondants.

---

## 🗂️ Structure du projet

```
projet_stage/
│
├── page.html              # Page d'accueil du site
├── login.html             # Page de connexion
├── signup.html            # Page d'inscription
├── apropos.html           # Page "À propos" du projet
│
├── fichier_css.css        # Feuille de styles globale (thème mauve/violet)
│
├── code_php.php           # Script PHP : gestion de l'inscription utilisateur
│
├── code.py                # Script Python : chargement, fusion et export des datasets
├── requirements.txt       # Dépendances Python (pandas)
│
├── stud_with_job_id.csv   # Dataset principal : étudiants + centres d'intérêt + job_id
├── users.db               # Base de données SQLite des utilisateurs
│
├── image1.jpg             # Images utilisées dans le site
├── imaga2.jpg
│
├── .vscode/
│   └── launch.json        # Configuration de débogage VS Code (Chrome)
│
└── CV/                    # Documents personnels (stage)
    ├── CV_ EL_fettouchi NORA.pdf
    ├── CV DE STAGE[1].docx
    ├── Attestation de stage.pdf
    ├── Demande de stage 1-ème année cycle ingénieur.docx
    └── what do u have to doby the end of this year.txt
```

---

## 🔍 Fonctionnement détaillé

### 1. Interface Web (HTML + CSS)

Le site contient 4 pages principales :

| Page | Fichier | Rôle |
|------|---------|------|
| Accueil | `page.html` | Présentation générale, navigation, liens sociaux |
| Connexion | `login.html` | Formulaire email + mot de passe |
| Inscription | `signup.html` | Formulaire complet (nom, prénom, email, mdp) |
| À propos | `apropos.html` | Description du projet et ses objectifs |

Le design utilise un **thème violet/mauve** avec des fonds d'images en plein écran (`background-size: cover`), des boutons arrondis, et des sections semi-transparentes pour une bonne lisibilité.

---

### 2. Back-end PHP (`code_php.php`)

Ce fichier gère l'**inscription des utilisateurs** :

- Se connecte à une base de données MySQL via **PDO**
- Récupère et **nettoie** les données du formulaire (`htmlspecialchars`, `trim`)
- Vérifie que les **deux mots de passe** correspondent
- Vérifie que **l'email n'existe pas déjà** dans la base
- **Hache le mot de passe** avec `password_hash()` avant de le stocker
- Insère le nouvel utilisateur dans la table `utilisateurs`
- Redirige vers `login.html` après une inscription réussie

>  La connexion à la base est configurée pour un environnement local (XAMPP/WAMP). Modifier `$dbname` selon votre configuration.

---

### 3. Traitement des données Python (`code.py`)

Ce script réalise un **pipeline de données** :

1. **Charge 3 datasets CSV** (`cs_student`, `dataset`, `mldata`) contenant des profils d'étudiants
2. **Normalise les colonnes** (minuscules, espaces supprimés, caractères spéciaux retirés)
3. **Fusionne les 3 datasets** via une jointure externe (`outer merge`) sur la clé commune `job_id`
4. **Exporte** la fusion en un fichier `fusion_outer.csv`
5. **Transfère les données** vers une base de données MySQL (tables `cs_students`, `dataset`, `mldata`)

---

### 4. Dataset principal (`stud_with_job_id.csv`)

Ce fichier CSV contient des données d'étudiants encodées en **one-hot encoding** :

- Chaque colonne représente un **centre d'intérêt** (Drawing, Dancing, Coding, Mathematics, etc.) → valeur `0` ou `1`
- La colonne `job_id` associe chaque profil à une **filière/métier recommandé** (ex: `j013` = BBA, `j004` = BEM)
- Ce dataset sert de **base d'entraînement** pour un futur modèle de recommandation

---

## ⚙️ Installation et lancement

### Prérequis

- **Python 3.x** avec pip
- **XAMPP** (ou WAMP/MAMP) pour PHP et MySQL
- Un navigateur web moderne

### Étapes

```bash
# 1. Installer les dépendances Python
pip install -r requirements.txt
# ou manuellement :
pip install pandas sqlalchemy pymysql

# 2. Lancer le script de données
python code.py

# 3. Démarrer XAMPP (Apache + MySQL)
# Placer les fichiers HTML/PHP dans htdocs/
# Accéder à http://localhost/page.html
```

### Configuration de la base de données

Dans `code_php.php`, modifier :
```php
$dbname = 'nom_de_ta_base'; // ← mettre le vrai nom
$user   = 'root';
$pass   = '';               // ← adapter si mot de passe défini
```

Dans `code.py`, modifier si besoin :
```python
username = "root"
password = ""
database = "bd_stage"
```

---

## 🧰 Technologies utilisées

| Technologie | Usage |
|-------------|-------|
| HTML5 | Structure des pages web |
| CSS3 | Design, responsive, thème violet |
| PHP (PDO) | Inscription, connexion base de données |
| Python (pandas, SQLAlchemy) | Traitement et fusion de datasets |
| MySQL | Stockage des données utilisateurs et étudiants |
| SQLite (`users.db`) | Base locale légère |
| Font Awesome 6.5 | Icônes réseaux sociaux |
| Git / GitHub | Versioning du projet |

---

## 📚 Compétences acquises

Ce stage d'initiation a permis de mettre en pratique :

- La **création de pages web** statiques et dynamiques (HTML, CSS, PHP)
- La **gestion d'une base de données** relationnelle (MySQL via PDO et SQLAlchemy)
- Le **traitement et la fusion de données** avec pandas
- Les bases du **pipeline Data Science** (chargement → nettoyage → fusion → export → BDD)
- L'utilisation de **Git** pour versionner un projet
- La sécurité basique : hachage de mot de passe, validation côté serveur

---

## 👩‍💻 Auteure

**Nora El-Fettouchi**  
Étudiante — 1ère année cycle ingénieur  
📧 nora.elfettouchi.23@ump.ac.ma  
🔗 [GitHub](https://github.com/NORAel-fettouchi)

---

## 📄 Licence

Projet réalisé dans le cadre d'un stage d'initiation académique. Usage personnel et éducatif.
