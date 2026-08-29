<?php
session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - COINS MANAGEMENT
|--------------------------------------------------------------------------
| Demo version
| MySQL integration later
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';

$transactions = [

[
'id'=>'COIN-1001',
'user'=>'Aarav Sharma',
'type'=>'Donation Reward',
'change'=>'+200',
'balance'=>1250,
'status'=>'Completed',
'date'=>'29 Aug 2026'
],

[
'id'=>'COIN-1002',
'user'=>'Ananya Das',
'type'=>'Resale Reward',
'change'=>'+120',
'balance'=>980,
'status'=>'Completed',
'date'=>'29 Aug 2026'
],

[
'id'=>'COIN-1003',
'user'=>'Rohan Patel',
'type'=>'Discount Used',
'change'=>'-80',
'balance'=>540,
'status'=>'Completed',
'date'=>'28 Aug 2026'
],

[
'id'=>'COIN-1004',
'user'=>'Diya Mehta',
'type'=>'Referral Bonus',
'change'=>'+150',
'balance'=>1320,
'status'=>'Completed',
'date'=>'28 Aug 2026'
],

[
'id'=>'COIN-1005',
'user'=>'Kabir Singh',
'type'=>'Donation Reward',
'change'=>'+300',
'balance'=>760,
'status'=>'Pending',
'date'=>'27 Aug 2026'
],

[
'id'=>'COIN-1006',
'user'=>'Meera Nair',
'type'=>'Discount Used',
'change'=>'-100',
'balance'=>870,
'status'=>'Completed',
'date'=>'27 Aug 2026'
],

[
'id'=>'COIN-1007',
'user'=>'Vihaan Roy',
'type'=>'Resale Reward',
'change'=>'+180',
'balance'=>640,
'status'=>'Completed',
'date'=>'26 Aug 2026'
],

[
'id'=>'COIN-1008',
'user'=>'Saanvi Rao',
'type'=>'Donation Reward',
'change'=>'+250',
'balance'=>1450,
'status'=>'Completed',
'date'=>'25 Aug 2026'
]

];

$totalCoins = 0;
$totalEarned = 0;
$totalRedeemed = 0;
$pendingRewards = 0;

foreach($transactions as $t){

$totalCoins += $t['balance'];

if(strpos($t['change'],'+')===0){

$totalEarned += intval(substr($t['change'],1));

}else{

$totalRedeemed += intval(substr($t['change'],1));

}

if($t['status']=='Pending'){
$pendingRewards++;
}

}

$search = $_GET['search'] ?? '';
$typeFilter = $_GET['type'] ?? '';
$statusFilter = $_GET['status'] ?? '';

$filtered = array_filter($transactions,function($t) use($search,$typeFilter,$statusFilter){

if($search!=''){
$text=strtolower($t['id'].' '.$t['user']);
if(strpos($text,strtolower($search))===false)return false;
}

if($typeFilter!='' && $t['type']!=$typeFilter)return false;
if($statusFilter!='' && $t['status']!=$statusFilter)return false;

return true;

});
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>SSISS Coins</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>
<body>

<div class="admin-layout">

<!-- Sidebar (same as previous pages) -->
<aside class="admin-sidebar">

<div class="admin-logo">SSISS</div>
<div class="admin-label">ADMIN PANEL</div>

<nav class="admin-nav">

<a href="index.php" class="admin-nav-item">⌂ Dashboard</a>
<a href="products.php" class="admin-nav-item">◈ Products</a>
<a href="categories.php" class="admin-nav-item">▦ Categories</a>
<a href="brands.php" class="admin-nav-item">◇ Brands</a>
<a href="inventory.php" class="admin-nav-item">▤ Inventory</a>
<a href="orders.php" class="admin-nav-item">□ Orders</a>
<a href="users.php" class="admin-nav-item">♙ Users</a>

<div class="admin-nav-divider"></div>

<div class="admin-section-title">CIRCULAR FASHION</div>

<a href="resale.php" class="admin-nav-item">♻ Pre-Loved</a>
<a href="donations.php" class="admin-nav-item">♥ Donations</a>
<a href="ngos.php" class="admin-nav-item">◎ NGOs</a>

<div class="admin-nav-divider"></div>

<div class="admin-section-title">AI & REWARDS</div>

<a href="coins.php" class="admin-nav-item active">🪙 SSISS Coins</a>
<a href="rewards.php" class="admin-nav-item">✦ Rewards</a>
<a href="ai-analytics.php" class="admin-nav-item">✧ AI Analytics</a>

<div class="admin-nav-divider"></div>

<a href="reports.php" class="admin-nav-item">▥ Reports</a>
<a href="settings.php" class="admin-nav-item">⚙ Settings</a>

</nav>

<div class="admin-sidebar-bottom">

<a href="../index.php" class="view-store">← View Store</a>

<div class="admin-profile-mini">

<div class="admin-avatar">
<?= strtoupper(substr($adminName,0,1)); ?>
</div>

<div>
<strong><?= htmlspecialchars($adminName); ?></strong>
<small>Administrator</small>
</div>

</div>

</div>

</aside>

<!-- MAIN -->

<main class="admin-main">

<header class="admin-topbar">

<div>

<p class="admin-breadcrumb">SSISS / Coins</p>

<h1>SSISS Coins</h1>

<p class="admin-subtitle">
Manage rewards, redemptions and customer balances.
</p>

</div>

</header>

<section class="page-actions">

<div>

<h2>Coin Management</h2>

<p>Reward users and track every transaction.</p>

</div>

<button class="btn btn-primary"
onclick="alert('Manual coin assignment will be added later.')">

+ Add Coins

</button>

</section>

<!-- STATS -->

<section class="stats-grid">

<div class="stat-card">
<p>Total Coins</p>
<h2>🪙 <?= number_format($totalCoins); ?></h2>
</div>

<div class="stat-card">
<p>Coins Earned</p>
<h2><?= number_format($totalEarned); ?></h2>
</div>

<div class="stat-card">
<p>Coins Redeemed</p>
<h2><?= number_format($totalRedeemed); ?></h2>
</div>

<div class="stat-card">
<p>Pending Rewards</p>
<h2><?= $pendingRewards; ?></h2>
</div>

</section>

<!-- LEADERBOARD -->

<section class="dashboard-panel">

<div class="panel-header">
<div>
<h3>Top Coin Holders</h3>
<p>Highest SSISS Coin balances.</p>
</div>
</div>

<div class="table-wrapper">

<table class="admin-table">

<thead>

<tr>

<th>Rank</th>
<th>User</th>
<th>Coins</th>

</tr>

</thead>

<tbody>

<?php

$leaderboard=$transactions;
usort($leaderboard,function($a,$b){
return $b['balance']-$a['balance'];
});

$rank=1;

foreach(array_slice($leaderboard,0,5) as $u):

?>

<tr>

<td>#<?= $rank++; ?></td>

<td><?= htmlspecialchars($u['user']); ?></td>

<td>🪙 <?= number_format($u['balance']); ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</section>

<!-- FILTERS -->

<section class="dashboard-panel">

<form method="GET" class="filter-form">

<div class="form-group">

<label>Search</label>

<input type="search"
name="search"
value="<?= htmlspecialchars($search); ?>"
placeholder="User or Transaction ID">

</div>

<div class="form-group">

<label>Type</label>

<select name="type">

<option value="">All</option>

<option value="Donation Reward">Donation</option>
<option value="Resale Reward">Resale</option>
<option value="Referral Bonus">Referral</option>
<option value="Discount Used">Discount</option>

</select>

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option value="">All</option>
<option value="Completed">Completed</option>
<option value="Pending">Pending</option>

</select>

</div>

<div class="form-actions">

<button class="btn btn-primary">Apply</button>

<a href="coins.php" class="btn btn-secondary">
Reset
</a>

</div>

</form>

</section>

<!-- TRANSACTION TABLE -->

<section class="dashboard-panel">

<div class="panel-header">

<div>

<h3>Coin Transactions</h3>

<p><?= count($filtered); ?> transaction(s)</p>

</div>

</div>

<div class="table-wrapper">

<table class="admin-table">

<thead>

<tr>

<th>ID</th>
<th>User</th>
<th>Type</th>
<th>Change</th>
<th>Balance</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php foreach($filtered as $t): ?>

<tr>

<td><?= htmlspecialchars($t['id']); ?></td>

<td><?= htmlspecialchars($t['user']); ?></td>

<td><?= htmlspecialchars($t['type']); ?></td>

<td>

<strong><?= $t['change']; ?></strong>

</td>

<td>

🪙 <?= number_format($t['balance']); ?>

</td>

<td>

<?php
$class=$t['status']=='Completed'
?'status-active'
:'status-warning';
?>

<span class="status-badge <?= $class; ?>">
<?= $t['status']; ?>
</span>

</td>

<td><?= htmlspecialchars($t['date']); ?></td>

<td>

<div class="table-actions">

<button class="table-action"
onclick="alert('Transaction details later.')">

View

</button>

<button class="table-action"
onclick="alert('Edit coin balance later.')">

Edit

</button>

</div>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</section>

<footer class="admin-footer">

<span>SSISS Admin Panel</span>

<span>Fashion • AI • Impact</span>

</footer>

</main>

</div>

</body>
</html>