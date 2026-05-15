/**
 * BootScene - CodeQuest
 * Prepares assets and initializes global game state.
 */

import Phaser from '../engine/phaser.js';
import { AssetGenerator } from '../engine/AssetGenerator.js';
import { GameState } from '../engine/GameState.js';
import { SaveSystem } from '../engine/SaveSystem.js';

export default class BootScene extends Phaser.Scene {
    constructor() {
        super('BootScene');
    }

    preload() {
        this.load.image('bg_lab', 'assets/images/bg_lab.png');
        this.load.spritesheet('tileset', 'assets/images/tileset.png', { frameWidth: 32, frameHeight: 32 });
        
        const w = this.cameras.main.width;
        const h = this.cameras.main.height;
        const barW = 200, barH = 4, barX = w/2 - barW/2, barY = h/2 + 30;
        const bar = this.add.graphics();
        
        this.load.on('progress', (v) => {
            bar.clear();
            bar.fillStyle(0x1a2744, 1);
            bar.fillRect(barX, barY, barW, barH);
            bar.fillStyle(0x00d4ff, 1);
            bar.fillRect(barX, barY, barW * v, barH);
        });
    }

    async create() {
        // Sincronizza la sessione di login con lo stato del gioco
        const sessionId = localStorage.getItem('cq_student_id');
        console.log('[BOOT] SessionId from localStorage:', sessionId);
        if (sessionId) {
            GameState.studentId = sessionId;
            // Forza il sync dal DB per avere i dati aggiornati
            await GameState.syncFromDb();
        } else {
            // Carica lo stato del gioco salvato localmente solo se non c'è sessionId (modalità guest)
            const savedState = SaveSystem.load();
            console.log('[BOOT] SaveSystem.load() returned:', savedState);
            if (savedState) {
                GameState.restore(savedState);
                console.log('[BOOT] Game State restored from localStorage');
            } else {
                console.log('[BOOT] No save data found in localStorage');
            }
        }

        // Genera tutti gli asset procedurali rimanenti
        await AssetGenerator.generateAll(this);

        const w = this.cameras.main.width;
        const h = this.cameras.main.height;
        
        // Final transition
        this.time.delayedCall(500, () => {
            this.scene.start('MenuScene');
        });
    }
}
