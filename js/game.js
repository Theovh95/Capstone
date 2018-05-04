var game = new Phaser.Game(900, 320, Phaser.CANVAS, 'game', { preload: preload, create: create, update: update, render: render });

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
	game.load.image('platform', 'images/groundtiles.png');
	
}
	score = 0;
	health = 3;


function create() {

	
	
	
game.physics.startSystem(Phaser.Physics.ARCADE);
	
game.physics.arcade.gravity.y = 55;
  
ground = game.add.tileSprite(0,317, game.width, 25, 'ground');
	
backgroundSet();
	
	//end sprite
	
end = game.add.sprite(870,260, 'end');
end.anchor.setTo(0.5, 0.5);
game.physics.enable( end, Phaser.Physics.ARCADE);
end.body.collideWorldBounds = true;
//hero
	
resetHero();
//dog
	
	
spawnDog();

spawnGround();

scoreTrack();
	
healthTrack();
	
	
game.input.keyboard.addKeyCapture([ Phaser.Keyboard.LEFT, Phaser.Keyboard.RIGHT, Phaser.keyboard.UP, Phaser.Keyboard.DOWN, Phaser.Keyboard.SPACEBAR ]);
	
}

function update() {

	
	if (game.input.keyboard.isDown(Phaser.Keyboard.LEFT))
    {
        hero.x -= 2;
		
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.RIGHT))
    {
        hero.x += 2;
    }

    if (game.input.keyboard.isDown(Phaser.Keyboard.UP))
    {
        hero.y -= 1.2;
    }
    else if (game.input.keyboard.isDown(Phaser.Keyboard.DOWN))
    {
        hero.y += 4;
    }
	
	if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR))
    {
		
       hero.loadTexture('punch',0);
		
    }else{
		
		hero.loadTexture('hero',0);
	}

	
	game.physics.arcade.moveToXY(dog, -40, 310, 100);
	game.physics.arcade.overlap(hero, dog, collisionHandler, null, this);
	game.physics.arcade.overlap(hero, end, collisionHandlerEnd, null, this);

}


function render() {
}
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
}
function spawnGround(){
platform = game.add.tileSprite(Math.floor(Math.random()*400),250, game.width /Math.floor(Math.random()*4), 25, 'platform');

}
function resetHero() {

hero = game.add.sprite(0,260, 'hero');
hero.anchor.setTo(0.5, 0.5);
hero.checkWorldBounds= true;
game.physics.enable( hero, Phaser.Physics.ARCADE);
hero.body.collideWorldBounds = true;
//hero.body.bounce.y = 0.5;
   
}
function spawnDog(){
dog = game.add.sprite(950,310, 'enemy');
dog.anchor.setTo(0.5, 0.9);
dog.scale.setTo(0.7,0.7);
game.physics.enable( dog, Phaser.Physics.ARCADE);

}
function backgroundSet(){
	
	
random = Math.floor(Math.random() * 3);

	
background = game.add.tileSprite(0, 0, game.width, game.height, 'background' + random);
background.scale.setTo(1,2);
	
}
function collisionHandler(hero, dog){
		
	
		if (game.input.keyboard.isDown(Phaser.Keyboard.SPACEBAR)){
			
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
			hero.kill();
			scoreDiv = document.getElementById('score_input');
			scoreDiv.value = score;
			scoreButton = document.getElementById('score_submit');
			scoreButton.click();
		}

			
	}

	
}
function collisionHandlerEnd(hero, end){
	//reseting hero to begining of canvas
	hero.kill();
	
	resetHero();
	
	//reseting back ground
	backgroundSet();
	background.kill();
	
	//reseting score
	scoreText.destroy();
	scoreTrack();
	healthText.destroy();
	healthTrack();
	//respawn ground and dow
	spawnGround();
	spawnDog();
}