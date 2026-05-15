//modulo input
import Phaser from '../engine/phaser.js';
export default class Input {
  scene;
  keys;

    constructor(scene) {
        this.scene = scene;
        this.keys = scene.input.keyboard.addKeys({
            up: Phaser.Input.Keyboard.KeyCodes.W,
            down: Phaser.Input.Keyboard.KeyCodes.S,
            left: Phaser.Input.Keyboard.KeyCodes.A,
            right: Phaser.Input.Keyboard.KeyCodes.D,
        });
    }

    getMovement() {
        let x = 0;
        let y = 0;

        if (this.keys.left.isDown) x -= 1;
        if (this.keys.right.isDown) x += 1;

        if (this.keys.up.isDown) y -= 1;
        if (this.keys.down.isDown) y += 1;

        return { x, y };
    }
}