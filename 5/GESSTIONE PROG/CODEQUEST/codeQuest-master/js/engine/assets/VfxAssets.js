import { AssetBase } from './AssetBase.js';

export const VfxAssets = {
    generate(scene) {
        this._glow(scene, 'particle_glow', 'rgba(0,212,255,0.8)');
        this._glow(scene, 'particle_fire', 'rgba(255,80,0,0.8)');
        this._glow(scene, 'spark', 'rgba(255,255,255,1)');
        this._playerGlow(scene);
    },

    _glow(scene, key, color) {
        if (!scene.textures.exists(key)) {
            const c = AssetBase.createCanvas(12, 12), ctx = c.getContext('2d');
            const grad = ctx.createRadialGradient(6, 6, 0, 6, 6, 6);
            grad.addColorStop(0, color);
            grad.addColorStop(1, 'rgba(0,0,0,0)');
            ctx.fillStyle = grad; ctx.fillRect(0, 0, 12, 12);
            scene.textures.addCanvas(key, c);
        }
    },

    _playerGlow(scene) {
        if (!scene.textures.exists('player_glow')) {
            const c = AssetBase.createCanvas(80, 80), ctx = c.getContext('2d');
            const grad = ctx.createRadialGradient(40, 40, 0, 40, 40, 40);
            grad.addColorStop(0, 'rgba(0,212,255,0.3)'); grad.addColorStop(1, 'rgba(0,0,0,0)');
            ctx.fillStyle = grad; ctx.fillRect(0, 0, 80, 80);
            scene.textures.addCanvas('player_glow', c);
        }
    }
};
