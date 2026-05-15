/**
 * SaveSystem - CodeQuest
 * Pure utility for localStorage persistence.
 */

export const SaveSystem = {
    KEY: 'cq_save_data',

    hasSave() {
        const has = localStorage.getItem(this.KEY) !== null;
        console.log('[SAVE] hasSave():', has);
        return has;
    },

    save(data) {
        const saveData = {
            ...data,
            timestamp: Date.now()
        };
        localStorage.setItem(this.KEY, JSON.stringify(saveData));
        console.log('[SAVE] Game saved locally:', saveData);
    },

    load() {
        try {
            const raw = localStorage.getItem(this.KEY);
            console.log('[SAVE] Raw localStorage data:', raw);
            if (!raw) return null;
            const parsed = JSON.parse(raw);
            console.log('[SAVE] Parsed save data:', parsed);
            return parsed;
        } catch (e) {
            console.error('[SAVE] Failed to load save data:', e);
            return null;
        }
    },

    clear() {
        localStorage.removeItem(this.KEY);
        console.log('[SAVE] Save data cleared');
    }
};
