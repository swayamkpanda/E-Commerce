<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS AI - TRIP STYLIST
|--------------------------------------------------------------------------
| Demo version
| AI API + MySQL integration will be added later
|--------------------------------------------------------------------------
*/

$userName = $_SESSION['user_name'] ?? 'Fashion Lover';


// ==========================================================
// VARIABLES
// ==========================================================

$destination = '';
$days = '';
$tripType = '';
$weather = '';
$budget = '';
$gender = '';
$style = '';

$submitted = false;

$plan = [];


// ==========================================================
// HANDLE FORM
// ==========================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $submitted = true;

    $destination = trim($_POST['destination'] ?? '');

    $days = intval($_POST['days'] ?? 1);

    $tripType = $_POST['trip_type'] ?? '';

    $weather = $_POST['weather'] ?? '';

    $budget = $_POST['budget'] ?? '';

    $gender = $_POST['gender'] ?? '';

    $style = $_POST['style'] ?? '';

}


// ==========================================================
// DAY NAMES
// ==========================================================

$dayNames = [

    1 => 'Day 1',
    2 => 'Day 2',
    3 => 'Day 3',
    4 => 'Day 4',
    5 => 'Day 5',
    6 => 'Day 6',
    7 => 'Day 7',
    8 => 'Day 8',
    9 => 'Day 9',
    10 => 'Day 10'

];


// ==========================================================
// DEMO AI OUTFIT PLAN
// ==========================================================

if ($submitted) {

    $tops = [

        'Oversized Cotton Shirt',
        'Premium Polo T-Shirt',
        'Relaxed Linen Shirt',
        'Minimal Black T-Shirt',
        'Classic White Shirt',
        'Streetwear Graphic Tee',
        'Knitted Casual Top'

    ];

    $bottoms = [

        'Straight Fit Jeans',
        'Relaxed Trousers',
        'Cargo Pants',
        'Beige Chinos',
        'Black Wide Leg Pants',
        'Cotton Shorts',
        'Classic Denim Jeans'

    ];

    $shoes = [

        'White Sneakers',
        'Running Sneakers',
        'Minimal Casual Shoes',
        'Canvas Shoes',
        'Leather Loafers',
        'Comfort Sandals'

    ];

    $accessories = [

        'Minimal Watch',
        'Black Sunglasses',
        'Silver Bracelet',
        'Crossbody Bag',
        'Classic Cap',
        'Travel Backpack'

    ];

    for ($i = 1; $i <= $days; $i++) {

        $plan[] = [

            'day' => $dayNames[$i] ?? ('Day '.$i),

            'activity' => match ($tripType) {

                'beach' => 'Beach exploration & sunset walk',

                'mountain' => 'Sightseeing & nature adventure',

                'city' => 'City exploration & cafes',

                'roadtrip' => 'Road trip & sightseeing',

                'business' => 'Meetings & evening outing',

                default => 'Explore your destination'

            },

            'top' => $tops[($i - 1) % count($tops)],

            'bottom' => $bottoms[($i + 1) % count($bottoms)],

            'shoe' => $shoes[($i + 2) % count($shoes)],

            'accessory' => $accessories[($i + 3) % count($accessories)]

        ];

    }

}


// ==========================================================
// DISPLAY HELPERS
// ==========================================================

$tripTypeName = [

    'beach' => 'Beach Vacation',

    'mountain' => 'Mountain Trip',

    'city' => 'City Trip',

    'roadtrip' => 'Road Trip',

    'business' => 'Business Trip',

    'family' => 'Family Vacation',

    'solo' => 'Solo Travel'

];

$weatherName = [

    'hot' => 'Hot ☀️',

    'warm' => 'Warm 🌤️',

    'mild' => 'Mild 🌥️',

    'cold' => 'Cold ❄️',

    'rainy' => 'Rainy 🌧️'

];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Trip Stylist | SSISS AI</title>

</head>

<body>


<!-- HEADER -->

<header>

<h1>✈️ SSISS Trip Stylist</h1>

<p>

Welcome,

<?= htmlspecialchars($userName); ?>

👋

</p>

<p>

Plan your travel wardrobe with AI.

</p>

</header>

<hr>


<!-- INTRO -->

<section>

<h2>AI Travel Fashion Planner</h2>

<p>

Tell us where you're going and SSISS AI will create
a complete outfit plan for every day of your trip.

</p>

<ul>

<li>Destination based styling</li>

<li>Day wise outfit planning</li>

<li>Weather friendly clothes</li>

<li>Budget optimized recommendations</li>

<li>Matching shoes and accessories</li>

</ul>

</section>

<hr>


<!-- FORM -->

<section>

<h2>Plan My Trip</h2>

<form method="POST" action="trip-stylist.php">


<!-- DESTINATION -->

<label for="destination">

<strong>Destination</strong>

</label>

<br><br>

<input

type="text"

id="destination"

name="destination"

placeholder="Example: Goa, Manali, Mumbai, Paris..."

value="<?= htmlspecialchars($destination); ?>"

required

>

<br><br>


<!-- DAYS -->

<label for="days">

<strong>Number of Days</strong>

</label>

<br><br>

<select

id="days"

name="days"

required

>

<option value="">Select Days</option>

<?php for ($i=1;$i<=10;$i++): ?>

<option

value="<?= $i; ?>"

<?= $days == $i ? 'selected' : ''; ?>

>

<?= $i; ?> Day<?= $i > 1 ? 's' : ''; ?>

</option>

<?php endfor; ?>

</select>

<br><br>


<!-- TRIP TYPE -->

<label for="trip_type">

<strong>Trip Type</strong>

</label>

<br><br>

<select

id="trip_type"

name="trip_type"

required

>

<option value="">Select Trip Type</option>

<option value="beach">🏖 Beach Vacation</option>

<option value="mountain">🏔 Mountain Trip</option>

<option value="city">🏙 City Trip</option>

<option value="roadtrip">🚗 Road Trip</option>

<option value="business">💼 Business Trip</option>

<option value="family">👨‍👩‍👧 Family Vacation</option>

<option value="solo">🎒 Solo Travel</option>

</select>

<br><br>


<!-- WEATHER -->

<label for="weather">

<strong>Expected Weather</strong>

</label>

<br><br>

<select

id="weather"

name="weather"

required

>

<option value="">Select Weather</option>

<option value="hot">☀️ Hot</option>

<option value="warm">🌤 Warm</option>

<option value="mild">🌥 Mild</option>

<option value="cold">❄️ Cold</option>

<option value="rainy">🌧 Rainy</option>

</select>

<br><br>


<!-- GENDER -->

<label for="gender">

<strong>Styling For</strong>

</label>

<br><br>

<select

id="gender"

name="gender"

required

>

<option value="">Select</option>

<option value="men">Men</option>

<option value="women">Women</option>

<option value="unisex">Unisex</option>

</select>

<br><br>


<!-- STYLE -->

<label for="style">

<strong>Preferred Style</strong>

</label>

<br><br>

<select

id="style"

name="style"

>

<option value="">Let AI Decide</option>

<option value="casual">Casual</option>

<option value="streetwear">Streetwear</option>

<option value="minimal">Minimal</option>

<option value="old-money">Old Money</option>

<option value="formal">Formal</option>

<option value="sporty">Sporty</option>

<option value="korean">Korean</option>

<option value="y2k">Y2K</option>

</select>

<br><br>


<!-- BUDGET -->

<label for="budget">

<strong>Total Budget</strong>

</label>

<br><br>

<select

id="budget"

name="budget"

required

>

<option value="">Select Budget</option>

<option value="2000">₹2,000</option>

<option value="3000">₹3,000</option>

<option value="5000">₹5,000</option>

<option value="8000">₹8,000</option>

<option value="10000">₹10,000</option>

<option value="15000">₹15,000+</option>

</select>

<br><br>

<button type="submit">

✨ Generate Trip Wardrobe

</button>

</form>

</section>

<hr>


<!-- RESULT -->

<?php if ($submitted): ?>

<section>

<h2>🎯 Your AI Trip Plan</h2>

<p>

<strong>Destination:</strong>

<?= htmlspecialchars($destination); ?>

</p>

<p>

<strong>Trip:</strong>

<?= htmlspecialchars($tripTypeName[$tripType] ?? $tripType); ?>

</p>

<p>

<strong>Weather:</strong>

<?= htmlspecialchars($weatherName[$weather] ?? $weather); ?>

</p>

<p>

<strong>Style:</strong>

<?= htmlspecialchars(ucfirst($style ?: 'AI Selected')); ?>

</p>

<p>

<strong>Budget:</strong>

₹<?= htmlspecialchars($budget); ?>

</p>

<hr>

<h2>👕 Day Wise Outfit Planner</h2>

<?php foreach ($plan as $outfit): ?>

<article>

<h3>

<?= htmlspecialchars($outfit['day']); ?>

</h3>

<p>

<strong>Activity:</strong>

<?= htmlspecialchars($outfit['activity']); ?>

</p>

<p>

👕 <strong>Top:</strong>

<?= htmlspecialchars($outfit['top']); ?>

</p>

<p>

👖 <strong>Bottom:</strong>

<?= htmlspecialchars($outfit['bottom']); ?>

</p>

<p>

👟 <strong>Shoes:</strong>

<?= htmlspecialchars($outfit['shoe']); ?>

</p>

<p>

⌚ <strong>Accessory:</strong>

<?= htmlspecialchars($outfit['accessory']); ?>

</p>

<button

type="button"

onclick="alert('Products will come from MySQL later.')"

>

View Matching Products

</button>

</article>

<br>

<?php endforeach; ?>

</section>

<hr>


<!-- PACKING LIST -->

<section>

<h2>🎒 Smart Packing List</h2>

<ul>

<li>2–4 Tops</li>

<li>2–3 Bottoms</li>

<li>1 Pair of Everyday Shoes</li>

<li>1 Comfortable Travel Shoe</li>

<li>Watch / Sunglasses</li>

<li>Backpack or Travel Bag</li>

<li>Weather Appropriate Jacket if Needed</li>

</ul>

</section>

<hr>


<!-- AI NOTE -->

<section>

<h2>🤖 AI Note</h2>

<p>

This is currently a demo wardrobe generator.

Later it will use:

</p>

<ol>

<li>Real weather API</li>

<li>AI fashion model</li>

<li>Destination information</li>

<li>User style profile</li>

<li>MySQL SSISS products</li>

<li>Budget optimization</li>

</ol>

</section>

<?php endif; ?>

<hr>


<footer>

<p>

<a href="index.php">

← AI Fashion Studio

</a>

</p>

<p>

<a href="../index.php">

← Back to Store

</a>

</p>

</footer>

</body>

</html>