var game = new Phaser.Game(900, 320, Phaser.CANVAS, 'game', { preload: preload, create: create, update: update});

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
    game.load.tilemap('forest', 'tilemaps/forestmap4.json', null, Phaser.Tilemap.TILED_JSON);
    game.load.audio('bite', 'sounds/bite.mp3');
	game.load.audio('music', 'sounds/music.wav');
	game.load.audio('punched', 'sounds/punch.wav');
	game.load.audio('wing', 'sounds/wing.wav');
	game.load.audio('end', 'sounds/end.mp3');
	
}

var map;
var layer;
var player;
var health = 3;
var score = 0;
var randomY = Math.floor(Math.random() * 12);
var speed = 70;
var jumpTimer;
var ctr = 0;
var punch = false;

var punchTimer = 0;

var width = game.width;

function create() {
   
    game.physics.startSystem(Phaser.Physics.ARCADE);
	
    game.physics.arcade.gravity.y = 100;
	bite = game.add.audio('bite');
	music = game.add.audio('music');
	music.volume = 0.5;
	music.play();
	punching = game.add.audio('punched');
	ending = game.add.audio('end');

	wing = game.add.audio('wing');
	backgroundSet();
	
    map = game.add.tilemap('forest', 32, 32);

    map.addTilesetImage('forest', 'tiles');
    
    map.setCollisionBetween(1, 2);
    
    layer = map.createLayer('Background');
     
    layer.resizeWorld();
    layer.wrap = true;

	spawnPlayer();
	

	if(ctr == 0 || ctr == 1 || ctr == 4){
		spawnLife();
		
	}
    spawnDog();
	spawnBat();
    spawnEnd();
	healthTrack();
	scoreTrack();
	
    game.input.keyboard.addKeyCapture([ Phaser.Keyboard.LEFT, Phaser.Keyboard.RIGHT, Phaser.Keyboard.UP, Phaser.Keyboard.DOWN, Phaser.Keyboard.SPACEBAR ]);
	

}

function update() {
    
    game.physics.arcade.collide(player, layer);
    game.physics.arcade.collide(dog, layer);
	game.physics.arcade.collide(life, layer);
	game.physics.arcade.collide(end, layer);
	

	
	if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT)) {
        
        player.x -= 2;
        player.scale.x = -1;
    
    } else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT)) {
        
        player.x += 2;
        player.scale.x = 1;
    }

    if (game.input.keyboard.isDown(Phaser.Keyboard.UP) && player.body.blocked.down) {
        
        player.body.velocity.y -= 120;
    }
	
	spaceAttack();
	

		game.physics.arcade.moveToXY(dog, player.x, 310, speed);
		//game.physics.arcade.moveToXY(bat, player.x, player.y, speed );
	batGroup.forEachAlive(function(batGroup)    {        /*batGroup.body.x = player.body.x;*/game.physics.arcade.moveToXY(batGroup, player.x, player.y, speed );
	});


	game.physics.arcade.moveToXY(dog, player.x, 310, speed);
	game.physics.arcade.moveToXY(life, Math.floor(Math.random() * 6), Math.floor(Math.random() * 2), 50);
	game.physics.arcade.overlap(player, dog, collisionHandlerDog, null, this);
	game.physics.arcade.overlap(player, batGroup, collisionHandlerBat, null, this);
	game.physics.arcade.overlap(player, life, collisionHandlerLife, null, this);
	game.physics.arcade.overlap(player, end, collisionHandlerReset, null, this);
    
    if (dog.body.velocity.x > 0) {
        
        dog.scale.x = -1;
        
    } else if (dog.body.velocity.x < 0 ) {
    
        dog.scale.x = 1;
    }
    
    if (!player.alive && game.input.keyboard.isDown(Phaser.Keyboard.R)) {
        
        resetup();
    }
	if (batGroup.length == 0) {
        
        spawnBat();
    }
    
}
function spaceAttack(){
if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR)) {
		

		 
		if(punchTimer == 0){
			punch = true;
			player.loadTexture('punch',0);
			punchTimer = 1;
		}else if(punchTimer > 0 && punchTimer < 30){
			
			punchTimer ++;
		}else if (punchTimer >= 30 && punchTimer < 80){
			punchTimer ++;
		punch = false;
		player.loadTexture('hero',0);
		}
	
		
		
		console.log(game.time.now);
			console.log("punchTimer" + punchTimer);
    } else {
		punchTimer = 0;
		punch = false;
		player.loadTexture('hero',0);
	}
}
function spawnBat(){
	batGroup = game.add.group();
	batGroup.enableBody = true;
	
	var bat;
	
	if(ctr >= 1){
		for (var i = 0; i < 10; i++)
		{
		   var x = randomNumberGeneratorInclusive(game.width, game.world.width);;
		   bat = batGroup.create(x, 10, 'bat');
		}
		
	}else{

		for (var i = 0; i < 5; i++)
		{
		   var x = randomNumberGeneratorInclusive(game.width, game.world.width);;
		   bat = batGroup.create(x, 10, 'bat');
		}
	}

	
}

function scoreTrack() {
    
    gameScoreText = game.add.text(300, 10, 'Score:', {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "left"
	});
	
	scoreText = game.add.text(380, 10 , score, {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "center"
	});
    
	gameScoreText.fixedToCamera = true;
	scoreText.fixedToCamera = true;

}

function healthTrack() {
	    
    gameHealthText = game.add.text(150, 10, 'Health:', {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "left"
	});
	  
	healthText = game.add.text(240, 10 , health, {
		font: "28px Gabriella",
		fill: "#FFFFFF",
		align: "center"
	});
	
	gameHealthText.fixedToCamera = true;
	healthText.fixedToCamera = true;

}

function endGame() {

	music.stop();
	ending.play();
    dog.kill();
	batGroup.kill();
	player.kill();
    life.kill();
	healthText.kill();
	gameHealthText.kill();
	gameScoreText.kill();
	scoreText.kill();
    
	
	gameOver = game.add.text(240, 150, 'GAME OVER: SCORE = ' + score , {
		font: "28px Gabriella",
		fill: "red",
		align: "left"
	});
	restartGame = game.add.text(305, 180, 'Press R to Restart!', {
		font: "28px Gabriella",
		fill: "red",
		align: "left"
	});
    
	gameOver.fixedToCamera = true;
	restartGame.fixedToCamera = true;
	
}

function spawnPlayer() {
    
	player = game.add.sprite(20, 100, 'hero');
    player.anchor.set(0.5, 0.5);
    
    game.physics.enable(player, Phaser.Physics.ARCADE);
    
    player.body.collideWorldBounds = true;
    
    game.camera.follow(player);

	
}

function spawnDog() {
    
	dog = game.add.sprite(player.position.x + randomNumberGeneratorInclusive(game.width/2, game.width) , 250, 'enemy');
	dog.anchor.setTo(0.5, 0.9);
	dog.scale.setTo(0.7,0.7);
    
	game.physics.enable( dog, Phaser.Physics.ARCADE);

}

function spawnLife() {

	life = game.add.sprite(Math.floor(Math.random() * game.width) , 250, 'life');
	life.anchor.setTo(0.5, 0.9);
	life.scale.setTo(0.9,0.9);
	
    game.physics.enable( life, Phaser.Physics.ARCADE);

}

function spawnEnd() {
    
	end = game.add.sprite(2500 , 20, 'end');
	game.physics.enable( end, Phaser.Physics.ARCADE);

}

function backgroundSet() {

    background = game.add.tileSprite(0, 0, 2750, 320, 'background2');
    background.scale.setTo(1,2);

}

function collisionHandlerDog(player, dog) {
	
    if (punch) {
		
		punching.play();
   		score ++;
        dog.kill();
		spawnDog();
		
		scoreText.destroy();
		scoreTrack();
        
    } else {
        
		if (health > 1) {
            bite.play();
			health--;
			dog.kill();
			spawnDog();
			healthText.destroy();
			healthTrack();
			
		} else {
      save_score();
			endGame();
            
		}
	}	
}

function collisionHandlerBat(player, bat){
		
    if (punch) {
		
		punching.play();
		

   		score ++;
        bat.destroy();
		
		
		scoreText.destroy();
		scoreTrack();
        
    } else {
        
		if(health > 1) {
            
			wing.play();
			health--;
			bat.destroy();
			
			healthText.destroy();
			healthTrack();
			
		} else {

      save_score();
			endGame();
        
        }
	}	
}

function collisionHandlerLife(player, life){
    
	life.kill();
	health++;
	healthText.destroy();
	healthTrack();

}

function collisionHandlerReset(player, end) {
	
    reset();

}

function resetup() {

    spawnPlayer();
	spawnLife();
    spawnDog();
	spawnBat();
    spawnEnd();
    healthText.kill();
	scoreText.kill();
    health = 3;
    score = 0;
    healthTrack();
    scoreTrack();
    gameOver.destroy();
	restartGame.destroy();
  ending.stop();
	music.play();
	
    
}

function reset() {
    
    player.kill();
    spawnPlayer();
    spawnLife();
    spawnDog();
	spawnBat();
    spawnEnd();
    ctr += 1;
	if(ctr == 1|| ctr == 3|| ctr == 5){
		speed+= 35;
	}
    
}

function randomNumberGeneratorInclusive(min, max) {
    
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min +1)) + min;

}

function save_score() {
  var score_box = document.getElementById("score_input").value = score;
  var button = document.getElementById("score_submit").click();
}
