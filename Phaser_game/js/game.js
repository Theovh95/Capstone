var game = new Phaser.Game(900, 320, Phaser.CANVAS, 'game', { preload: preload, create: create, update: update, render: render });

function preload() {

	game.load.image('background', 'images/forest2.png');
    game.load.image('hero', 'images/hero.gif');
    game.load.image('ground', 'images/ground.png');
}

function create() {
  
background = game.add.tileSprite(0, 0, game.width, game.height, 'background');
background.scale.setTo(1,2);
	
hero = game.add.sprite(0,260, 'hero');

ground = game.add.tileSprite(0,300, game.width, 25, 'ground');
	
}

function update() {
	

}


function render() {
}