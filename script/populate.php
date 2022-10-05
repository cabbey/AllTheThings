<?php
const MAX_X = 64;

if ($argc == 2) {
	echo "output to " . $argv[1] . "\n";
	$outputName = $argv[1];
} else {
	echo "output to stdout\n";
	$outputName = 'php://stdout';
}

$blockData = json_decode(file_get_contents(__DIR__ . '/blocks.json'), true);

// sort blocks by backwards strings... this groups *_candle and *_stair for example.
uksort($blockData, function($left, $right) {return strcmp(strrev($left), strrev($right));} );

$placed = [];

$skipNames = [
	'camera' => true,
	'allow' => true,
	'deny' => true,
	'air' => true,
	'grass' => true,
	'deadbush' => true,
	'barrier' => true,
	'end_gateway' => true,
	'format_version' => true,
	'glowingobsidian' => true,
	'info_update' => true,
	'info_update2' => true,
	'invisibleBedrock' => true,
	'jigsaw' => true,
	'movingBlock' => true,
	'netherreactor' => true,
	'reserved6' => true,
	'structure_void' => true,
	'structure_block' => true,
	'lava' => true,
	'flowing_lava' => true,
	'water' => true,
	'flowing_water' => true,
    'pointed_dripstone' => true,
	'dripstone' => true,
    'unlit_redstone_torch' => true,
	'piston' => true,
	'pistonArmCollision' => true,
	'sticky_piston' => true,
	'stickyPistonArmCollision' => true,
	'budding_amethyst' => true, // will get this from the 6 ways for the buds
	'end_portal' => true,
	'portal' => true,
	'chest' => true, //penty of these already
];

$waterNames = [
	'blue_ice' => true,
	'ice' => true,
	'frosted_ice' => true,
	'packed_ice' => true,
	'bubble_column' => true,
	'conduit' => true,
	'coral' => true,
	'coral_block' => true,
	'coral_fan' => true,
	'coral_fan_dead' => true,
	'coral_fan_hang' => true,
	'coral_fan_hang2' => true,
	'coral_fan_hang3' => true,
	'kelp' => true,
	'sea_pickle' => true,
	'seagrass' => true,
	'waterlily' => true,
	'sugar_cane' => true,
	'frog_spawn' => true,
];

$sixWayOddballs = [
	'amethyst_cluster' => 'budding_amethyst',
	'large_amethyst_bud' => 'budding_amethyst',
	'medium_amethyst_bud' => 'budding_amethyst',
	'small_amethyst_bud' => 'budding_amethyst',
	'lightning_rod' => 'glass',
	'end_rod' => 'glass',
];

$dataMax = [
	'bed' => 3,
	'barrel' => 5,
	'basalt' => 3,
	'polished_basalt' => 3,
	'chain' => 3,
	'purpur_block' => 11,
	'quartz_block' => 11,
	'lit_pumpkin' => 3,
	'pumpkin' => 3,
	'carved_pumpkin' => 3,
	'mangrove_roots' => 3,
];

$dataList = [
	'bone_block' => [4,5,6],
	'campfire' => [4,5,6,7,0,1,2,3],
	'soul_campfire' => [4,5,6,7,0,1,2,3],

];

$blockToItemMap = [
	'carrots' => 'carrot',
	'potatoes' => 'potato',
	'powder_snow' => 'bucket_of_snow',
	'standing_sign' => 'sign',
	'acacia_standing_sign' => 'acacia_sign',
	'warped_standing_sign' => 'warped_sign',
	'spruce_standing_sign' => 'spruce_sign',
	'jungle_standing_sign' => 'jungle_sign',
	'mangrove_standing_sign' => 'mangrove_sign',
	'birch_standing_sign' => 'birch_sign',
	'darkoak_standing_sign' => 'darkoak_sign',
	'crimson_standing_sign' => 'crimson_sign',
	'wall_sign' => 'sign',
	'acacia_wall_sign' => 'acacia_sign',
	'warped_wall_sign' => 'warped_sign',
	'spruce_wall_sign' => 'spruce_sign',
	'jungle_wall_sign' => 'jungle_sign',
	'mangrove_wall_sign' => 'mangrove_sign',
	'birch_wall_sign' => 'birch_sign',
	'darkoak_wall_sign' => 'darkoak_sign',
	'crimson_wall_sign' => 'crimson_sign',
];

// makefishtank();

$itemCount = 0;
$z = 0;
// echo "fill 0 4 0 0 4 70 air" . PHP_EOL;
// foreach ($items as $fullName) {
//     if (0 === $itemCount) {
//         putChest(0, 4, $z);
//     }

//     $parts = explode('.', $fullName);
//     if ($parts[count($parts) - 1] != 'name') continue;
//     unset($parts[0]); // "item."
//     unset($parts[count($parts)]); // ".name"

//     $shortName = implode('_', $parts);
//     addToChest(0, 4, $z, $itemCount++, $shortName);

//     if (count($parts) > 1) {
//         $shortName = implode('.', $parts);
//         addToChest(0, 4, $z, $itemCount++, $shortName);
//     }

//     if ($itemCount >= 25) {
//         $z += 2;
//         $itemCount = 0;
//     }
// }

$itemCount = 0;
$z = 0;
// echo "fill -2 4 0 -2 4 92 air" . PHP_EOL;
// foreach ($newTiles as $shortName) {
//     if (0 === $itemCount) {
//         putChest(-2, 4, $z);
//     }

//     // $parts = explode('.', $fullName);
//     // if ($parts[count($parts) - 1] != 'name') continue;
//     // unset($parts[0]); // "item."
//     // unset($parts[count($parts)]); // ".name"

//     // $shortName = implode('_', $parts);
//     addToChest(-2, 4, $z, $itemCount++, $shortName);

//     // if (count($parts) > 1) {
//     //     $shortName = implode('.', $parts);
//     //     addToChest(-2, 4, $z, $itemCount++, $shortName);
//     // }

//     if ($itemCount >= 25) {
//         $z += 2;
//         $itemCount = 0;
//     }
// }

$stackX = 5;
$stackZ = 5;

$sixWayX = 5;
$sixWayZ = -5;

$maxX = MAX_X;

// clear stack and four/sixways areas, one layer at a time
sendCommandToServer('tp originalCabbey 32 50 24 90 90');
sleep (10);

for ($y=22; $y > 3; $y--) {
	// stacks, put stone in the corners, then fill with air. Deals with bootstraping this way.
	setBlock('stone', 1, $y, 1);
	setBlock('stone', $maxX, $y, 64);
	setBlock('stone', 1, $y, 64);
	setBlock('stone', $maxX, $y, 1);
	sendCommandToServer(['fill', 1, $y, 1, $maxX, $y, 64,  'air']);

	// and the sixways the same
	setBlock('stone', 1, $y, -1);
	setBlock('stone', $maxX, $y, -1);
	setBlock('stone', 1, $y, -20);
	setBlock('stone', $maxX, $y, -20);
	sendCommandToServer(['fill', 1, $y, -1, $maxX, $y, -20,  'air']);
}
sleep(1);// let the killed blocks drop whatever they're going to drop...
sendCommandToServer("kill @e[type=item]");
sendCommandToServer("fill 4 3 4 $maxX 3 64 grass"); //stacks
sendCommandToServer("fill 4 3 -4 $maxX 3 -20 grass"); //sixways


foreach ($blockData as $name => $unusedInfo) {
	if ($skipNames[$name] ?? false) continue;
	if ($waterNames[$name] ?? false) continue;

	sendCommandToServer(
		"say next is $name..."
	);
	usleep(500000);

    if ($name === 'lever') {
        placeFourWays($name, 1, 'glass', 5, 7);
        placeFourWays($name, 1, 'glass', 6, 8);
        continue;
    }

    if (strpos($name, 'torch') !== false) {
        placeFourWays($name, 1, 'glass', 0);
        continue;
    }

    if (strpos($name, 'button') !== false) {
        placeSixWays($name, 0);
        placeSixWays($name, 8);
        continue;
    }

    if (strpos($name, 'wall_sign') !== false) {
        placeSixWays($name, 2, 'glass', false);
        continue;
    }

    if (strpos($name, 'ladder') !== false) {
        placeSixWays($name, 2, 'glass', false);
        continue;
    }


	if (strpos($name, 'lantern') !== false) {
		placeStackWithDataList($name, [0,1], 'glass', 'glass');
		continue;
	}

	if (strpos($name, 'bell') !== false) {
		placeStackWithDataList($name, [0,4], 'glass', 'glass');
		continue;
	}


    if ($name === 'shulker_box') {
        placeStackWithDataRange($name, 0, 15);
        continue;
    }

    if ($name === 'frame' || $name === 'glow_frame') {
		placeFrames($name);
        continue;
    }

    if (isset($sixWayOddballs[$name])) {
		placeSixWayOddballs($name, $sixWayOddballs[$name]);
		continue;
	}

	if (strpos($name, '_stair') !== false) {
		placeStackWithDataRange($name, 0, 7);
		continue;
	}

	if (strpos($name, '_glazed_terracotta') !== false) {
		placeStackWithDataRange($name, 1, 4);
		continue;
	}

	if (strpos($name, 'stained_glass') !== false) {
		placeStackWithDataRange($name, 0, 15);
		continue;
	}

	if (strpos($name, 'sandstone') !== false) {
		placeStackWithDataRange($name, 0, 3);
		continue;
	}

	if (strpos($name, 'wool') !== false) {
		placeStackWithDataRange($name, 0, 15);
		continue;
	}

	if ($name === 'carpet') {
		placeStackWithDataRange($name, 0, 15, 'glass');
		continue;
	}

	if (strpos($name, 'concrete') !== false) { //powder too
		placeStackWithDataRange($name, 0, 15,'glass');
		continue;
	}

	if (strpos($name, '_sign') !== false) {
		placeStackWithDataRange($name, 0, 15, 'glass');
		continue;
	}


	if (strpos($name, '_door') !== false) {
		placeDoorSet($name);
		continue;
	}

	if (strpos($name, 'trapdoor') !== false) {
		placeStackWithDataRange($name, 0, 15, 'glass');
		continue;
	}

	// if (strpos('standing_banner', $name) !== false) {
	// 	placeStackWithDataRange($name, 0, 16, 'glass');
	// 	continue;
	// }

	if (strpos($name, '_flower') !== false) {
		placeStackWithDataRange($name, 0, 0, 'grass');
		continue;
	}

	if (strpos($name, '_candle') !== false && strpos($name, '_candle_') === false) {
		placeStackWithDataRange($name, 0, 8, 'stone');
		continue;
	}

	// glass roof to keep these from growing!
	if (strpos($name, '_sapling') !== false) {
		placeStackWithDataRange($name, 0, 0, 'grass', 'glass');
		continue;
	}
	if ($name === 'bamboo') {
		placeStackWithDataRange($name, 0, 0, 'grass', 'glass');
		continue;
	}


	if (strpos($name, '_propagule') !== false) {
		placeStackWithDataRange($name, 0, 0, 'grass', 'mangrove_leaves');
		continue;
	}

	if (strpos($name, '_log') !== false) {
		placeStackWithDataList($name, [0, 4, 8]);
		continue;
	}


	if (strpos($name, '_gate') !== false) {
		placeStackWithDataList($name, [0,1,4,5]);
		continue;
	}

	if (strpos($name, '_slab') != false && strpos($name, '_double_slab') == false) {
		placeStackWithDataRange($name, 0, 1);
		continue;
	}

	if (strpos($name, '_vine') != false) {
		placeStackWithDataRange($name, 0, 0, null, 'grass');
		continue;
	}

	if (isset($dataMax[$name])) {
		placeStackWithDataRange($name, 0, $dataMax[$name]);
		continue;
	}

	if (isset($dataList[$name])) {
		placeStackWithDataList($name, $dataList[$name]);
		continue;
	}

	placeStackWithDataRange($name, 0, 0, 'grass');
}

sendCommandToServer('say all done');

dumpLog();

function setBlock($name, $x, $y, $z, $d=null) {
	global $placed;
	// sendCommandToServer(['tp originalCabbey', $x, $y+32, $z, 0, 90]);
	// sleep(1);
	sendCommandToServer(['setblock', $x, $y, $z, $name, $d]);
	if (is_array($d)) {
		$placed[$x][$y][$z] = $name;
	} else {
		$placed[$x][$y][$z][$d] = $name;
	}
}

function setBlockWithOptions($name, $x, $y, $z, array $opt) {
	global $placed;

	$tmp = [];
	foreach ($opt as $key => $val) {
		$string = "\"$key\": ";
		if (is_numeric($val)) {
			$string .= $val;
		} elseif (is_bool($val)) {
			$string .= $val ? 'true' : 'false';
		} else {
			$string .= "\"$val\"";
		}
		$tmp[] = $string;
	}
	$optStr = implode(', ', $tmp);
	sendCommandToServer(['setblock', $x, $y, $z, $name, '[', $optStr, ']']);
	$placed[$x][$y][$z][$optStr] = $name;
}

function setChestWithItemBlock($name, $x, $y, $z, $slot=0) {
	global $blockToItemMap;
	putChest($x, $y, $z);
	$itemName = $blockToItemMap[$name] ?? $name;
    addToChest($x, $y, $z, $slot, $itemName);
}

function putChest($x, $y, $z) {
    sendCommandToServer(['setblock', $x, $y, $z, 'chest']);
}

function addToChest($x, $y, $z, $slot, $name) {
    global $placed;
    sendCommandToServer(['replaceitem', 'block', $x, $y, $z, 'slot.container', $slot, $name, 1]);
    $placed[$x][$y][$z]['slot.'.$slot] = $name;
}


function placeFourWays($name, $startData, $center='glass', $topData=null, $bottomData=null) {
    global $sixWayX;
    global $sixWayZ;

    setChestWithItemBlock($name, $sixWayX, 4, $sixWayZ, $startData);

    setBlock($center, $sixWayX, 7, $sixWayZ, 1);

    $data = $startData;

    setblock($name, $sixWayX + 1, 7, $sixWayZ, $data++);
    setblock($name, $sixWayX - 1, 7, $sixWayZ, $data++);

    setblock($name, $sixWayX, 7, $sixWayZ + 1, $data++);
    setblock($name, $sixWayX, 7, $sixWayZ - 1, $data++);

    if ($topData !== null) {
        setblock($name, $sixWayX, 8, $sixWayZ, $topData);
    }

    if ($bottomData !== null) {
        setblock($name, $sixWayX, 6, $sixWayZ, $bottomData);
    }

    $sixWayX += 4;
    if ($sixWayX >= MAX_X) {
        $sixWayX = 5;
        $sixWayZ -= 4;
    }
}

function placeFrames($name, $center='glass') {
    global $sixWayX;
    global $sixWayZ;

    setChestWithItemBlock($name, $sixWayX, 4, $sixWayZ);

    setBlock($center, $sixWayX, 7, $sixWayZ);

    setBlockWithOptions($name, $sixWayX + 1, 7, $sixWayZ, ['facing_direction' => 5]);
    setBlockWithOptions($name, $sixWayX - 1, 7, $sixWayZ, ['facing_direction' => 4]);

    setBlockWithOptions($name, $sixWayX, 7, $sixWayZ + 1, ['facing_direction' => 2]);
    setBlockWithOptions($name, $sixWayX, 7, $sixWayZ - 1, ['facing_direction' => 3]);

    setBlockWithOptions($name, $sixWayX, 8, $sixWayZ, ['facing_direction' => 1]);
    setBlockWithOptions($name, $sixWayX, 6, $sixWayZ, ['facing_direction' => 0]);

    $sixWayX += 4;
    if ($sixWayX >= MAX_X) {
        $sixWayX = 5;
        $sixWayZ -= 4;
    }
}


function placeSixWays($name, $startData, $center="glass", $doTop=true) {
    global $sixWayX;
    global $sixWayZ;

	setChestWithItemBlock($name, $sixWayX, 4, $sixWayZ);
	
	setBlock($center, $sixWayX, 7, $sixWayZ, 1);

	$data = $startData;

	if ($doTop) {
        setblock($name, $sixWayX, 6, $sixWayZ, $data++);
        setblock($name, $sixWayX, 8, $sixWayZ, $data++);
    }

	switch ($name) {
		// some items have north and south facing/attachment opposite.
		case 'end_rod':
			setblock($name, $sixWayX, 7, $sixWayZ - 1, $data++);
			setblock($name, $sixWayX, 7, $sixWayZ + 1, $data++);
			setblock($name, $sixWayX + 1, 7, $sixWayZ, $data++);
			setblock($name, $sixWayX - 1, 7, $sixWayZ, $data++);
		
			break;
		case 'frame':
		case 'glow_frame':
			setblock($name, $sixWayX, 7, $sixWayZ - 1, 3);
			setblock($name, $sixWayX, 7, $sixWayZ + 1, 2);
			setblock($name, $sixWayX + 1, 7, $sixWayZ, 5);
			setblock($name, $sixWayX - 1, 7, $sixWayZ, 4);
			break;
		default:
			setblock($name, $sixWayX, 7, $sixWayZ - 1, $data++);
			setblock($name, $sixWayX, 7, $sixWayZ + 1, $data++);

			setblock($name, $sixWayX - 1, 7, $sixWayZ, $data++);
			setblock($name, $sixWayX + 1, 7, $sixWayZ, $data++);
		
	}

	
	$sixWayX += 4;
	if ($sixWayX >= MAX_X) {
		$sixWayX = 5;
		$sixWayZ -= 4;
	}
	
}

function placeSixWayOddballs($name, $center="budding_amethyst") {
    global $sixWayX;
    global $sixWayZ;

	setChestWithItemBlock($name, $sixWayX, 4, $sixWayZ);
	
	setBlock($center, $sixWayX, 7, $sixWayZ, 1);

	setblockWithOptions($name, $sixWayX, 6, $sixWayZ, ['facing_direction' => 0]);
	setblockWithOptions($name, $sixWayX, 8, $sixWayZ, ['facing_direction' => 1]);

	setblockWithOptions($name, $sixWayX, 7, $sixWayZ - 1, ['facing_direction' => 2]);
	setblockWithOptions($name, $sixWayX, 7, $sixWayZ + 1, ['facing_direction' => 3]);

	setblockWithOptions($name, $sixWayX - 1, 7, $sixWayZ, ['facing_direction' => 4]);
	setblockWithOptions($name, $sixWayX + 1, 7, $sixWayZ, ['facing_direction' => 5]);

	
	$sixWayX += 4;
	if ($sixWayX >= MAX_X) {
		$sixWayX = 5;
		$sixWayZ -= 4;
	}	
}

function placeDoorSet($name) {
    global $sixWayX;
    global $sixWayZ;

	setChestWithItemBlock($name, $sixWayX, 4, $sixWayZ);

	setblockWithOptions($name, $sixWayX, 5, $sixWayZ - 1, ['direction' => 3]); //south
	setblockWithOptions($name, $sixWayX, 5, $sixWayZ + 1, ['direction' => 1]); //north
	setblockWithOptions($name, $sixWayX - 1, 5, $sixWayZ, ['direction' => 2]); //west
	setblockWithOptions($name, $sixWayX + 1, 5, $sixWayZ, ['direction' => 0]); //east



	setblockWithOptions($name, $sixWayX, 7, $sixWayZ - 1, ['direction' => 3, 'door_hinge_bit' => true]); //south
	setblockWithOptions($name, $sixWayX, 7, $sixWayZ + 1, ['direction' => 1, 'door_hinge_bit' => true]); //north
	setblockWithOptions($name, $sixWayX - 1, 7, $sixWayZ, ['direction' => 2, 'door_hinge_bit' => true]); //west
	setblockWithOptions($name, $sixWayX + 1, 7, $sixWayZ, ['direction' => 0, 'door_hinge_bit' => true]); //east



	setblockWithOptions($name, $sixWayX, 9, $sixWayZ - 1, ['direction' => 3, 'open_bit' => true]); //south
	setblockWithOptions($name, $sixWayX, 9, $sixWayZ + 1, ['direction' => 1, 'open_bit' => true]); //north
	setblockWithOptions($name, $sixWayX - 1, 9, $sixWayZ, ['direction' => 2, 'open_bit' => true]); //west
	setblockWithOptions($name, $sixWayX + 1, 9, $sixWayZ, ['direction' => 0, 'open_bit' => true]); //east

	

	setblockWithOptions($name, $sixWayX, 11, $sixWayZ - 1, ['direction' => 3, 'door_hinge_bit' => true, 'open_bit' => true]); //south
	setblockWithOptions($name, $sixWayX, 11, $sixWayZ + 1, ['direction' => 1, 'door_hinge_bit' => true, 'open_bit' => true]); //north
	setblockWithOptions($name, $sixWayX - 1, 11, $sixWayZ, ['direction' => 2, 'door_hinge_bit' => true, 'open_bit' => true]); //west
	setblockWithOptions($name, $sixWayX + 1, 11, $sixWayZ, ['direction' => 0, 'door_hinge_bit' => true, 'open_bit' => true]); //east

	$sixWayX += 4;
	if ($sixWayX >= MAX_X) {
		$sixWayX = 5;
		$sixWayZ -= 4;
	}	
}

function placeStackWithDataList($name, array $data, $platform=null, $roof=null) {
	global $stackX;
	global $stackZ;
	
	setChestWithItemBlock($name, $stackX, 4, $stackZ);
	
	$y = 6;
	
	if ($platform) {
		setBlock($platform, $stackX, $y++, $stackZ);
	}

	if ($roof) {
		setBlock($roof, $stackX, $y + count($data), $stackZ);
	}
	
	foreach ($data as $value) {
		setBlock($name, $stackX, $y++, $stackZ, $value);

		// // hande 2 tall items... maybe? not sure they stack like this anyway.... 
		// if (
		// 	strpos('door', $name) !== false ||
		// 	strpos('banner', $name) !== false
		// ) {
		// 	$y++;
		// }

	}
	
	$stackX += 3;
	if ($stackX >= MAX_X) {
		$stackX = 5;
		$stackZ += 2;
	}
	
}

function placeStackWithDataRange($name, $startData, $endData, $platform=null, $roof=null) {
	$dataRange = [];
	for ($d = $startData; $d <= $endData; $d++) {
		$dataRange[] = $d;
	}
	placeStackWithDataList($name, $dataRange, $platform, $roof);
}

function makeFishTank() {

	$xStart = -5;
	$xWide = 12;

	$yStart = 4;
	$yWide = 24;

	$zStart = -5;
	$zWide = 12;

	$xEnd = $xStart - $xWide;
	$yEnd = $yStart + $yWide;
	$zEnd = $zStart - $zWide;

	for ($y = $yEnd; $y >= $yStart; $y--) {
		sendCommandToServer("fill $xStart $y $zStart $xEnd $y $zEnd air");
	}

	sendCommandToServer("fill $xStart $yStart $zStart $xStart $yEnd $zEnd   glass");
	sendCommandToServer("fill $xStart $yStart $zStart $xEnd   $yEnd $zStart glass");
	sendCommandToServer("fill $xEnd   $yStart $zEnd   $xStart $yEnd $zEnd   glass");
	sendCommandToServer("fill $xEnd   $yStart $zEnd   $xEnd   $yEnd $zStart glass");

	sendCommandToServer(['fill', $xStart - 1, $yStart, $zStart - 1, $xEnd +1, $yEnd, $zEnd +1, 'water']);
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