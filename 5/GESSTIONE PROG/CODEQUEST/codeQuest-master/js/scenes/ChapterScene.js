/**
 * ChapterScene - CodeQuest
 * Main gameplay scene handling exploration, NPCs, and puzzles.
 */

import Phaser from '../engine/phaser.js';
import BaseScene from '../scene/baseScene.js';
import { GameState } from '../engine/GameState.js';
import { SaveSystem } from '../engine/SaveSystem.js';
import { AssetGenerator } from '../engine/AssetGenerator.js';
import { MapLoader } from '../engine/MapLoader.js';
import { DialogSystem } from '../engine/DialogSystem.js';
import { CodeEditor } from '../engine/CodeEditor.js';

// Real systems initialization
const CombatSystem = { active: false, init: () => {}, start: (b, c, cb) => { console.log("Boss:", b); if(cb) cb(); } };

export default class ChapterScene extends BaseScene {
    constructor() {
        super('ChapterScene');
    }

    init(data) {
        this.chapterIndex = (data && data.chapterIndex !== undefined) ? data.chapterIndex : 1;
        GameState.currentChapter = this.chapterIndex;
        this.npcSprites = [];
        this.puzzleZones = [];
        this.bossNode = null;
        this.obstacles = [];
        this.inputCooldown = 0;
        this.interactionPrompt = null;
        this.completedPuzzlesCount = 0;
        this.isBossUnlocked = false;
    }

    _checkBossUnlock() {
        const totalPuzzles = this.chapterData.puzzles.length;
        if (this.completedPuzzlesCount >= totalPuzzles && !this.isBossUnlocked) {
            this.isBossUnlocked = true;
            if (this.bossNode) {
                this.tweens.add({
                    targets: this.bossNode,
                    alpha: 1,
                    duration: 1000,
                    ease: 'Power2'
                });
                this.showNotification("SETTORE BOSS SBLOCCATO!", "#ff1744", 4000);
            }
        }
    }

    _interactWithBoss(bossData) {
        if (!this.isBossUnlocked) {
            this.showNotification("COMPLETA TUTTE LE MISSIONI", "#ff1744");
            return;
        }
        CombatSystem.start(bossData, this.chapterIndex, () => {
            GameState.defeatBoss(this.chapterIndex);
            this.showNotification("CAPITOLO COMPLETATO!", "#10b981");
        });
    }

    async create() {
        this.cleanupEffects();
        
        // Listen for entities spawned by MapLoader (register once)
        this.events.off('spawn_entity');
        this.events.on('spawn_entity', (entity) => this._onEntitySpawned(entity));

        const w = this.cameras.main.width;
        const h = this.cameras.main.height;

        // 1. Generate Assets (Data-driven)
        await AssetGenerator.generateAll(this);

        // 2. Build Basic Systems
        this.cursors = this.input.keyboard.createCursorKeys();
        this.wasd = this.input.keyboard.addKeys('W,A,S,D');
        this.eKey = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.E);

        this.interactionPrompt = this.add.text(0, 0, '[E] INTERAGISCI', {
            fontFamily: 'Orbitron',
            fontSize: '14px',
            color: '#00d4ff',
            backgroundColor: 'rgba(0,0,0,0.7)',
            padding: { x: 8, y: 4 }
        }).setOrigin(0.5).setAlpha(0).setDepth(1000);
        
        // 3. Create Player (Must be before map for colliders)
        this._buildPlayer(w, h);

        // 4. Load Map from JSON
        this.chapterData = await MapLoader.load(this, this.chapterIndex);
        this.completedPuzzlesCount = (GameState.puzzlesCompleted[this.chapterIndex] || []).length;
        
        if (!this.chapterData) {
            console.error("Critical error: chapterData is null");
            alert("Errore nel caricamento del capitolo. Ritorno alla dashboard.");
            window.location.href = 'student_dashboard.html';
            return;
        }

        // 5. Initialize Physics Groups
        this.npcGroup = this.physics.add.staticGroup();
        this.puzzleGroup = this.physics.add.staticGroup();
        this.physics.add.collider(this.player, this.npcGroup);
        this.physics.add.collider(this.player, this.puzzleGroup);

        // 6. Build Map and HUD
        MapLoader.build(this, this.chapterData);
        this._buildHUD(w, h);
        
        // 7. Background and Bounds
        this.add.rectangle(0, 0, w, h, 0x020408).setOrigin(0).setDepth(-11);
        const bg = this.add.tileSprite(0, 0, w, h, 'bg_lab').setOrigin(0).setDepth(-10).setAlpha(0.2);
        this.physics.world.setBounds(0, 0, w, h);

        this.cameras.main.fadeIn(800, 2, 4, 8);

        DialogSystem.init(this);
        CodeEditor.init(this);
        CombatSystem.init(this);

        this._checkBossUnlock();
        this._playIntroDialog();
    }

    _onEntitySpawned(entity) {
        if (entity.type === 'npc') {
            this._spawnNPC(entity);
        } else if (entity.type === 'puzzle') {
            this._spawnPuzzle(entity);
        } else if (entity.type === 'boss') {
            this._spawnBoss(entity);
        }
    }

    _spawnNPC(entity) {
        // Find NPC data from chapterData
        const npcData = this.chapterData.npcs.find(n => n.texKey === entity.key) || { name: "Unknown" };
        
        const sprite = this.npcGroup.create(entity.x, entity.y + 32, entity.key);
        sprite.setOrigin(0.5, 1);
        sprite.setDisplaySize(64, 80);
        sprite.setDepth(entity.y + 32);
        sprite.setData('npcData', npcData);

        // Special handling for holograms
        if (entity.key.includes('hologram')) {
            sprite.setAlpha(0.6);
            this.tweens.add({
                targets: sprite,
                alpha: 0.3,
                duration: 100,
                yoyo: true,
                repeat: -1,
                repeatDelay: 2000 + Math.random() * 3000
            });
        }
        
        // Breathing animation
        this.tweens.add({
            targets: sprite,
            scaleY: sprite.scaleY * 1.05,
            duration: 1000 + Math.random() * 500,
            yoyo: true,
            repeat: -1,
            ease: 'Sine.easeInOut'
        });

        this.add.text(entity.x, entity.y - 60, npcData.name, {
            fontFamily: 'Share Tech Mono',
            fontSize: '14px',
            color: '#00d4ff'
        }).setOrigin(0.5);

        this.npcSprites.push({ sprite, data: npcData });
    }

    _spawnPuzzle(entity) {
        // Find puzzle data by index
        const puzzleIdx = this.puzzleZones.length;
        const puzzleData = this.chapterData.puzzles[puzzleIdx] || this.chapterData.puzzles[0];

        const node = this.physics.add.staticSprite(entity.x, entity.y + 32, 'puzzle_node');
        node.setOrigin(0.5, 1);
        node.setDisplaySize(96, 128);
        node.setDepth(entity.y + 32);
        node.setData('puzzleData', puzzleData);
        node.setData('puzzleIdx', puzzleIdx);
        
        // Shrink collision box to a small footprint at the base
        node.body.setSize(30, 20);
        node.body.setOffset(33, 108);

        // Add number label
        const label = this.add.text(entity.x, entity.y - 140, (puzzleIdx + 1), {
            fontFamily: 'Orbitron',
            fontSize: '24px',
            color: '#00d4ff',
            stroke: '#000',
            strokeThickness: 5
        }).setOrigin(0.5);
        label.setDepth(entity.y + 33); // Depth slightly higher than node to appear on top

        this.puzzleZones.push({ x: entity.x, y: entity.y, radius: 80, puzzle: puzzleData, node, idx: puzzleIdx, label });
        
        // Set visual state based on GameState
        const isCompleted = GameState.isPuzzleCompleted(this.chapterIndex, puzzleIdx);
        const isNext = (puzzleIdx === 0) || GameState.isPuzzleCompleted(this.chapterIndex, puzzleIdx - 1);

        if (isCompleted) {
            node.setTint(0x10b981); // Green
            label.setTint(0x10b981);
            label.setAlpha(1);
        } else if (isNext) {
            node.clearTint(); // Normal
            label.setAlpha(1);
        } else {
            node.setTint(0x333333); // Locked (grey)
            label.setAlpha(0.6);
        }
        
        // Floating effect (after alpha/tint are set)
        this.tweens.add({
            targets: [node, label],
            y: "-=15",
            duration: 1500 + Math.random() * 500,
            yoyo: true,
            repeat: -1,
            ease: 'Sine.easeInOut'
        });

        this.physics.add.collider(this.player, node);
    }

    _interactWithPuzzle(puzzleData, puzzleIdx) {
        // Sequential check
        if (puzzleIdx > 0 && !GameState.isPuzzleCompleted(this.chapterIndex, puzzleIdx - 1)) {
            this.showNotification("COMPLETA MISSIONE " + puzzleIdx, "#ef4444");
            return;
        }

        if (GameState.isPuzzleCompleted(this.chapterIndex, puzzleIdx)) {
            this.showNotification("GIÀ COMPLETATO", "#fbbf24");
            return;
        }

        CodeEditor.open(
            puzzleData, 
            (res) => {
                if (res.success) {
                    this.showNotification("MISSIONE " + (puzzleIdx + 1) + " OK", "#10b981");
                    
                    // Update node visual
                    const zone = this.puzzleZones.find(z => z.idx === puzzleIdx);
                    if (zone) {
                        if (zone.node) zone.node.setTint(0x10b981);
                        if (zone.label) zone.label.setTint(0x10b981);
                    }
                    // Unlock next node
                    const nextZone = this.puzzleZones.find(z => z.idx === puzzleIdx + 1);
                    if (nextZone) {
                        nextZone.node.clearTint();
                        nextZone.label.setAlpha(1);
                    }

                    this.completedPuzzlesCount++;
                    this._checkBossUnlock();
                    
                    // Final state update (after UI is safe)
                    GameState.completePuzzle(this.chapterIndex, puzzleIdx);
                }
            },
            (count) => {
                const hint = puzzleData.hints[count - 1];
                if (hint) CodeEditor.showHint(hint);
            }
        );
    }

    _spawnBoss(entity) {
        const bossData = this.chapterData.boss;
        this.bossNode = this.physics.add.staticSprite(entity.x, entity.y + 32, 'boss_node');
        this.bossNode.setOrigin(0.5, 1);
        this.bossNode.setDisplaySize(128, 192);
        this.bossNode.setDepth(entity.y + 32);
        this.bossNode.setAlpha(0.3); // Semi-transparent until unlocked
        this.bossNode.setData('bossData', bossData);
        
        // Add Boss Label
        this.add.text(entity.x, entity.y - 180, "BOSS", {
            fontFamily: 'Orbitron',
            fontSize: '24px',
            color: '#ff1744',
            fontStyle: 'bold'
        }).setOrigin(0.5).setShadow(0, 0, '#ff1744', 10);

        // Shrink collision box to a small footprint at the base
        this.bossNode.body.setSize(40, 30);
        this.bossNode.body.setOffset(44, 160);

        // Floating effect
        this.tweens.add({
            targets: this.bossNode,
            y: this.bossNode.y - 20,
            duration: 2000,
            yoyo: true,
            repeat: -1,
            ease: 'Sine.easeInOut'
        });

        this.physics.add.collider(this.player, this.bossNode);
    }

    _buildPlayer(w, h) {
        this.player = this.physics.add.sprite(w/2, h/2, 'player');
        this.player.setDisplaySize(64, 80);
        this.player.setCollideWorldBounds(true);
        this.player.setDepth(1000);
        
        // Shrink player collision box for better navigation
        this.player.body.setSize(24, 20);
        this.player.body.setOffset(20, 60);
        
        // Define animations
        if (!this.anims.exists('player_idle')) {
            this.anims.create({
                key: 'player_idle',
                frames: this.anims.generateFrameNumbers('player', { start: 0, end: 0 }),
                frameRate: 1
            });
            this.anims.create({
                key: 'player_walk',
                frames: this.anims.generateFrameNumbers('player', { start: 1, end: 3 }),
                frameRate: 8,
                repeat: -1
            });
        }
        
        this.player.anims.play('player_idle');
    }

    _buildHUD() {
        const hud = this.add.container(0, 0).setDepth(1000).setScrollFactor(0);
        const bg = this.add.graphics();
        bg.fillStyle(0x000000, 0.5);
        bg.fillRect(0, 0, this.scale.width, 40);
        hud.add(bg);

        const title = this.add.text(this.scale.width / 2, 20, this.chapterData.title.toUpperCase(), {
            fontFamily: 'Orbitron',
            fontSize: '14px',
            color: '#00d4ff'
        }).setOrigin(0.5);
        hud.add(title);
    }

    _playIntroDialog() {
        if (this.completedPuzzlesCount === 0 && this.chapterData.npcs && this.chapterData.npcs[0]) {
            DialogSystem.start(this.chapterData.npcs[0].dialogues[0]);
        }
    }

    update() {
        if (!this.cursors || !this.player || !this.player.body) return;

        if (DialogSystem.active || CodeEditor.active) {
            if (this.player.body) {
                this.player.body.setVelocity(0, 0);
            }
            return;
        }

        const speed = 140;
        let vx = 0;
        let vy = 0;

        if (this.cursors.left.isDown || this.wasd.A.isDown) {
            vx = -speed;
            this.player.setFlipX(true);
        } else if (this.cursors.right.isDown || this.wasd.D.isDown) {
            vx = speed;
            this.player.setFlipX(false);
        }

        if (this.cursors.up.isDown || this.wasd.W.isDown) vy = -speed;
        else if (this.cursors.down.isDown || this.wasd.S.isDown) vy = speed;

        this.player.body.setVelocity(vx, vy);

        // Update animation
        if (vx !== 0 || vy !== 0) {
            this.player.anims.play('player_walk', true);
        } else {
            this.player.anims.play('player_idle');
        }

        this._checkInteractions();
    }

    _checkInteractions() {
        let nearest = null;
        let minDist = 60;

        // Reset prompt
        this.interactionPrompt.setAlpha(0);

        // Check NPCs
        this.npcSprites.forEach(npc => {
            const dist = Phaser.Math.Distance.Between(this.player.x, this.player.y, npc.sprite.x, npc.sprite.y);
            if (dist < minDist) {
                nearest = { type: 'npc', data: npc.data };
                minDist = dist;
            }
        });

        // Check Puzzles
        this.puzzleZones.forEach(zone => {
            const dist = Phaser.Math.Distance.Between(this.player.x, this.player.y, zone.x, zone.y);
            if (dist < minDist) {
                nearest = { type: 'puzzle', data: zone.puzzle, idx: zone.idx };
                minDist = dist;
            }
        });

        // Check Boss
        if (this.bossNode) {
            const dist = Phaser.Math.Distance.Between(this.player.x, this.player.y, this.bossNode.x, this.bossNode.y);
            if (dist < minDist) {
                nearest = { type: 'boss', data: this.bossNode.getData('bossData') };
                minDist = dist;
            }
        }

        if (nearest) {
            this.interactionPrompt.setPosition(this.player.x, this.player.y - 50).setAlpha(1);
            
            if (Phaser.Input.Keyboard.JustDown(this.eKey)) {
                if (nearest.type === 'npc') {
                    DialogSystem.start(nearest.data.dialogues[0]);
                } else if (nearest.type === 'puzzle') {
                    this._interactWithPuzzle(nearest.data, nearest.idx);
                } else if (nearest.type === 'boss') {
                    this._interactWithBoss(nearest.data);
                }
            }
        }
    }

    _showNotification(text, color) {
        this.showNotification(text, color);
    }
}
