import Phaser from './phaser.js';

export const MapLoader = {
    async load(scene, chapterIndex) {
        try {
            // Load map layout and narrative data in parallel
            const [mapsRes, chapterRes] = await Promise.all([
                fetch('js/data/maps_data.json?v=' + Date.now()),
                fetch(`js/data/chapters/chapter${chapterIndex}.json?v=` + Date.now())
            ]);
            
            const mapsData = await mapsRes.json();
            const chapterNarrative = await chapterRes.json();
            const mapLayout = mapsData.chapters.find(c => c.id === chapterIndex);
            
            // Return merged layout and narrative data
            return { ...mapLayout, ...chapterNarrative };
        } catch (error) {
            console.error("Failed to load chapter data:", error);
            return null;
        }
    },

    build(scene, chapterData) {
        if (chapterData && chapterData.layout) {
            this._buildMap(scene, chapterData);
        }
    },

    _buildMap(scene, chapter) {
        const layout = chapter.layout;
        const legend = chapter.legend;
        const tileSize = 64;

        const mapWidth = layout[0].length * tileSize;
        const mapHeight = layout.length * tileSize;
        const offsetX = (scene.cameras.main.width - mapWidth) / 2;
        const offsetY = (scene.cameras.main.height - mapHeight) / 2;

        let playerSpawned = false;

        layout.forEach((row, y) => {
            row.forEach((tileType, x) => {
                const entityName = legend[tileType];
                const px = x * tileSize + tileSize/2 + offsetX;
                const py = y * tileSize + tileSize/2 + offsetY;

                if (entityName === 'floor') {
                    scene.add.image(px, py, 'floor_tile').setDepth(0);
                    // Spawn player on first floor tile
                    if (!playerSpawned && scene.player) {
                        scene.player.setPosition(px, py);
                        playerSpawned = true;
                    }
                } else if (entityName === 'wall') {
                    const wall = scene.physics.add.staticImage(px, py, 'tileset', 1);
                    wall.setDisplaySize(tileSize, tileSize);
                    scene.physics.add.collider(scene.player, wall);
                } else if (entityName.startsWith('npc_')) {
                    this._spawnEntity(scene, 'npc', entityName, px, py);
                } else if (entityName === 'puzzle_node') {
                    this._spawnEntity(scene, 'puzzle', entityName, px, py);
                } else if (entityName === 'boss_node') {
                    this._spawnEntity(scene, 'boss', entityName, px, py);
                }
            });
        });
    },

    _spawnEntity(scene, type, key, x, y) {
        // This will be expanded to interact with ChapterScene
        scene.events.emit('spawn_entity', { type, key, x, y });
    }
};
