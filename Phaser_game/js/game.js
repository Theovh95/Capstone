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
	game.load.image('bat', 'images/Thebat.png');
	game.load.image('life', 'images/heart.png');
	game.load.image('end', 'images/Club.png');
    game.load.image('tiles', 'images/tileset1.png');
    game.load.tilemap('forest', 'tilemaps/forestmap3.json', null, Phaser.Tilemap.TILED_JSON);
    
}

var map;
var layer;
var player;
var health = 3;
var score = 0;
var randomY = Math.floor(Math.random() * 12);
var speed = 170;

var width = game.width;

function create() {
    
game.physics.startSystem(Phaser.Physics.ARCADE);
	
game.physics.arcade.gravity.y = 100;


	backgroundSet();
	
    map = game.add.tilemap('forest', 32, 32);

    map.addTilesetImage('forest', 'tiles');
    
    //backgroundLayer = map.createLayer('Background');
    //groundLayer = map.createLayer('Ground');
    map.setCollisionBetween(1, 2);
    
    layer = map.createLayer('Background');
     
    layer.resizeWorld();
    layer.wrap = true;
	
    
    

    //end sprite
	
//    end = game.add.sprite(870,260, 'end');
//    end.anchor.setTo(0.5, 0.5);
//    game.physics.enable( end, Phaser.Physics.ARCADE);
	spawnPlayer();
	spawnLife();
    spawnDog();
	spawnBat();
    spawnEnd();
//end.body.collideWorldBounds = true;
//hero
	
//resetHero();
//dog
	healthTrack();
	scoreTrack();
	


	
game.input.keyboard.addKeyCapture([ Phaser.Keyboard.LEFT, Phaser.Keyboard.RIGHT, Phaser.Keyboard.UP, Phaser.Keyboard.DOWN, Phaser.Keyboard.SPACEBAR ]);
	
}

function update() {
	//alert(speed);

    game.physics.arcade.collide(player, layer);
    game.physics.arcade.collide(dog, layer);
	game.physics.arcade.collide(life, layer);
	game.physics.arcade.collide(end, layer);
    //player.body.velocity.set(0);
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT))
    {
        player.x -= 2;
        player.scale.x = -1;
		
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
    {
        player.x += 2;
        player.scale.x = 1;
    }

    if (game.input.keyboard.isDown(Phaser.Keyboard.UP))
    {
        player.y -= 1.5;
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.DOWN))
    {
        player.y += 1.5;
    }
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
       player.loadTexture('punch',0);
		
    }else{
		
		player.loadTexture('hero',0);
	}

	
    
	game.physics.arcade.moveToXY(dog, player.x, 310, 100);
	game.physics.arcade.moveToXY(bat, player.x, player.y, speed);
	game.physics.arcade.overlap(player, dog, collisionHandlerDog, null, this);
	game.physics.arcade.overlap(player, bat, collisionHandlerBat, null, this);
	game.physics.arcade.overlap(player, life, collisionHandlerLife, null, this);
	game.physics.arcade.overlap(player, end, collisionHandlerReset, null, this);
    
    if (dog.body.velocity.x > 0) {
        dog.scale.x = -1;
    } else if (dog.body.velocity.x < 0 ) {
        dog.scale.x = 1;
    }
    
    if (!player.alive && game.input.keyboard.isDown(Phaser.Keyboard.R))
    {
        resetup();
    }
    
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
function scoreTrack(){
    gameScoreText = game.add.text(300, 10, 'score:', {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "left"
	});
	
	scoreText = game.add.text(365, 10 , score, {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "center"
	});
	gameScoreText.fixedToCamera = true;
	scoreText.fixedToCamera = true;
}

function healthTrack(){
	    
    gameHealthText = game.add.text(150, 10, 'Health:', {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "left"
	});
	  
		healthText = game.add.text(250, 10 , health, {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "center"
	});
	
	gameHealthText.fixedToCamera = true;
	healthText.fixedToCamera = true;
}
function endGame(){
	dog.kill();
	bat.kill();
	player.kill();
    life.kill();
	healthText.destroy();
	gameHealthText.kill();
	gameScoreText.kill();
	scoreText.destroy();
	gameOver = game.add.text(400, 150, 'GAME OVER: SCORE = ' + score, {
		font: "28px Gabriella",
		fill: "red",
		align: "left"
	});
	gameOver.fixedToCamera = true;
	//game.kill();
    
    
    
}
function spawnPlayer(){
	player = game.add.sprite(20, 100, 'hero');
    player.anchor.set(0.5, 0.5);
    game.physics.enable(player, Phaser.Physics.ARCADE);
    
    game.camera.follow(player);
}
function spawnDog(){
    
    
    
	dog = game.add.sprite(player.position.x + randomNumberGeneratorInclusive(game.width/2, game.width) , 250, 'enemy');
	dog.anchor.setTo(0.5, 0.9);
	dog.scale.setTo(0.9,0.9);
	game.physics.enable( dog, Phaser.Physics.ARCADE);

}
function spawnLife(){

	life = game.add.sprite(Math.floor(Math.random() * width) , 250, 'life');
	life.anchor.setTo(0.5, 0.9);
	life.scale.setTo(0.9,0.9);
	game.physics.enable( life, Phaser.Physics.ARCADE);

}
function spawnBat(){
	spawn = Math.floor(Math.random() * 400);
	bat = game.add.sprite(Math.floor(Math.random() * 400) , 20, 'bat');
	bat.anchor.setTo(0.5, 0.9);
	bat.scale.setTo(0.9,0.9);
	game.physics.enable( bat, Phaser.Physics.ARCADE);

}
function spawnEnd(){
	end = game.add.sprite(1600 , 20, 'end');
	game.physics.enable( end, Phaser.Physics.ARCADE);
}
function backgroundSet(){
	
random = Math.floor(Math.random() * 3);

	
background = game.add.tileSprite(0, 0, 800, 320, 'background' + random);
background.scale.setTo(1,2);

	
}
function collisionHandlerDog(hero, dog){
	
		if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
   		score ++;
        dog.kill();
		spawnDog();
		
		scoreText.destroy();
		scoreTrack();
    }else{
		if(health >= 1){
			health--;
			dog.kill();
			spawnDog();
			healthText.destroy();
			healthTrack();
			
		}else{
			endGame();
		}
	}	
}
function collisionHandlerBat(hero, bat){
	
	
		if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
   		score ++;
        bat.kill();
		spawnBat();
		
		scoreText.destroy();
		scoreTrack();
    }else{
		if(health >= 1){
			health--;
			bat.kill();
			spawnBat();
			healthText.destroy();
			healthTrack();
			
			
		}else{
			endGame();
		}
	}	
}
function collisionHandlerLife(hero, life){
	life.kill();
	health++;
	healthText.destroy();
	healthTrack();

}
function collisionHandlerReset(hero, end){
	resetup();

}
function resetup(){
    scoreTrack();
    spawnPlayer();
	spawnLife();
    spawnDog();
	spawnBat();
    spawnEnd();
    gameOver.kill();
    health = 3;
    score = 0;
	
}

function randomNumberGeneratorInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min +1)) + min;
}