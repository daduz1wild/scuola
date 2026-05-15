/**
 * BaseScene - CodeQuest Core
 * Provides shared UI utilities and sci-fi aesthetic effects.
 */

import Phaser from '../engine/phaser.js';

export default class BaseScene extends Phaser.Scene {
    constructor(key) {
        super(key);
        this._scanline = null;
        this._particleTimer = null;
    }

    /**
     * Creates a sci-fi background with grid and particles.
     */
    createSciFiBackground(w, h, colors = { bg: 0x020408, accent: 0x00d4ff }) {
        const bg = this.add.graphics();
        bg.fillStyle(colors.bg, 1);
        bg.fillRect(0, 0, w, h);

        const grid = this.add.graphics();
        grid.lineStyle(1, colors.accent, 0.04);
        for (let x = 0; x < w; x += 50) grid.lineBetween(x, 0, x, h);
        for (let y = 0; y < h; y += 50) grid.lineBetween(0, y, w, y);
        
        bg.lineStyle(1, 0x0a1628, 0.3);
        bg.lineBetween(0, 0, w, h);
        bg.lineBetween(w, 0, 0, h);

        for (let i = 0; i < 80; i++) {
            bg.fillStyle(colors.accent, Math.random() * 0.15);
            bg.fillCircle(Math.random() * w, Math.random() * h, Math.random() * 1.5);
        }

        this._scanline = this.add.graphics().setDepth(9999);
        this.time.addEvent({
            delay: 80,
            callback: () => {
                if (!this._scanline || !this._scanline.active) return;
                this._scanline.clear();
                this._scanline.fillStyle(colors.accent, 0.015);
                this._scanline.fillRect(0, (Date.now() / 25) % h, w, 2);
            },
            repeat: -1
        });

        this._particleTimer = this.time.addEvent({
            delay: 300,
            callback: () => {
                const spark = this.add.sprite(Math.random() * w, Math.random() * h, 'particle_glow');
                spark.setDisplaySize(4, 4);
                spark.setAlpha(0.4);
                this.tweens.add({ 
                    targets: spark, 
                    alpha: 0, 
                    y: spark.y - 20, 
                    duration: 2000, 
                    onComplete: () => spark.destroy() 
                });
            },
            repeat: -1
        });
    }

    /**
     * Creates a modular sci-fi button.
     */
    createButton(x, y, w, h, text, color, callback) {
        const btn = this.add.container(x, y);
        const colorInt = Phaser.Display.Color.HexStringToColor(color).color;
        
        const bg = this.add.graphics();
        bg.fillStyle(0x0a1628, 0.7);
        bg.fillRect(-w/2, -h/2, w, h);
        bg.lineStyle(1, colorInt, 0.4);
        bg.strokeRect(-w/2, -h/2, w, h);
        btn.add(bg);

        // Cyberpunk corners
        const corner = this.add.graphics();
        const cs = 8;
        corner.lineStyle(2, colorInt, 0.6);
        corner.lineBetween(-w/2, -h/2, -w/2 + cs, -h/2);
        corner.lineBetween(-w/2, -h/2, -w/2, -h/2 + cs);
        corner.lineBetween(w/2, -h/2, w/2 - cs, -h/2);
        corner.lineBetween(w/2, -h/2, w/2, -h/2 + cs);
        corner.lineBetween(-w/2, h/2, -w/2 + cs, h/2);
        corner.lineBetween(-w/2, h/2, -w/2, h/2 - cs);
        corner.lineBetween(w/2, h/2, w/2 - cs, h/2);
        corner.lineBetween(w/2, h/2, w/2, h/2 - cs);
        btn.add(corner);

        const label = this.add.text(0, 0, text, {
            fontFamily: "'Courier New', monospace", 
            fontSize: '15px', 
            color: color, 
            letterSpacing: 2
        }).setOrigin(0.5);
        btn.add(label);

        btn.setSize(w, h);
        btn.setInteractive({ useHandCursor: true });
        
        btn.on('pointerover', () => {
            bg.clear(); 
            bg.fillStyle(colorInt, 0.1); 
            bg.fillRect(-w/2, -h/2, w, h);
            bg.lineStyle(1, colorInt, 0.8); 
            bg.strokeRect(-w/2, -h/2, w, h);
            label.setScale(1.05);
        });

        btn.on('pointerout', () => {
            bg.clear(); 
            bg.fillStyle(0x0a1628, 0.7); 
            bg.fillRect(-w/2, -h/2, w, h);
            bg.lineStyle(1, colorInt, 0.4); 
            bg.strokeRect(-w/2, -h/2, w, h);
            label.setScale(1);
        });

        btn.on('pointerdown', callback);
        return btn;
    }

    /**
     * Shows a sci-fi notification toast.
     */
    showNotification(text, color = '#00d4ff', duration = 2000) {
        const w = this.cameras.main.width;
        const n = this.add.text(w / 2, 80, text, {
            fontFamily: "'Orbitron', 'Courier New', monospace", 
            fontSize: '18px', 
            color,
            fontStyle: 'bold', 
            letterSpacing: 2, 
            backgroundColor: '#06060f', 
            padding: { x: 20, y: 10 }
        }).setOrigin(0.5).setDepth(950).setAlpha(0);
        
        n.setShadow(0, 0, color, 8);

        this.tweens.add({
            targets: n, 
            alpha: 1, 
            duration: 300, 
            yoyo: true,
            hold: duration, 
            onComplete: () => n.destroy()
        });
    }

    cleanupEffects() {
        if (this._scanline) { this._scanline.destroy(); this._scanline = null; }
        if (this._particleTimer) { this._particleTimer.destroy(); this._particleTimer = null; }
    }
}