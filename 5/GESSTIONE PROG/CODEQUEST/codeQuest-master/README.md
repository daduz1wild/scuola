# CodeQuest - RPG Educativo di Programmazione

## Panoramica

CodeQuest è un RPG educativo 2D pixel-art basato su programmazione, sviluppato con Phaser 3.

Insegna coding attraverso esplorazione narrativa, puzzle interattivi, combattimenti basati su snippet di codice e progressione per linguaggi.

## Struttura del Progetto

```
codeQuest/
├── index.html                    # Entry point del gioco
├── README.md                     # Questo file
├── assets/
│   ├── css/
│   │   └── admin.css             # Stili Admin Panel
│   └── images/                   # Asset grafici (futuri)
├── js/
│   ├── main.js                   # Bootstrap Phaser + configurazione
│   ├── engine/
│   │   └── phaser.js             # Proxy import Phaser 3 (CDN)
│   ├── input/
│   │   └── input.js              # Gestione input (WASD + E)
│   ├── player/
│   │   └── player.js             # Controller giocatore
│   ├── npc/
│   │   ├── npc.js                # NPC base (sprite + dialogo semplice)
│   │   └── npcAdvanced.js        # NPC avanzato (dialoghi branching, hints, ARA)
│   ├── scene/
│   │   ├── baseScene.js          # Scene base (game loop, input, interazione)
│   │   └── exampleScene.js       # Scene di esempio/demo
│   ├── scenes/
│   │   ├── menuScene.js          # Menu principale (nuova partita, continua, admin)
│   │   └── chapterScene.js       # Scene dei 5 capitoli (gameplay completo)
│   ├── ui/
│   │   ├── dialogSystem.js       # Sistema dialoghi con typing effect e scelte
│   │   ├── hud.js                # HUD (HP, XP, livello, capitolo, ARA)
│   │   └── codeEditor.js         # Editor codice per puzzle interattivi
│   ├── coding/
│   │   └── challengeEngine.js    # Engine validazione snippet (5 linguaggi)
│   ├── combat/
│   │   └── combatSystem.js       # Sistema combattimento basato su codice
│   ├── ara/
│   │   └── araSystem.js          # Antagonista ARA (AI corrotta, manipolazione)
│   └── data/
│       ├── gameState.js          # Stato globale del gioco (singleton)
│       ├── saveSystem.js         # Salvataggio/caricamento (localStorage)
│       └── chapterData.js        # Dati completi dei 5 capitoli
└── php/
    ├── config/
    │   ├── database.php          # Connessione MySQL
    │   └── schema.sql            # Schema database
    ├── admin/
    │   ├── index.php             # Login admin
    │   ├── dashboard.php         # Dashboard admin (HTML)
    │   ├── dashboard.js          # Logica dashboard (JS frontend)
    │   └── logout.php            # Logout admin
    └── api/
        ├── log_event.php         # API: registra eventi gameplay
        ├── get_students.php      # API: lista studenti
        ├── get_logs.php          # API: log eventi
        └── get_analytics.php     # API: analytics educativi
```

## I 5 Capitoli

| # | Linguaggio | Boss | Mentore |
|---|-----------|------|---------|
| 1 | HTML + CSS | Il Tag Orfano | Mentore |
| 2 | JavaScript | Il Bug Infinito | Luna |
| 3 | PHP + MySQL | SQL Phantom | Max |
| 4 | MS-DOS + Bash | Il Rootkit | Ivy |
| 5 | C++ + C | ARA::CORE | Mentore + Luna |

## Controlli

| Tasto | Azione |
|-------|--------|
| W/A/S/D | Movimento |
| E | Interagisci (NPC, puzzle, boss) |
| SPAZIO | Avanza dialogo |
| CTRL+ENTER | Esegui codice (editor) |
| ESC | Chiudi editor |
| S | Salva partita |

## Admin Panel

Accesso: `php/admin/index.php`
- Default: `admin` / `codequest2026`
- Dashboard con statistiche studenti
- Analytics errori e performance
- Timeline progressi individuali
- Log eventi in tempo reale

## Setup Database

Il database usato è `ga_accessi`. Per inizializzare le tabelle:

```bash
mysql -u root -p < php/config/schema.sql
```

**Default Admin:**
- Username: `admin`
- Password: `codequest2026`

## Architettura

- **Game Engine**: Phaser 3 (CDN)
- **Moduli**: ES6 modules (no build step)
- **Storage**: localStorage (client) + MySQL (server)
- **Pattern**: Singleton (GameState, ARA), Template Method (Scene), Strategy (Input, ChallengeEngine)
- **Design**: Modular, extensible, educational-first

## Loop Educativo

```
Narrativa → Problema Coding → Snippet → Soluzione → Feedback → Progressione
```
