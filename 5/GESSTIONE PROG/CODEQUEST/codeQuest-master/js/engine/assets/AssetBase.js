/**
 * AssetBase - Shared utilities for asset generation
 */
export const AssetBase = {
    createCanvas(w, h) {
        const canvas = document.createElement('canvas');
        canvas.width = w;
        canvas.height = h;
        return canvas;
    },

    p(ctx, x, y, color) {
        ctx.fillStyle = color;
        ctx.fillRect(x, y, 1, 1);
    },

    r(ctx, x, y, w, h, color) {
        ctx.fillStyle = color;
        ctx.fillRect(x, y, w, h);
    },

    addSpriteSheet(scene, key, canvas, fw, fh) {
        let texture = null;
        if (scene.textures.exists(key)) {
            texture = scene.textures.get(key);
        } else {
            texture = scene.textures.addSpriteSheet(key, canvas, { frameWidth: fw, frameHeight: fh });
        }
        return texture;
    }
};
