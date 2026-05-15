/**
 * MenuScene - CodeQuest
 * Stylized main menu with chapter navigation and cyberpunk effects.
 */

import Phaser from '../engine/phaser.js';
import BaseScene from '../scene/baseScene.js';
import { GameState } from '../engine/GameState.js';
import { SaveSystem } from '../engine/SaveSystem.js';

export default class MenuScene extends BaseScene {
    constructor() {
        super('MenuScene');
    }

    create() {
        const w = this.cameras.main.width;
        const h = this.cameras.main.height;

        this.createSciFiBackground(w, h);

        this._buildTitle(w, h);
        this._buildChapterNav(w, h);
        this._buildMenuButtons(w, h);
        this._buildFooter(w, h);

        this.cameras.main.fadeIn(800, 2, 4, 8);
    }

    _buildTitle(w, h) {
        const titleContainer = this.add.container(w / 2, h * 0.18);

        const hexBg = this.add.graphics();
        hexBg.lineStyle(1, 0x00d4ff, 0.15);
        for (let i = 0; i < 5; i++) {
            const size = 200 + i * 60;
            hexBg.strokeCircle(0, 0, size);
        }
        titleContainer.add(hexBg);

        this.tweens.add({ targets: hexBg, alpha: 0.3, duration: 4000, yoyo: true, repeat: -1 });

        const title = this.add.text(0, -20, 'CODEQUEST', {
            fontFamily: "'Courier New', monospace", fontSize: '68px', color: '#00d4ff',
            fontStyle: 'bold', letterSpacing: 8
        }).setOrigin(0.5);
        title.setShadow(0, 0, '#00d4ff', 15, true, 0.5);
        titleContainer.add(title);

        this.tweens.add({
            targets: title, scaleX: 1.01, scaleY: 1.01,
            duration: 3000, yoyo: true, repeat: -1, ease: 'Sine.easeInOut'
        });

        const subtitle = this.add.text(0, 40, 'THE CODE AWAITS', {
            fontFamily: "'Courier New', monospace", fontSize: '16px', color: '#667788',
            letterSpacing: 6
        }).setOrigin(0.5);
        titleContainer.add(subtitle);
    }

    _buildChapterNav(w, h) {
        const container = this.add.container(w / 2, h * 0.35);
        const chapters = [
            { name: 'HTML/CSS', color: 0x10b981, icon: '<>' },
            { name: 'JAVASCRIPT', color: 0xa855f7, icon: '{}' },
            { name: 'PHP/SQL', color: 0xf97316, icon: '<?' },
            { name: 'BASH', color: 0x10b981, icon: '$>' },
            { name: 'C++', color: 0x888888, icon: '++' }
        ];

        chapters.forEach((ch, i) => {
            const bx = (i - 2) * 145;
            const badge = this.add.container(bx, 0);

            const bg = this.add.graphics();
            bg.fillStyle(ch.color, 0.08);
            bg.fillRect(-55, -14, 110, 28);
            bg.lineStyle(1, ch.color, 0.3);
            bg.strokeRect(-55, -14, 110, 28);
            badge.add(bg);

            const icon = this.add.text(-38, 0, ch.icon, {
                fontFamily: "'Courier New', monospace", fontSize: '12px',
                color: Phaser.Display.Color.IntegerToColor(ch.color).rgba
            }).setOrigin(0, 0.5);
            badge.add(icon);

            const label = this.add.text(-20, 0, ch.name, {
                fontFamily: "'Courier New', monospace", fontSize: '11px',
                color: Phaser.Display.Color.IntegerToColor(ch.color).rgba, letterSpacing: 1
            }).setOrigin(0, 0.5);
            badge.add(label);

            container.add(badge);
        });
    }

    _buildMenuButtons(w, h) {
        const menuY = h * 0.52;
        const hasSave = SaveSystem.hasSave();
        const buttonText = hasSave ? '[ 1 ] CONTINUE GAME' : '[ 1 ] NEW GAME';
        const buttonColor = hasSave ? '#00d4ff' : '#10b981';
        const buttonCallback = hasSave ? () => this.continueGame() : () => this.newGame();

        this.createButton(w / 2, menuY, 340, 52, buttonText, buttonColor, buttonCallback);
        this.createButton(w / 2, menuY + 80, 340, 52, '[ 2 ] CREDITS', '#667788', () => this.showCredits());
    }

    _buildFooter(w, h) {
        const studentName = localStorage.getItem('cq_student_name') || 'GUEST';
        const footerText = `CONNECTED AS: ${studentName.toUpperCase()} | WASD MOVE | E INTERACT`;
        const footer = this.add.text(w / 2, h - 25, footerText, {
            fontFamily: "'Courier New', monospace", fontSize: '11px', color: '#334455', letterSpacing: 2
        }).setOrigin(0.5);

        this.tweens.add({ targets: footer, alpha: 0.3, duration: 2000, yoyo: true, repeat: -1 });
    }

    newGame() {
        if (SaveSystem.hasSave()) {
            this._showOverwriteConfirm();
        } else {
            this._startFreshGame();
        }
    }

    _showOverwriteConfirm() {
        const w = this.cameras.main.width;
        const h = this.cameras.main.height;

        const overlay = this.add.container(0, 0).setDepth(2000);
        const bg = this.add.rectangle(0, 0, w, h, 0x020408, 0.9).setOrigin(0);
        overlay.add(bg);

        const card = this.add.container(w/2, h/2);
        overlay.add(card);

        const cardBg = this.add.graphics();
        cardBg.fillStyle(0x0a1628, 1);
        cardBg.lineStyle(2, 0xef4444, 1);
        cardBg.fillRect(-250, -100, 500, 200);
        cardBg.strokeRect(-250, -100, 500, 200);
        card.add(cardBg);

        const warnText = this.add.text(0, -40, "SOVRASCRIVERE SALVATAGGIO?", {
            fontFamily: 'Orbitron', fontSize: '18px', color: '#ef4444'
        }).setOrigin(0.5);
        card.add(warnText);

        const descText = this.add.text(0, 0, "I progressi locali e sul server verranno persi.", {
            fontFamily: 'Inter', fontSize: '14px', color: '#94a3b8'
        }).setOrigin(0.5);
        card.add(descText);

        const btnConfirm = this.createButton(-110, 60, 180, 40, "CONFERMA", "#ef4444", () => {
            this._resetAllProgress();
            overlay.destroy();
        });
        card.add(btnConfirm);

        const btnCancel = this.createButton(110, 60, 180, 40, "ANNULLA", "#00d4ff", () => {
            overlay.destroy();
        });
        card.add(btnCancel);
    }

    async _resetAllProgress() {
        const studentId = localStorage.getItem('cq_student_id');
        
        // 1. Local Reset
        SaveSystem.clear();
        GameState.reset();

        // 2. Server Reset
        if (studentId) {
            try {
                await fetch('php/api/reset_progress.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ studentId })
                });
            } catch (e) { console.error("Server reset failed", e); }
        }

        this._startFreshGame();
    }

    _startFreshGame() {
        GameState.reset();
        SaveSystem.save();
        this.cameras.main.fadeOut(600, 2, 4, 8);
        this.time.delayedCall(600, () => this.scene.start('ChapterScene', { chapterIndex: 1 }));
    }

    continueGame() {
        const saveData = SaveSystem.load();
        if (saveData) {
            GameState.restore(saveData);
            this.cameras.main.fadeOut(600, 2, 4, 8);
            this.time.delayedCall(600, () => this.scene.start('ChapterScene', { chapterIndex: GameState.currentChapter || 1 }));
        } else {
            this.showNotification('NESSUN SALVATAGGIO TROVATO', '#ef4444', 2000);
        }
    }

    showCredits() {
        this.showNotification('CODEQUEST v1.0.0 // 2026', '#00d4ff');
    }
}
