/**
 * ================================================
 * CODEQUEST - MAIN ENTRY POINT
 * ================================================
 * 
 * DESCRIZIONE:
 * Punto di ingresso principale per il gioco CodeQuest.
 * Inizializza l'istanza di Phaser e configura le impostazioni globali.
 * Carica le tre scene principali: Boot, Menu e Chapter.
 * 
 * FUNZIONAMENTO:
 * 1. Importa Phaser e le tre scene principali
 * 2. Configura le proprietà di Phaser (dimensioni, fisica, scaling)
 * 3. Crea l'istanza del gioco con la configurazione
 * 4. Esporta l'istanza per l'uso nel resto dell'applicazione
 * 
 * DIPENDENZE:
 * - Phaser 3.x
 * - BootScene: scene iniziale per il caricamento risorse
 * - MenuScene: menu principale del gioco
 * - ChapterScene: scene del capitolo/missione
 */

import Phaser from './engine/phaser.js';
import BootScene from './scenes/BootScene.js';
import MenuScene from './scenes/MenuScene.js';
import ChapterScene from './scenes/ChapterScene.js';

/**
 * CONFIGURAZIONE PHASER
 * Defini qui tutte le proprietà del gioco:
 * - Dimensioni: 1024x768 pixel
 * - Tipo di rendering: AUTO (sceglie il migliore disponibile)
 * - Colore sfondo: blu scuro (#0a0e17)
 * - Physics: Arcade (2D simpler, adatto per giochi 2D)
 * - Scale mode: RESIZE (adatta al contenitore)
 */
const config = {
    type: Phaser.AUTO,
    width: 1024,
    height: 768,
    parent: 'game-container',  // Elemento HTML che contiene il canvas
    backgroundColor: '#0a0e17',  // Colore di sfondo scuro
    pixelArt: true,  // Disabilita smoothing per sprite pixelart
    physics: {
        default: 'arcade',  // Usa la fisica Arcade
        arcade: {
            gravity: { y: 0 },  // Nessuna gravità verticale (visione top-down)
            debug: false  // Disabilita visualizzazione debug
        }
    },
    scale: {
        mode: Phaser.Scale.RESIZE,  // Ridimensiona il gioco in base alla finestra
        autoCenter: Phaser.Scale.CENTER_BOTH  // Centra il canvas
    },
    // Array delle scene nel loro ordine di esecuzione
    scene: [BootScene, MenuScene, ChapterScene]
};

/**
 * CREAZIONE ISTANZA GIOCO
 * Crea l'istanza principale di Phaser con la configurazione sopra
 */
const game = new Phaser.Game(config);

// Esporta l'istanza per uso in altri moduli se necessario
export default game;
