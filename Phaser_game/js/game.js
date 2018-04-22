var game = new Phaser.Game(800, 320, Phaser.CANVAS, 'game', { preload: preload, create: create, update: update, render: render });

function preload() {

	game.load.image('background', 'images/forest2.png');
	game.load.image('background1', 'images/forest.png');
	game.load.image('background2', 'images/forest3.png');
	game.load.image('background0', 'images/forest4.png');
    game.load.image('hero', 'images/hero.png');
	game.load.image('punch', 'images/punch.png');
    game.load.image('ground', 'images/ground.png');
	game.load.image('enemy', 'images/howl.png');
	game.load.image('end', 'images/Club.png');
    game.load.image('tiles', 'images/tileset1.png');
    game.load.tilemap('forest', 'tilemaps/forestmap3.json', null, Phaser.Tilemap.TILED_JSON);
    
}

var map;
var layer;
var player;

function create() {
    
game.physics.startSystem(Phaser.Physics.ARCADE);
	
game.physics.arcade.gravity.y = 80;

/*
ground = game.add.tileSprite(0,317, game.width, 25, 'ground');
	
backgroundSet();
*/
    map = game.add.tilemap('forest', 32, 32);

    map.addTilesetImage('forest', 'tiles');
    
    //backgroundLayer = map.createLayer('Background');
    //groundLayer = map.createLayer('Ground');
    map.setCollisionBetween(1, 2);
    
    layer = map.createLayer('Background');
     
    layer.resizeWorld();
    layer.wrap = true;
     
    
    
    player = game.add.sprite(20, 100, 'hero');
    player.anchor.set(0.5, 0.5);
    game.physics.enable(player, Phaser.Physics.ARCADE);
    
    game.camera.follow(player);
    

    //end sprite
	
//    end = game.add.sprite(870,260, 'end');
//    end.anchor.setTo(0.5, 0.5);
//    game.physics.enable( end, Phaser.Physics.ARCADE);

    spawnDog();
    
//end.body.collideWorldBounds = true;
//hero
	
//resetHero();
//dog
	
	


	
game.input.keyboard.addKeyCapture([ Phaser.Keyboard.LEFT, Phaser.Keyboard.RIGHT, Phaser.Keyboard.UP, Phaser.Keyboard.DOWN, Phaser.Keyboard.SPACEBAR ]);
	
}

function update() {
    
    game.physics.arcade.collide(player, layer);
    
    //player.body.velocity.set(0);
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT))
    {
        player.x -= 2;
		
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
    {
        player.x += 2;
    }

    if (game.input.keyboard.isDown(Phaser.Keyboard.UP))
    {
        player.y -= 4;
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.DOWN))
    {
        player.y += 4;
    }
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
       //hero.loadTexture('punch',0);
		
    }else{
		
		//hero.loadTexture('hero',0);
	}

	
//	game.physics.arcade.moveToXY(dog, -40, 310, 100);
//	game.physics.arcade.overlap(hero, dog, collisionHandler, null, this);
//	game.physics.arcade.overlap(hero, end, collisionHandlerEnd, null, this);

}


function render() {
}
/*
function resetHero() {

hero = game.add.sprite(0, 100, 'hero');
hero.anchor.setTo(0.5, 0.5);
hero.checkWorldBounds= true;
game.physics.enable( hero, Phaser.Physics.ARCADE);
hero.body.collideWorldBounds = true;
hero.body.bounce.y = 0.5;
    //game.camera.follow(hero);
    
   
}
*/
function spawnDog(){
	dog = game.add.sprite(950,310, 'enemy');
dog.anchor.setTo(0.5, 0.9);
dog.scale.setTo(0.9,0.9);
game.physics.enable( dog, Phaser.Physics.ARCADE);

}
function backgroundSet(){
	
random = Math.floor(Math.random() * 3);

	
background = game.add.tileSprite(0, 0, game.width, game.height, 'background' + random);
background.scale.setTo(1,2);
	
}
function collisionHandler(hero, dog){
	
		if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
        dog.kill();
		spawnDog();
		
    }else{
		hero.kill();
	}	
}
function collisionHandlerEnd(hero, end){
	hero.kill();

	backgroundSet();
	resetHero();
	spawnDog();
}