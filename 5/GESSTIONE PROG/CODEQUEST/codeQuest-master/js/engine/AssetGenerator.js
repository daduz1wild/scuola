/**
 * AssetGenerator - CodeQuest
 * Refactored main entry point for modular asset generation.
 * Orchestrates Character, Environment, Enemy, and VFX generation.
 */

import { CharacterAssets } from './assets/CharacterAssets.js';
import { EnvironmentAssets } from './assets/EnvironmentAssets.js';
import { EnemyAssets } from './assets/EnemyAssets.js';
import { VfxAssets } from './assets/VfxAssets.js';

export const AssetGenerator = {
    /**
     * Generates all game assets procedurally.
     * @param {Phaser.Scene} scene - The current scene context.
     */
    async generateAll(scene) {
        try {
            // Load metadata
            const [assetsRes, animsRes] = await Promise.all([
                fetch('js/data/assets_data.json'),
                fetch('js/data/animations_data.json')
            ]);
            
            const assetsData = await assetsRes.json();
            const animsData = await animsRes.json();

            // Character generation (Player & NPCs)
            CharacterAssets.generate(scene, assetsData.characters, animsData.characters);

            // Environment assets (Buildings, trees, hexes)
            EnvironmentAssets.generate(scene, assetsData.environment);

            // Enemy variants
            EnemyAssets.generate(scene);

            // Visual effects and particles
            VfxAssets.generate(scene);
        } catch (error) {
            console.error("Asset generation failed:", error);
        }
    }
};
