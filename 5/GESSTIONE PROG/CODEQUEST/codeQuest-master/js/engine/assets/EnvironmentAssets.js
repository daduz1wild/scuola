import { AssetBase } from './AssetBase.js';

export const EnvironmentAssets = {
    generate(scene, envData) {
        this._generateBuilding(scene, envData.building);
        this._generateTree(scene, envData.data_tree);
        this._generateFloor(scene, envData.floor_tile);
        this._generateNodes(scene);
    },

    _generateFloor(scene, config) {
        if (!scene.textures.exists('floor_tile')) {
            const c = AssetBase.createCanvas(32, 32), ctx = c.getContext('2d');
            // Base
            AssetBase.r(ctx, 0, 0, 32, 32, '#060a12');
            // Grid Border
            ctx.strokeStyle = 'rgba(0, 212, 255, 0.1)';
            ctx.strokeRect(0, 0, 32, 32);
            // Tech details
            ctx.fillStyle = 'rgba(0, 212, 255, 0.05)';
            ctx.fillRect(4, 4, 2, 2);
            ctx.fillRect(26, 26, 2, 2);
            scene.textures.addCanvas('floor_tile', c);
        }
    },

    _generateBuilding(scene, config) {
        if (!scene.textures.exists('building')) {
            const c = AssetBase.createCanvas(config.w, config.h), ctx = c.getContext('2d');
            AssetBase.r(ctx, 8, 4, config.w - 16, config.h - 24, '#0d1220');
            AssetBase.r(ctx, 10, 6, config.w - 20, config.h - 28, config.color);
            for (let i = 0; i < 9; i++) {
                AssetBase.r(ctx, 14 + (i%3)*14, 12 + Math.floor(i/3)*18, 10, 12, (i%2===0)?config.windows:'#1a2744');
            }
            scene.textures.addCanvas('building', c);
        }
    },

    _generateTree(scene, config) {
        if (!scene.textures.exists('data_tree')) {
            const c = AssetBase.createCanvas(config.w, config.h), ctx = c.getContext('2d');
            AssetBase.r(ctx, 22, 32, 4, 28, config.color);
            AssetBase.r(ctx, 12, 16, 24, 16, config.foliage);
            AssetBase.r(ctx, 16, 12, 16, 24, '#00aacc');
            scene.textures.addCanvas('data_tree', c);
        }
    },

    _generateHex(scene) {
        if (!scene.textures.exists('water_hex')) {
            const c = AssetBase.createCanvas(32, 32), ctx = c.getContext('2d');
            ctx.fillStyle = '#00446640';
            ctx.beginPath();
            ctx.moveTo(16, 4); ctx.lineTo(28, 10); ctx.lineTo(28, 22); ctx.lineTo(16, 28); ctx.lineTo(4, 22); ctx.lineTo(4, 10);
            ctx.closePath(); ctx.fill();
            ctx.strokeStyle = '#0066aa'; ctx.stroke();
            scene.textures.addCanvas('water_hex', c);
        }
    },

    _generateNodes(scene) {
        this._totem(scene, 'puzzle_node', '#00d4ff', '#004466');
        this._totem(scene, 'puzzle_node_done', '#10b981', '#064e3b');
        this._totem(scene, 'boss_node', '#ff1744', '#450a0a', true);
    },

    _totem(scene, key, glowColor, baseColor, isBoss = false) {
        if (!scene.textures.exists(key)) {
            const w = isBoss ? 64 : 48, h = isBoss ? 96 : 64;
            const c = AssetBase.createCanvas(w, h), ctx = c.getContext('2d');
            
            // Draw Base Pillar
            const gradient = ctx.createLinearGradient(0, 0, w, 0);
            gradient.addColorStop(0, '#0a0e17');
            gradient.addColorStop(0.5, baseColor);
            gradient.addColorStop(1, '#0a0e17');
            
            ctx.fillStyle = gradient;
            ctx.fillRect(w*0.2, h*0.2, w*0.6, h*0.8);
            
            // Tech details (lines)
            ctx.strokeStyle = 'rgba(255,255,255,0.1)';
            ctx.lineWidth = 1;
            for(let y=h*0.3; y<h; y+=10) {
                ctx.strokeRect(w*0.2, y, w*0.6, 1);
            }

            // Glowing Core
            const coreY = h*0.4;
            const coreH = isBoss ? 30 : 20;
            const radial = ctx.createRadialGradient(w/2, coreY, 2, w/2, coreY, isBoss ? 20 : 15);
            radial.addColorStop(0, '#fff');
            radial.addColorStop(0.3, glowColor);
            radial.addColorStop(1, 'transparent');
            
            ctx.fillStyle = radial;
            ctx.beginPath();
            ctx.arc(w/2, coreY, isBoss ? 15 : 10, 0, Math.PI*2);
            ctx.fill();

            // Floating Rings
            ctx.strokeStyle = glowColor;
            ctx.lineWidth = 2;
            ctx.globalAlpha = 0.5;
            ctx.beginPath();
            ctx.ellipse(w/2, coreY, w*0.3, h*0.05, 0, 0, Math.PI*2);
            ctx.stroke();
            ctx.globalAlpha = 1;

            scene.textures.addCanvas(key, c);
        }
    }
};
