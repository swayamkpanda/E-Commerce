<?php

session_start();

/*
|--------------------------------------------------------------------------
| SSISS ADMIN - AI ANALYTICS
|--------------------------------------------------------------------------
| Demo version.
| AI API + MySQL integration will be added later.
|--------------------------------------------------------------------------
*/

$adminName = $_SESSION['admin_name'] ?? 'Admin';


// ==========================================================
// DEMO AI DATA
// ==========================================================

$aiStats = [

    'totalRecommendations' => 12840,
    'todayRecommendations' => 426,
    'successfulRecommendations' => 9840,
    'aiUsers' => 6420,
    'vibeRequests' => 3840,
    'imageAnalyses' => 5120,
    'averageAccuracy' => 87.6,
    'conversionRate' => 76.6

];


// ==========================================================
// VIBE DATA
// ==========================================================

$vibes = [

    [
        'name' => 'Casual',
        'requests' => 1840,
        'percentage' => 31
    ],

    [
        'name' => 'Streetwear',
        'requests' => 1420,
        'percentage' => 24
    ],

    [
        'name' => 'Minimal',
        'requests' => 980,
        'percentage' => 16
    ],

    [
        'name' => 'Old Money',
        'requests' => 760,
        'percentage' => 13
    ],

    [
        'name' => 'Party',
        'requests' => 520,
        'percentage' => 9
    ],

    [
        'name' => 'Sporty',
        'requests' => 320,
        'percentage' => 5
    ]

];


// ==========================================================
// CATEGORY DATA
// ==========================================================

$categories = [

    [
        'category' => 'T-Shirts',
        'recommendations' => 2840,
        'clicks' => 2280,
        'conversion' => 80.3
    ],

    [
        'category' => 'Sneakers',
        'recommendations' => 2380,
        'clicks' => 1980,
        'conversion' => 83.2
    ],

    [
        'category' => 'Dresses',
        'recommendations' => 1920,
        'clicks' => 1510,
        'conversion' => 78.6
    ],

    [
        'category' => 'Watches',
        'recommendations' => 1480,
        'clicks' => 1090,
        'conversion' => 73.6
    ],

    [
        'category' => 'Spectacles',
        'recommendations' => 1260,
        'clicks' => 1010,
        'conversion' => 80.1
    ],

    [
        'category' => 'Jackets',
        'recommendations' => 980,
        'clicks' => 720,
        'conversion' => 73.5
    ]

];


// ==========================================================
// RECENT AI ACTIVITY
// ==========================================================

$aiActivity = [

    [
        'id' => 'AI-1001',
        'user' => 'Aarav Sharma',
        'feature' => 'Vibe Dress AI',
        'vibe' => 'Streetwear',
        'budget' => '₹2,000',
        'recommendations' => 6,
        'result' => 'Successful',
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'AI-1002',
        'user' => 'Ananya Das',
        'feature' => 'Image Style Analysis',
        'vibe' => 'Casual',
        'budget' => '₹3,000',
        'recommendations' => 8,
        'result' => 'Successful',
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'AI-1003',
        'user' => 'Rohan Patel',
        'feature' => 'Budget Stylist',
        'vibe' => 'Minimal',
        'budget' => '₹1,500',
        'recommendations' => 5,
        'result' => 'Successful',
        'date' => '29 Aug 2026'
    ],

    [
        'id' => 'AI-1004',
        'user' => 'Diya Mehta',
        'feature' => 'Vibe Dress AI',
        'vibe' => 'Old Money',
        'budget' => '₹5,000',
        'recommendations' => 7,
        'result' => 'Successful',
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'AI-1005',
        'user' => 'Kabir Singh',
        'feature' => 'Image Style Analysis',
        'vibe' => 'Party',
        'budget' => '₹4,000',
        'recommendations' => 6,
        'result' => 'Failed',
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'AI-1006',
        'user' => 'Meera Nair',
        'feature' => 'Vibe Dress AI',
        'vibe' => 'Casual',
        'budget' => '₹2,500',
        'recommendations' => 9,
        'result' => 'Successful',
        'date' => '28 Aug 2026'
    ],

    [
        'id' => 'AI-1007',
        'user' => 'Vihaan Roy',
        'feature' => 'Budget Stylist',
        'vibe' => 'Sporty',
        'budget' => '₹1,800',
        'recommendations' => 5,
        'result' => 'Successful',
        'date' => '27 Aug 2026'
    ],

    [
        'id' => 'AI-1008',
        'user' => 'Ishita Sen',
        'feature' => 'Image Style Analysis',
        'vibe' => 'Minimal',
        'budget' => '₹3,500',
        'recommendations' => 8,
        'result' => 'Successful',
        'date' => '27 Aug 2026'
    ]

];


// ==========================================================
// FILTERS
// ==========================================================

$search = trim($_GET['search'] ?? '');

$featureFilter = trim(
    $_GET['feature'] ?? ''
);

$resultFilter = trim(
    $_GET['result'] ?? ''
);

$vibeFilter = trim(
    $_GET['vibe'] ?? ''
);


// ==========================================================
// FILTER ACTIVITY
// ==========================================================

$filteredActivity = array_filter(

    $aiActivity,

    function ($activity) use (
        $search,
        $featureFilter,
        $resultFilter,
        $vibeFilter
    ) {

        if ($search !== '') {

            $text = strtolower(

                $activity['id'] . ' ' .
                $activity['user'] . ' ' .
                $activity['feature']

            );

            if (
                strpos(
                    $text,
                    strtolower($search)
                ) === false
            ) {

                return false;

            }

        }


        if (
            $featureFilter !== '' &&
            $activity['feature'] !==
            $featureFilter
        ) {

            return false;

        }


        if (
            $resultFilter !== '' &&
            $activity['result'] !==
            $resultFilter
        ) {

            return false;

        }


        if (
            $vibeFilter !== '' &&
            $activity['vibe'] !==
            $vibeFilter
        ) {

            return false;

        }


        return true;

    }

);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        AI Analytics | SSISS Admin
    </title>


    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

    <link
        rel="stylesheet"
        href="../assets/css/dashboard.css"
    >

</head>


<body>


<div class="admin-layout">


    <!-- ======================================================
         SIDEBAR
    ======================================================= -->

    <aside class="admin-sidebar">


        <div class="admin-logo">
            SSISS
        </div>


        <div class="admin-label">
            ADMIN PANEL
        </div>


        <nav class="admin-nav">


            <a
                href="index.php"
                class="admin-nav-item"
            >
                <span>⌂</span>
                Dashboard
            </a>


            <a
                href="products.php"
                class="admin-nav-item"
            >
                <span>◈</span>
                Products
            </a>


            <a
                href="categories.php"
                class="admin-nav-item"
            >
                <span>▦</span>
                Categories
            </a>


            <a
                href="brands.php"
                class="admin-nav-item"
            >
                <span>◇</span>
                Brands
            </a>


            <a
                href="inventory.php"
                class="admin-nav-item"
            >
                <span>▤</span>
                Inventory
            </a>


            <a
                href="orders.php"
                class="admin-nav-item"
            >
                <span>□</span>
                Orders
            </a>


            <a
                href="users.php"
                class="admin-nav-item"
            >
                <span>♙</span>
                Users
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                CIRCULAR FASHION
            </div>


            <a
                href="resale.php"
                class="admin-nav-item"
            >
                <span>♻</span>
                Pre-Loved
            </a>


            <a
                href="donations.php"
                class="admin-nav-item"
            >
                <span>♥</span>
                Donations
            </a>


            <a
                href="ngos.php"
                class="admin-nav-item"
            >
                <span>◎</span>
                NGOs
            </a>


            <div class="admin-nav-divider"></div>


            <div class="admin-section-title">
                AI & REWARDS
            </div>


            <a
                href="coins.php"
                class="admin-nav-item"
            >
                <span>🪙</span>
                SSISS Coins
            </a>


            <a
                href="rewards.php"
                class="admin-nav-item"
            >
                <span>✦</span>
                Rewards
            </a>


            <a
                href="ai-analytics.php"
                class="admin-nav-item active"
            >
                <span>✧</span>
                AI Analytics
            </a>


            <div class="admin-nav-divider"></div>


            <a
                href="reports.php"
                class="admin-nav-item"
            >
                <span>▥</span>
                Reports
            </a>


            <a
                href="settings.php"
                class="admin-nav-item"
            >
                <span>⚙</span>
                Settings
            </a>


        </nav>


        <div class="admin-sidebar-bottom">


            <a
                href="../index.php"
                class="view-store"
            >
                ← View Store
            </a>


            <div class="admin-profile-mini">


                <div class="admin-avatar">

                    <?= htmlspecialchars(
                        strtoupper(
                            substr(
                                $adminName,
                                0,
                                1
                            )
                        )
                    ); ?>

                </div>


                <div>

                    <strong>

                        <?= htmlspecialchars(
                            $adminName
                        ); ?>

                    </strong>


                    <small>
                        Administrator
                    </small>

                </div>


            </div>


        </div>


    </aside>


    <!-- ======================================================
         MAIN CONTENT
    ======================================================= -->

    <main class="admin-main">


        <header class="admin-topbar">


            <div>

                <p class="admin-breadcrumb">
                    SSISS / AI Analytics
                </p>


                <h1>
                    AI Analytics
                </h1>


                <p class="admin-subtitle">
                    Monitor AI-powered fashion recommendations and user behavior.
                </p>


            </div>


        </header>


        <!-- ==================================================
             PAGE ACTIONS
        =================================================== -->

        <section class="page-actions">


            <div>

                <h2>
                    AI Intelligence Center
                </h2>


                <p>
                    Track recommendation performance and fashion trends.
                </p>


            </div>


            <button
                type="button"
                class="btn btn-primary"
                onclick="alert('AI report export will be connected later.')"
            >
                ↓ Export AI Report
            </button>


        </section>


        <!-- ==================================================
             AI STATISTICS
        =================================================== -->

        <section class="stats-grid">


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ✧
                    </span>

                </div>


                <p>
                    AI Recommendations
                </p>


                <h2>

                    <?= number_format(
                        $aiStats['totalRecommendations']
                    ); ?>

                </h2>


                <small>
                    Total recommendations
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        👥
                    </span>

                </div>


                <p>
                    AI Users
                </p>


                <h2>

                    <?= number_format(
                        $aiStats['aiUsers']
                    ); ?>

                </h2>


                <small>
                    Users using AI features
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        🎯
                    </span>

                </div>


                <p>
                    AI Accuracy
                </p>


                <h2>

                    <?= number_format(
                        $aiStats['averageAccuracy'],
                        1
                    ); ?>%

                </h2>


                <small>
                    Recommendation accuracy
                </small>


            </div>


            <div class="stat-card">


                <div class="stat-card-top">

                    <span class="stat-icon">
                        ↗
                    </span>

                </div>


                <p>
                    Conversion Rate
                </p>


                <h2>

                    <?= number_format(
                        $aiStats['conversionRate'],
                        1
                    ); ?>%

                </h2>


                <small>
                    Recommendation → product interaction
                </small>


            </div>


        </section>


        <!-- ==================================================
             AI FEATURES
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        AI Feature Usage
                    </h3>


                    <p>
                        Usage of major SSISS AI features.
                    </p>

                </div>


            </div>


            <div class="stats-grid">


                <div class="stat-card">


                    <p>
                        Vibe Dress AI
                    </p>


                    <h2>

                        <?= number_format(
                            $aiStats['vibeRequests']
                        ); ?>

                    </h2>


                    <small>
                        Vibe-based styling requests
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Image Analysis
                    </p>


                    <h2>

                        <?= number_format(
                            $aiStats['imageAnalyses']
                        ); ?>

                    </h2>


                    <small>
                        User image analyses
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Today's Requests
                    </p>


                    <h2>

                        <?= number_format(
                            $aiStats['todayRecommendations']
                        ); ?>

                    </h2>


                    <small>
                        AI requests today
                    </small>


                </div>


                <div class="stat-card">


                    <p>
                        Successful Results
                    </p>


                    <h2>

                        <?= number_format(
                            $aiStats['successfulRecommendations']
                        ); ?>

                    </h2>


                    <small>
                        Positive recommendation outcomes
                    </small>


                </div>


            </div>


        </section>


        <!-- ==================================================
             POPULAR VIBES
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Popular Vibes
                    </h3>


                    <p>
                        What users are asking the AI stylist for.
                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Rank
                            </th>

                            <th>
                                Vibe
                            </th>

                            <th>
                                Requests
                            </th>

                            <th>
                                Share
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    $rank = 1;

                    foreach (
                        $vibes as $vibe
                    ):

                    ?>


                        <tr>


                            <td>

                                #<?= $rank++; ?>

                            </td>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $vibe['name']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $vibe['requests']
                                ); ?>

                            </td>


                            <td>

                                <?= $vibe['percentage']; ?>%

                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             CATEGORY PERFORMANCE
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Recommendation Performance
                    </h3>


                    <p>
                        AI performance by product category.
                    </p>

                </div>


            </div>


            <div class="table-wrapper">


                <table class="admin-table">


                    <thead>

                        <tr>

                            <th>
                                Category
                            </th>

                            <th>
                                Recommendations
                            </th>

                            <th>
                                Product Clicks
                            </th>

                            <th>
                                Conversion
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php foreach (
                        $categories as $category
                    ): ?>


                        <tr>


                            <td>

                                <strong>

                                    <?= htmlspecialchars(
                                        $category['category']
                                    ); ?>

                                </strong>

                            </td>


                            <td>

                                <?= number_format(
                                    $category['recommendations']
                                ); ?>

                            </td>


                            <td>

                                <?= number_format(
                                    $category['clicks']
                                ); ?>

                            </td>


                            <td>


                                <span
                                    class="status-badge status-active"
                                >

                                    <?= number_format(
                                        $category['conversion'],
                                        1
                                    ); ?>%

                                </span>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                    </tbody>


                </table>


            </div>


        </section>


        <!-- ==================================================
             FILTERS
        =================================================== -->

        <section class="dashboard-panel">


            <form
                method="GET"
                action="ai-analytics.php"
                class="filter-form"
            >


                <div class="form-group">


                    <label for="search">
                        Search
                    </label>


                    <input
                        type="search"
                        id="search"
                        name="search"
                        value="<?= htmlspecialchars(
                            $search
                        ); ?>"
                        placeholder="User or AI activity ID..."
                    >


                </div>


                <div class="form-group">


                    <label for="feature">
                        Feature
                    </label>


                    <select
                        id="feature"
                        name="feature"
                    >


                        <option value="">
                            All Features
                        </option>


                        <option value="Vibe Dress AI">
                            Vibe Dress AI
                        </option>


                        <option value="Image Style Analysis">
                            Image Style Analysis
                        </option>


                        <option value="Budget Stylist">
                            Budget Stylist
                        </option>


                    </select>


                </div>


                <div class="form-group">


                    <label for="vibe">
                        Vibe
                    </label>


                    <select
                        id="vibe"
                        name="vibe"
                    >


                        <option value="">
                            All Vibes
                        </option>


                        <option value="Casual">
                            Casual
                        </option>


                        <option value="Streetwear">
                            Streetwear
                        </option>


                        <option value="Minimal">
                            Minimal
                        </option>


                        <option value="Old Money">
                            Old Money
                        </option>


                        <option value="Party">
                            Party
                        </option>


                        <option value="Sporty">
                            Sporty
                        </option>


                    </select>


                </div>


                <div class="form-group">


                    <label for="result">
                        Result
                    </label>


                    <select
                        id="result"
                        name="result"
                    >


                        <option value="">
                            All Results
                        </option>


                        <option value="Successful">
                            Successful
                        </option>


                        <option value="Failed">
                            Failed
                        </option>


                    </select>


                </div>


                <div class="form-actions">


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Apply
                    </button>


                    <a
                        href="ai-analytics.php"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>


                </div>


            </form>


        </section>


        <!-- ==================================================
             AI ACTIVITY
        =================================================== -->

        <section class="dashboard-panel">


            <div class="panel-header">


                <div>

                    <h3>
                        Recent AI Activity
                    </h3>


                    <p>

                        <?= count(
                            $filteredActivity
                        ); ?>

                        activity record(s)

                    </p>


                </div>


            </div>


            <div class="table-wrapper">


                <?php if (
                    !empty(
                        $filteredActivity
                    )
                ): ?>


                    <table class="admin-table">


                        <thead>

                            <tr>

                                <th>
                                    Activity
                                </th>

                                <th>
                                    User
                                </th>

                                <th>
                                    Feature
                                </th>

                                <th>
                                    Vibe
                                </th>

                                <th>
                                    Budget
                                </th>

                                <th>
                                    Recommendations
                                </th>

                                <th>
                                    Result
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php foreach (
                            $filteredActivity
                            as $activity
                        ): ?>


                            <tr>


                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $activity['id']
                                        ); ?>

                                    </strong>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $activity['user']
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $activity['feature']
                                    ); ?>

                                </td>


                                <td>

                                    <span class="condition-badge">

                                        <?= htmlspecialchars(
                                            $activity['vibe']
                                        ); ?>

                                    </span>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $activity['budget']
                                    ); ?>

                                </td>


                                <td>

                                    <?= number_format(
                                        $activity['recommendations']
                                    ); ?>

                                </td>


                                <td>


                                    <?php if (
                                        $activity['result'] ===
                                        'Successful'
                                    ): ?>


                                        <span
                                            class="status-badge status-active"
                                        >
                                            Successful
                                        </span>


                                    <?php else: ?>


                                        <span
                                            class="status-badge status-danger"
                                        >
                                            Failed
                                        </span>


                                    <?php endif; ?>


                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $activity['date']
                                    ); ?>

                                </td>


                                <td>


                                    <button
                                        type="button"
                                        class="table-action"
                                        onclick="alert('AI activity details will be connected later.')"
                                    >
                                        View
                                    </button>


                                </td>


                            </tr>


                        <?php endforeach; ?>


                        </tbody>


                    </table>


                <?php else: ?>


                    <div class="empty-state">


                        <div class="empty-state-icon">
                            ✧
                        </div>


                        <h3>
                            No AI activity found
                        </h3>


                        <p>
                            Try changing your filters.
                        </p>


                        <a
                            href="ai-analytics.php"
                            class="btn btn-secondary"
                        >
                            Clear Filters
                        </a>


                    </div>


                <?php endif; ?>


            </div>


        </section>


        <!-- ==================================================
             FOOTER
        =================================================== -->

        <footer class="admin-footer">


            <span>
                SSISS Admin Panel
            </span>


            <span>
                Fashion • AI • Impact
            </span>


        </footer>


    </main>


</div>


</body>

</html>