import { SaveSystem } from './SaveSystem.js';
/**
 * GameState - CodeQuest
 * Singleton for managing the current session state.
 * XP and level system removed.
 */

export const GameState = {
    studentId: null,
    currentChapter: 1,
    puzzlesCompleted: {}, // { chapterIndex: [puzzleIndices] }
    bossesDefeated: [],   // [chapterIndices]
    araActive: true,
    araCorruption: 0.1,
    hintsUsed: [],

    restore(data) {
        if (!data) return;
        this.currentChapter = data.currentChapter || 1;
        this.puzzlesCompleted = data.puzzlesCompleted || {};
        this.bossesDefeated = data.bossesDefeated || [];
        this.araCorruption = data.araCorruption || 0.1;
        this.hintsUsed = data.hintsUsed || [];
        console.log("Game State Restored:", data);
    },

    reset() {
        this.currentChapter = 1;
        this.puzzlesCompleted = {};
        this.bossesDefeated = [];
        this.araCorruption = 0.1;
        this.hintsUsed = [];
    },

    isPuzzleCompleted(chapterIndex, puzzleIndex) {
        return this.puzzlesCompleted[chapterIndex] && 
               this.puzzlesCompleted[chapterIndex].includes(puzzleIndex);
    },

    completePuzzle(chapterIndex, puzzleIndex) {
        if (!this.puzzlesCompleted[chapterIndex]) {
            this.puzzlesCompleted[chapterIndex] = [];
        }
        if (!this.puzzlesCompleted[chapterIndex].includes(puzzleIndex)) {
            this.puzzlesCompleted[chapterIndex].push(puzzleIndex);
            this.currentChapter = chapterIndex;
            this.save(puzzleIndex);
        }
    },

    isBossDefeated(chapterIndex) {
        return this.bossesDefeated.includes(chapterIndex);
    },

    defeatBoss(chapterIndex) {
        if (!this.bossesDefeated.includes(chapterIndex)) {
            this.bossesDefeated.push(chapterIndex);
            this.save('boss');
        }
    },

    async save(missionType = null) {
        // Always save locally first for immediate feedback
        SaveSystem.save({
            studentId: this.studentId,
            currentChapter: this.currentChapter,
            puzzlesCompleted: this.puzzlesCompleted,
            bossesDefeated: this.bossesDefeated,
            araCorruption: this.araCorruption,
            hintsUsed: this.hintsUsed
        });

        if (!this.studentId) return;
        try {
            const payload = {
                studentId: this.studentId,
                chapter: this.currentChapter,
                missionIdx: missionType // 'boss' or 0, 1, 2, 3
            };

            const res = await fetch('php/api/save_progress.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await res.json();
            if (data.success) {
                console.log("Server save successful:", data.message, data.debug || "");
            } else {
                console.error("Server save failed:", data.message);
            }
        } catch (e) {
            console.warn("Server autosave failed", e);
        }
    },

    async syncFromDb() {
        if (!this.studentId) return false;
        try {
            console.log('[SYNC] Fetching progress for studentId:', this.studentId);
            const res = await fetch('php/api/get_student_progress.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ studentId: this.studentId })
            });
            const data = await res.json();
            
            if (data.success && data.progress) {
                let progressData = data.progress;
                // Assicurati che puzzlesCompleted sia un oggetto se PHP lo ritorna come array vuoto
                if (Array.isArray(progressData.puzzlesCompleted) && progressData.puzzlesCompleted.length === 0) {
                    progressData.puzzlesCompleted = {};
                }
                
                // Aggiorna lo stato in memoria
                this.restore(progressData);
                
                // Salva lo stato sincronizzato nel localStorage per averlo disponibile offline/al reload
                SaveSystem.save({
                    studentId: this.studentId,
                    currentChapter: this.currentChapter,
                    puzzlesCompleted: this.puzzlesCompleted,
                    bossesDefeated: this.bossesDefeated,
                    araCorruption: this.araCorruption,
                    hintsUsed: this.hintsUsed
                });
                
                console.log('[SYNC] Successfully synced and saved to localStorage');
                return true;
            } else {
                console.warn('[SYNC] Failed to fetch progress:', data.message);
                return false;
            }
        } catch (error) {
            console.error('[SYNC] Network error during sync:', error);
            return false;
        }
    }
};
