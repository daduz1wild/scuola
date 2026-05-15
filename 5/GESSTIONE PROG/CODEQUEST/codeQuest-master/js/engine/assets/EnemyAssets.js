import { AssetBase } from './AssetBase.js';

export const EnemyAssets = {
    generate(scene) {
        this._gen(scene, 'enemy_tag', '#ff1744');
        this._gen(scene, 'enemy_bug', '#ffaa00');
        this._gen(scene, 'enemy_sql', '#aa00ff');
        this._gen(scene, 'enemy_rootkit', '#ff0000');
        this._gen(scene, 'enemy_ara_core', '#ff6666');
    },

    _gen(scene, key, color) {
        if (!scene.textures.exists(key)) {
            const fw = 32, fh = 40, c = AssetBase.createCanvas(fw * 4, fh), ctx = c.getContext('2d');
            for (let f = 0; f < 4; f++) {
                const ox = f * fw, bob = (f % 2 === 0) ? 0 : -2;
                // Hood / Body
                AssetBase.r(ctx, ox + 6, 8 + bob, 20, 24, '#000');
                // Face/Eye glow
                AssetBase.r(ctx, ox + 10, 14 + bob, 12, 6, '#222');
                AssetBase.r(ctx, ox + 12, 16 + bob, 2, 2, color);
                AssetBase.r(ctx, ox + 18, 16 + bob, 2, 2, color);
                // Glitch details
                AssetBase.r(ctx, ox + 8, 12 + bob, 16, 1, color);
                AssetBase.r(ctx, ox + 8, 30 + bob, 16, 1, color);
            }
            AssetBase.addSpriteSheet(scene, key, c, fw, fh);
        }
    }
};
