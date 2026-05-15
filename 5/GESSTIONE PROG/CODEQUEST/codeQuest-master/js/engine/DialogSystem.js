/**
 * DialogSystem - CodeQuest
 * Optimized Narrative Engine for Linear Dialogs
 * Refactored for Single Return Compliance and Robustness
 */

export const DialogSystem = {
    // State
    active: false,
    currentDialog: null,
    lineIdx: 0,
    charIdx: 0,
    fullText: '',
    typingComplete: false,
    typingTimer: null,
    skipTyping: false,
    onEnd: null,
    chapters: {},
    
    // UI Elements
    container: null,
    bg: null,
    topBar: null,
    avatarGlow: null,
    avatarInner: null,
    nameText: null,
    dialogText: null,
    promptText: null,
    scanline: null,
    promptTimer: null,
    inputListener: null,
    
    // Config
    colors: {
        'Luna': 0xa855f7,
        'Luna (Ologramma)': 0x00d4ff,
        'Max': 0xf97316,
        'Ivy': 0x10b981,
        'ARA': 0xff1744,
        'ARA::CORE': 0xff1744,
        'ARA (Eco)': 0xff1744,
        '???': 0xff1744,
        'root@corrupted': 0xff1744,
        'System': 0x00d4ff,
        'Sistema': 0x00d4ff,
        'Mentore': 0xfbbf24,
        'Tag Orfano': 0xff4444,
        'Bug Infinito': 0xff6600,
        'SQL Phantom': 0xaa00ff,
        'Rootkit': 0xff0000
    },

    /**
     * Initializes the system with a scene context.
     */
    init(scene) {
        this.scene = scene;
        return this;
    },

    /**
     * Preloads dialog data from JSON files.
     */
    async loadDialog(key) {
        let result = null;
        try {
            const response = await fetch(`js/dialogs/${key}.json`);
            if (response.ok) {
                result = await response.json();
            }
        } catch (error) {
            console.error(`Failed to load dialog: ${key}`, error);
        }
        return result;
    },

    /**
     * Loads a chapter JSON and stores it.
     */
    async loadChapter(id) {
        const data = await this.loadDialog(id);
        if (data) {
            this.chapters[id] = data;
        }
        return data;
    },

    /**
     * Retrieves a dialog object from a loaded chapter.
     */
    getDialog(chapterId, type, key) {
        let result = null;
        const chapter = this.chapters?.[chapterId];
        
        if (chapter) {
            if (type === 'npcs') {
                result = chapter.npcs?.[key]?.[0];
            } else if (type === 'boss') {
                result = { lines: chapter.boss?.[key] };
            } else if (type === 'ending') {
                result = { lines: chapter.ending };
            }
        }
        
        return result;
    },

    /**
     * Starts the dialogue sequence.
     */
    start(dialogData, onEnd) {
        // If already active, end the previous session cleanly
        if (this.active) {
            this.end();
        }

        if (dialogData && dialogData.lines) {
            this.onEnd = onEnd;
            this.currentDialog = dialogData;
            this.lineIdx = 0;
            this.active = true;
            this.skipTyping = false;

            this.createUI();
            this.showLine();
        } else {
            console.warn("Invalid dialog data passed to DialogSystem");
            if (onEnd) {
                onEnd();
            }
        }
    },

    /**
     * Creates the UI elements for the dialogue box.
     */
    createUI() {
        const { width: w, height: h } = this.scene.cameras.main;
        const boxH = 190;
        const y = h - boxH - 25;

        // Cleanup existing if any (safety)
        if (this.container) {
            this.container.destroy();
        }

        this.container = this.scene.add.container(0, 0).setDepth(2000);

        // Main Background
        this.bg = this.scene.add.graphics();
        this.bg.fillStyle(0x06060f, 0.92);
        this.bg.fillRect(0, y, w, boxH + 25);
        this.bg.fillStyle(0x0a1628, 0.6);
        this.bg.fillRoundedRect(15, y + 8, w - 30, boxH - 8, 8);
        this.bg.lineStyle(2, 0x00d4ff, 0.7);
        this.bg.strokeRoundedRect(15, y + 8, w - 30, boxH - 8, 8);
        this.bg.lineStyle(1, 0x00d4ff, 0.15);
        this.bg.strokeRoundedRect(17, y + 10, w - 34, boxH - 12, 6);
        
        // Neon borders
        this.bg.fillStyle(0x00d4ff, 0.6);
        this.bg.fillRect(15, y + 8, 4, boxH);
        this.bg.fillRect(w - 19, y + 8, 4, boxH);
        this.container.add(this.bg);

        // Top Header Bar
        this.topBar = this.scene.add.graphics();
        this.topBar.fillStyle(0x00d4ff, 0.1);
        this.topBar.fillRect(15, y + 8, w - 30, 32);
        this.topBar.lineStyle(1, 0x00d4ff, 0.2);
        this.topBar.lineBetween(15, y + 40, w - 15, y + 40);
        this.container.add(this.topBar);

        // Scanline Animation
        this.scanline = this.scene.add.graphics();
        this.container.add(this.scanline);
        this.scanlineTimer = this.scene.time.addEvent({
            delay: 50,
            callback: () => {
                if (this.active && this.scanline) {
                    this.scanline.clear();
                    this.scanline.fillStyle(0x00d4ff, 0.02);
                    this.scanline.fillRect(15, y + ((Date.now() / 25) % (boxH - 10)), w - 30, 2);
                }
            },
            loop: true
        });

        // Avatar Setup
        this.avatarX = 50;
        this.avatarY = y + 55;
        this.avatarGlow = this.scene.add.graphics();
        this.container.add(this.avatarGlow);

        const avatarOuter = this.scene.add.graphics();
        avatarOuter.lineStyle(2, 0x00d4ff, 0.5);
        avatarOuter.strokeCircle(this.avatarX, this.avatarY, 24);
        this.container.add(avatarOuter);

        this.avatarInner = this.scene.add.graphics();
        this.container.add(this.avatarInner);

        // Texts
        this.nameText = this.scene.add.text(95, y + 15, '', {
            fontFamily: "'Orbitron', sans-serif", fontSize: '15px',
            color: '#00d4ff', fontStyle: 'bold', letterSpacing: 2
        });

        this.dialogText = this.scene.add.text(95, y + 55, '', {
            fontFamily: "'Share Tech Mono', monospace", fontSize: '15px',
            color: '#c8d8e8', wordWrap: { width: w - 130 }, lineSpacing: 6
        });

        this.promptText = this.scene.add.text(w - 170, y + boxH - 28, '>> PRESS SPACE', {
            fontFamily: "'Orbitron', sans-serif", fontSize: '11px',
            color: '#00d4ff', letterSpacing: 1
        }).setAlpha(0);

        this.container.add([this.nameText, this.dialogText, this.promptText]);

        // Prompt Blinking
        this.promptTimer = this.scene.time.addEvent({
            delay: 500,
            callback: () => {
                if (this.promptText && this.typingComplete) {
                    this.promptText.setAlpha(this.promptText.alpha === 1 ? 0.3 : 1);
                }
            },
            loop: true
        });

        // Robust Input Handling: Use a named listener for precise cleanup
        this.inputListener = () => this.advance();
        this.scene.input.keyboard.on('keydown-SPACE', this.inputListener);
    },

    /**
     * Displays the current line of dialogue.
     */
    showLine() {
        let line = null;
        let colorHex = 0xc8d8e8;
        let colorStr = '#c8d8e8';

        if (this.currentDialog && this.lineIdx < this.currentDialog.lines.length) {
            line = this.currentDialog.lines[this.lineIdx];
            this.fullText = line.text || '';
            this.charIdx = 0;
            this.typingComplete = false;
            this.skipTyping = false;
            
            this.dialogText.setText('');
            this.promptText.setAlpha(0);

            colorHex = this.colors[line.speaker] || 0xc8d8e8;
            colorStr = `#${colorHex.toString(16).padStart(6, '0')}`;
            
            this.nameText.setText(line.speaker.toUpperCase()).setColor(colorStr);
            this.updateAvatar(colorHex);

            if (this.typingTimer) {
                this.typingTimer.remove();
            }

            this.typingTimer = this.scene.time.addEvent({
                delay: 20,
                callback: () => this.typeChar(),
                repeat: this.fullText.length - 1
            });
        } else {
            this.end();
        }
    },

    /**
     * Updates the avatar visual based on the speaker's color.
     */
    updateAvatar(color) {
        this.avatarGlow.clear();
        this.avatarGlow.fillStyle(color, 0.12);
        this.avatarGlow.fillCircle(this.avatarX, this.avatarY, 30);

        this.avatarInner.clear();
        this.avatarInner.fillStyle(color, 0.8);
        this.avatarInner.fillCircle(this.avatarX, this.avatarY, 18);
        
        this.avatarInner.fillStyle(0xffffff, 0.4);
        this.avatarInner.fillCircle(this.avatarX - 5, this.avatarY - 5, 3);
        this.avatarInner.fillCircle(this.avatarX + 5, this.avatarY - 5, 3);
        this.avatarInner.lineStyle(1, 0xffffff, 0.2);
        this.avatarInner.strokeCircle(this.avatarX, this.avatarY, 20);
    },

    /**
     * Types out the text character by character.
     */
    typeChar() {
        if (!this.skipTyping) {
            if (this.charIdx < this.fullText.length) {
                this.charIdx++;
                this.dialogText.setText(this.fullText.substring(0, this.charIdx));
            } else {
                this.completeLine();
            }
        }
    },

    /**
     * Immediately completes the typing animation for the current line.
     */
    completeLine() {
        this.typingComplete = true;
        this.dialogText.setText(this.fullText);
        this.promptText.setAlpha(1);
        
        if (this.typingTimer) {
            this.typingTimer.remove();
            this.typingTimer = null;
        }
    },

    /**
     * Advances to the next line or completes the current typing.
     */
    advance() {
        if (this.active) {
            if (!this.typingComplete) {
                this.skipTyping = true;
                this.completeLine();
            } else {
                this.lineIdx++;
                this.showLine();
            }
        }
    },

    /**
     * Ends the dialogue sequence and cleans up resources.
     */
    end() {
        this.active = false;
        
        // Cleanup UI
        if (this.container) {
            this.container.destroy();
            this.container = null;
        }

        // Cleanup Timers
        if (this.typingTimer) {
            this.typingTimer.remove();
            this.typingTimer = null;
        }
        if (this.promptTimer) {
            this.promptTimer.remove();
            this.promptTimer = null;
        }
        if (this.scanlineTimer) {
            this.scanlineTimer.remove();
            this.scanlineTimer = null;
        }

        // Cleanup Input
        if (this.scene && this.scene.input && this.scene.input.keyboard && this.inputListener) {
            this.scene.input.keyboard.off('keydown-SPACE', this.inputListener);
            this.inputListener = null;
        }

        this.currentDialog = null;

        // Execute callback
        if (this.onEnd) {
            const callback = this.onEnd;
            this.onEnd = null;
            callback();
        }
    }
};
