<?php
const MAX_X = 64;

if ($argc == 2) {
	echo "output to " . $argv[1] . "\n";
	$outputName = $argv[1];
} else {
	echo "output to stdout\n";
	$outputName = 'php://stdout';
}


$skipNames = [
	'air' => true,
	'axolotlAdultBodySingle' => true,
	'axolotlBabyBodySingle' => true,
	'axolotlColorLucy' => true,
	'axolotlColorCyan' => true,
	'axolotlColorGold' => true,
	'axolotlColorWild' => true,
	'axolotlColorBlue' => true,
	'banner.black' => true,
	'banner.blue' => true,
	'banner.brown' => true,
	'banner.cyan' => true,
	'banner.gray' => true,
	'banner.green' => true,
	'banner.illager_captain' => true,
	'banner.lightBlue' => true,
	'banner.lime' => true,
	'banner.magenta' => true,
	'banner.orange' => true,
	'banner.pink' => true,
	'banner.purple' => true,
	'banner.red' => true,
	'banner.silver' => true,
	'banner.white' => true,
	'banner.yellow' => true,
	'bed.black' => true,
	'bed.red' => true,
	'bed.green' => true,
	'bed.brown' => true,
	'bed.blue' => true,
	'bed.purple' => true,
	'bed.cyan' => true,
	'bed.silver' => true,
	'bed.gray' => true,
	'bed.pink' => true,
	'bed.lime' => true,
	'bed.yellow' => true,
	'bed.lightBlue' => true,
	'bed.magenta' => true,
	'bed.orange' => true,
	'bed.white' => true,
	'boat.oak' => true,
	'boat.spruce' => true,
	'boat.birch' => true,
	'boat.jungle' => true,
	'boat.acacia' => true,
	'boat.big_oak' => true,
	'boat.mangrove' => true,
	'bucketLava' => true,
	'bucketWater' => true,
	'bucketFish' => true,
	'bucketSalmon' => true,
	'bucketTropical' => true,
	'bucketPuffer' => true,
	'bucketCustomFish' => true,
	'bucketAxolotl' => true,
	'bucketTadpole' => true,
	'bucketPowderSnow' => true,
	'chest_boat.oak' => true,
	'chest_boat.spruce' => true,
	'chest_boat.birch' => true,
	'chest_boat.jungle' => true,
	'chest_boat.acacia' => true,
	'chest_boat.big_oak' => true,
	'chest_boat.mangrove' => true,
	'emptyLocatorMap' => true,
	'milk' => true,
	'porkchop_cooked' => true,
	'record' => true,
	'steak' => true,
	'tipped_arrow' => true,
	'tropicalColorWhite' => true,
	'tropicalColorOrange' => true,
	'tropicalColorMagenta' => true,
	'tropicalColorSky' => true,
	'tropicalColorYellow' => true,
	'tropicalColorLime' => true,
	'tropicalColorRose' => true,
	'tropicalColorGray' => true,
	'tropicalColorSilver' => true,
	'tropicalColorTeal' => true,
	'tropicalColorPlum' => true,
	'tropicalColorBlue' => true,
	'tropicalColorBrown' => true,
	'tropicalColorGreen' => true,
	'tropicalColorRed' => true,
	'tropicalBodyKobSingle' => true,
	'tropicalBodySunstreakSingle' => true,
	'tropicalBodySnooperSingle' => true,
	'tropicalBodyDasherSingle' => true,
	'tropicalBodyBrinelySingle' => true,
	'tropicalBodySpottySingle' => true,
	'tropicalBodyFlopperSingle' => true,
	'tropicalBodyStripeySingle' => true,
	'tropicalBodyGlitterSingle' => true,
	'tropicalBodyBlockfishSingle' => true,
	'tropicalBodyBettySingle' => true,
	'tropicalBodyClayfishSingle' => true,
	'tropicalBodyKobMulti' => true,
	'tropicalBodySunstreakMulti' => true,
	'tropicalBodySnooperMulti' => true,
	'tropicalBodyDasherMulti' => true,
	'tropicalBodyBrinelyMulti' => true,
	'tropicalBodySpottyMulti' => true,
	'tropicalBodyFlopperMulti' => true,
	'tropicalBodyStripeyMulti' => true,
	'tropicalBodyGlitterMulti' => true,
	'tropicalBodyBlockfishMulti' => true,
	'tropicalBodyBettyMulti' => true,
	'tropicalBodyClayfishMulti' => true,
	'tropicalSchoolAnemone' => true,
	'tropicalSchoolBlackTang' => true,
	'tropicalSchoolBlueDory' => true,
	'tropicalSchoolButterflyFish' => true,
	'tropicalSchoolCichlid' => true,
	'tropicalSchoolClownfish' => true,
	'tropicalSchoolCottonCandyBetta' => true,
	'tropicalSchoolDottyback' => true,
	'tropicalSchoolEmperorRedSnapper' => true,
	'tropicalSchoolGoatfish' => true,
	'tropicalSchoolMoorishIdol' => true,
	'tropicalSchoolOrnateButterfly' => true,
	'tropicalSchoolParrotfish' => true,
	'tropicalSchoolQueenAngelFish' => true,
	'tropicalSchoolRedCichlid' => true,
	'tropicalSchoolRedLippedBlenny' => true,
	'tropicalSchoolRedSnapper' => true,
	'tropicalSchoolThreadfin' => true,
	'tropicalSchoolTomatoClown' => true,
	'tropicalSchoolTriggerfish' => true,
	'tropicalSchoolYellowTang' => true,
	'tropicalSchoolYellowtailParrot' => true,
	'camera' => true,
	'dye.black' => true,
	'dye.black_new' => true,
	'dye.blue' => true,
	'dye.blue_new' => true,
	'dye.brown' => true,
	'dye.brown_new' => true,
	'dye.cyan' => true,
	'dye.gray' => true,
	'dye.green' => true,
	'dye.lightBlue' => true,
	'dye.lime' => true,
	'dye.magenta' => true,
	'dye.orange' => true,
	'dye.pink' => true,
	'dye.purple' => true,
	'dye.red' => true,
	'dye.silver' => true,
	'dye.white' => true,
	'dye.white_new' => true,
	'dye.yellow' => true,
	'photo' => true,
	'map.exploration.mansion' => true,
	'map.exploration.monument' => true,
	'map.exploration.treasure' => true,
	'command_block_minecart' => true,
	'minecartFurnace' => true,
	'spawn_egg.entity.agent' => true,
	'spawn_egg.entity.axolotl' => true,
	'spawn_egg.entity.bee' => true,
	'spawn_egg.entity.hoglin' => true,
	'spawn_egg.entity.cat' => true,
	'spawn_egg.entity.chicken' => true,
	'spawn_egg.entity.cow' => true,
	'spawn_egg.entity.cod' => true,
	'spawn_egg.entity.goat' => true,
	'spawn_egg.entity.pufferfish' => true,
	'spawn_egg.entity.salmon' => true,
	'spawn_egg.entity.tropicalfish' => true,
	'spawn_egg.entity.pig' => true,
	'spawn_egg.entity.sheep' => true,
	'spawn_egg.entity.npc' => true,
	'spawn_egg.entity.wolf' => true,
	'spawn_egg.entity.villager' => true,
	'spawn_egg.entity.villager_v2' => true,
	'spawn_egg.entity.vindicator' => true,
	'spawn_egg.entity.mooshroom' => true,
	'spawn_egg.entity.squid' => true,
	'spawn_egg.entity.glow_squid' => true,
	'spawn_egg.entity.rabbit' => true,
	'spawn_egg.entity.bat' => true,
	'spawn_egg.entity.ravager' => true,
	'spawn_egg.entity.iron_golem' => true,
	'spawn_egg.entity.snow_golem' => true,
	'spawn_egg.entity.ocelot' => true,
	'spawn_egg.entity.parrot' => true,
	'spawn_egg.entity.horse' => true,
	'spawn_egg.entity.llama' => true,
	'spawn_egg.entity.trader_llama' => true,
	'spawn_egg.entity.polar_bear' => true,
	'spawn_egg.entity.donkey' => true,
	'spawn_egg.entity.mule' => true,
	'spawn_egg.entity.skeleton_horse' => true,
	'spawn_egg.entity.zombie_horse' => true,
	'spawn_egg.entity.zombie' => true,
	'spawn_egg.entity.drowned' => true,
	'spawn_egg.entity.creeper' => true,
	'spawn_egg.entity.skeleton' => true,
	'spawn_egg.entity.spider' => true,
	'spawn_egg.entity.zombie_pigman' => true,
	'spawn_egg.entity.strider' => true,
	'spawn_egg.entity.slime' => true,
	'spawn_egg.entity.enderman' => true,
	'spawn_egg.entity.silverfish' => true,
	'spawn_egg.entity.cave_spider' => true,
	'spawn_egg.entity.ghast' => true,
	'spawn_egg.entity.magma_cube' => true,
	'spawn_egg.entity.blaze' => true,
	'spawn_egg.entity.zombie_villager' => true,
	'spawn_egg.entity.zombie_villager_v2' => true,
	'spawn_egg.entity.witch' => true,
	'spawn_egg.entity.stray' => true,
	'spawn_egg.entity.husk' => true,
	'spawn_egg.entity.wither_skeleton' => true,
	'spawn_egg.entity.guardian' => true,
	'spawn_egg.entity.elder_guardian' => true,
	'spawn_egg.entity.shulker' => true,
	'spawn_egg.entity.endermite' => true,
	'spawn_egg.entity.evocation_illager' => true,
	'spawn_egg.entity.vex' => true,
	'spawn_egg.entity.turtle' => true,
	'spawn_egg.entity.dolphin' => true,
	'spawn_egg.entity.phantom' => true,
	'spawn_egg.entity.panda' => true,
	'spawn_egg.entity.pillager' => true,
	'spawn_egg.entity.piglin_brute' => true,
	'spawn_egg.entity.piglin' => true,
	'spawn_egg.entity.fox' => true,
	'spawn_egg.entity.unknown' => true,
	'spawn_egg.entity.wandering_trader' => true,
	'spawn_egg.entity.zoglin' => true,
	'painting' => true,
	'skull.char' => true,
	'skull.creeper' => true,
	'skull.dragon' => true,
	'skull.player' => true,
	'skull.skeleton' => true,
	'skull.wither' => true,
	'skull.zombie' => true,
	'spawn_egg.entity.warden' => true,
	'spawn_egg.entity.allay' => true,
	'spawn_egg.entity.frog' => true,
	'spawn_egg.entity.tadpole' => true,
	'written_book' => true,
	'ruby' => true,
	'portfolio' => true,
	'disc_fragment' => true,
];


// itemNames is made from the language pack, with this command:
// grep -oE ^item\\..*\\.name= en_US.lang > itemNames

$itemData = file_get_contents(__DIR__ . '/itemNames');

$itemNames = explode("\n", $itemData);
foreach ($itemNames as $idx => $name) {
	if (trim($name) === '') continue;
	// strip out leading item. and trailing .name=
	$name = substr($name, 5, strlen($name) - 11);

	if (isset($skipNames[$name])) continue;

	$items[$name] = 0;
}

$specialDatas = [
	'bed' => 15,
	'banner' => 15,
	'dye' => 15,
	'boat' => 6,
	'bucket' => [ 0,1,2,3,4,5, 8, 10,11,12,13],
	'shulker_box' => 15,
];

foreach ($specialDatas as $name => $data) {
	if (!is_array($data)) {
		$max = $data;
		$data = [];
		for ($i=0; $i<=$max; $i++) {
			$data[] = $i;
		}
	}
	$items[$name] = $data;
}

$placed = [];


$itemCount = 0;
$z = $x = 0;
$y = -10;


SendCommandToServer("fill 0 $y 0 0 $y 70 air");
for ($x = 28; $x >= 0; $x -= 2) {
	putChest($x, $y, $z);
}

$x = 0;

foreach ($items as $fullName => $data) {
	
	if ($x > MAX_X) {
		$x = 0;
		$z += 2;
	}

	if (is_array($data)) {
		// start a new chest.
		$x += 2;
		$itemCount = 0;
		foreach ($data as $d) {
			addToChest($x, $y, $z, $itemCount++, $fullName, $d);
		}
	} else {
		addToChest($x, $y, $z, $itemCount++, $fullName);
	}

    if ($itemCount > 26) {
        $x += 2;
        $itemCount = 0;
    }

}


sendCommandToServer('say all done');

dumpLog();


function putChest($x, $y, $z) {
	$cy = $y + 5;
	sendCommandToServer("tp originalCabbey $x $cy $z 90 90");

    sendCommandToServer(['setblock', $x, $y, $z, 'chest']);
}

function addToChest($x, $y, $z, $slot, $name, $data='') {
    global $placed;
    sendCommandToServer(['replaceitem', 'block', $x, $y, $z, 'slot.container', $slot, $name, 1, $data]);
    $placed[$x][$y][$z]['slot.'.$slot] = trim($name . ' ' . $data);
}


function dumpLog() {
	global $placed;
	
	$err = fopen("php://stderr", 'w');
	foreach ($placed as $x => $xData) {
		foreach ($xData as $y => $yData) {
			foreach ($yData as $z => $zData) {
				foreach ($zData as $d => $name) {					
					fwrite($err, "$name,$x,$y,$z,$d" . PHP_EOL);
				}
			}
		}
	}
	fclose($err);
}


function sendCommandToServer($command) {
	global $outputName;
	$stream = fopen($outputName, 'a');
	if (is_array($command)) {
		$command = implode(' ', $command);
	}
	fwrite($stream, $command);
	fwrite($stream, PHP_EOL);
	fflush($stream);
	fclose($stream);
	// don't overrun the server....
	usleep(25000);
}