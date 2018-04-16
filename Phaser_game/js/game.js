var game = new Phaser.Game(900, 320, Phaser.CANVAS, 'game', { preload: preload, create: create, update: update, render: render });

function preload() {

	game.load.image('background', 'images/forest2.png');
    game.load.image('hero', 'images/hero.gif');
    game.load.image('ground', 'images/ground.png');
}

function create() {
game.physics.startSystem(Phaser.Physics.ARCADE);
	
game.physics.arcade.gravity.y = 100;
  
background = game.add.tileSprite(0, 0, game.width, game.height, 'background');
background.scale.setTo(1,2);
	
hero = game.add.sprite(0,260, 'hero');
hero.anchor.setTo(0.5, 0.5);

ground = game.add.tileSprite(0,300, game.width, 25, 'ground');

game.physics.enable( hero, Phaser.Physics.ARCADE);
	
hero.body.collideWorldBounds = true;
hero.body.bounce.y = 0.8;
	
}

function update() {
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT))
    {
        hero.x -= 4;
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
    {
        hero.x += 4;
    }

    if (game.input.keyboard.isDown(Phaser.Keyboard.UP))
    {
        hero.y -= 4;
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.DOWN))
    {
        hero.y += 4;
    }
	

}


function render() {
}