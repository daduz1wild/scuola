import { AssetBase } from './AssetBase.js';

export const CharacterAssets = {
    generate(scene, charData, animData) {
        // Player
        this._generatePlayer(scene, charData.player, animData);
        
        // NPCs
        Object.keys(charData).forEach(key => {
            if (key !== 'player') {
                this._generateNPC(scene, key, charData[key], animData);
            }
        });
    },

    _generatePlayer(scene, config, animData) {
        if (!scene.textures.exists('player')) {
            const s = 2, fw = 32*s, fh = 40*s;
            const c = AssetBase.createCanvas(fw * 4, fh), ctx = c.getContext('2d');
            const colors = config.colors;
            const legs = [[0, 0], [-2, 2], [0, 0], [2, -2]];

            for (let f = 0; f < 4; f++) {
                const ox = f * fw, l = legs[f];
                // Head/Neon Hair
                AssetBase.r(ctx, ox + 10*s, 3*s, 10*s, 5*s, '#00d4ff');
                // Face
                AssetBase.r(ctx, ox + 10*s, 8*s, 10*s, 4*s, colors.skin);
                // Visor
                AssetBase.r(ctx, ox + 11*s, 9*s, 8*s, 2*s, '#fff');
                AssetBase.r(ctx, ox + 12*s, 9.5*s, 6*s, 1*s, colors.visor);
                // Suit
                AssetBase.r(ctx, ox + 8*s, 12*s, 14*s, 10*s, colors.suit);
                AssetBase.r(ctx, ox + 10*s, 13*s, 10*s, 1*s, '#00d4ff'); // Detail
                // Legs
                AssetBase.r(ctx, ox + 9*s, 22*s + l[0]*s, 4*s, 6*s, '#111');
                AssetBase.r(ctx, ox + 17*s, 22*s + l[1]*s, 4*s, 6*s, '#111');
            }

            AssetBase.addSpriteSheet(scene, 'player', c, fw, fh);
            this._createAnims(scene, 'player', animData);
        }
    },

    _generateNPC(scene, key, config, animData) {
        if (!scene.textures.exists(key)) {
            const s = 2, fw = 32*s, fh = 40*s;
            const c = AssetBase.createCanvas(fw * 4, fh), ctx = c.getContext('2d');
            const colors = config.colors || { hair: '#aaa', suit: '#333', skin: '#f3e5f5', visor: '#00d4ff' };
            const legs = [[0, 0], [-1, 1], [0, 0], [1, -1]];

            for (let f = 0; f < 4; f++) {
                const ox = f * fw, l = legs[f];
                AssetBase.r(ctx, ox + 10*s, 4*s, 10*s, 4*s, colors.hair);
                AssetBase.r(ctx, ox + 10*s, 8*s, 10*s, 4*s, colors.skin);
                AssetBase.r(ctx, ox + 11*s, 9*s, 8*s, 2*s, colors.visor);
                AssetBase.r(ctx, ox + 8*s, 12*s, 14*s, 10*s, colors.suit);
                AssetBase.r(ctx, ox + 9*s, 22*s + l[0]*s, 4*s, 5*s, '#222');
                AssetBase.r(ctx, ox + 17*s, 22*s + l[1]*s, 4*s, 5*s, '#222');
            }

            AssetBase.addSpriteSheet(scene, key, c, fw, fh);
            this._createAnims(scene, key, animData);
        }
    },

    _createAnims(scene, key, animData) {
        Object.keys(animData).forEach(animName => {
            const config = animData[animName];
            const animKey = `${key}_${animName}`;
            if (!scene.anims.exists(animKey)) {
                scene.anims.create({
                    key: animKey,
                    frames: scene.anims.generateFrameNumbers(key, { start: config.start, end: config.end }),
                    frameRate: config.rate,
                    repeat: config.repeat
                });
            }
        });
    }
};
