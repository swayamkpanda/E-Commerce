<?php

/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function e($value)
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}


/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/

function redirect($url)
{
    header("Location: " . $url);
    exit;
}


/*
|--------------------------------------------------------------------------
| Check Login
|--------------------------------------------------------------------------
*/

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}


/*
|--------------------------------------------------------------------------
| Get Current User ID
|--------------------------------------------------------------------------
*/

function currentUserId()
{
    return $_SESSION['user_id'] ?? null;
}


/*
|--------------------------------------------------------------------------
| Flash Message
|--------------------------------------------------------------------------
*/

function setFlashMessage(
    $type,
    $message
) {

    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];

}


/*
|--------------------------------------------------------------------------
| Get Flash Message
|--------------------------------------------------------------------------
*/

function getFlashMessage()
{

    if (
        !isset(
            $_SESSION['flash']
        )
    ) {
        return null;
    }

    $flash =
        $_SESSION['flash'];

    unset(
        $_SESSION['flash']
    );

    return $flash;
}


/*
|--------------------------------------------------------------------------
| Get User Coin Balance
|--------------------------------------------------------------------------
*/

function getUserCoinBalance(
    $userId
) {

    global $pdo;

    try {

        $stmt = $pdo->prepare("
            SELECT
                COALESCE(
                    SUM(amount),
                    0
                ) AS balance
            FROM coin_transactions
            WHERE user_id = :user_id
        ");

        $stmt->execute([
            ':user_id' => $userId
        ]);

        $result =
            $stmt->fetch();

        return (int) (
            $result['balance'] ?? 0
        );

    } catch (PDOException $e) {

        return 0;
    }
}


/*
|--------------------------------------------------------------------------
| Add SSISS Coins
|--------------------------------------------------------------------------
*/

function addCoins(
    $userId,
    $amount,
    $description = ''
) {

    global $pdo;

    if (
        $amount <= 0 ||
        $userId <= 0
    ) {
        return false;
    }

    try {

        $stmt = $pdo->prepare("
            INSERT INTO coin_transactions
            (
                user_id,
                amount,
                transaction_type,
                description,
                created_at
            )
            VALUES
            (
                :user_id,
                :amount,
                'donation_reward',
                :description,
                NOW()
            )
        ");

        return $stmt->execute([
            ':user_id' => $userId,
            ':amount' => $amount,
            ':description' => $description
        ]);

    } catch (PDOException $e) {

        return false;
    }
}


/*
|--------------------------------------------------------------------------
| Spend SSISS Coins
|--------------------------------------------------------------------------
*/

function spendCoins(
    $userId,
    $amount,
    $description = ''
) {

    global $pdo;

    if (
        $amount <= 0 ||
        $userId <= 0
    ) {
        return false;
    }

    $balance =
        getUserCoinBalance($userId);

    if ($balance < $amount) {
        return false;
    }

    try {

        $stmt = $pdo->prepare("
            INSERT INTO coin_transactions
            (
                user_id,
                amount,
                transaction_type,
                description,
                created_at
            )
            VALUES
            (
                :user_id,
                :amount,
                'purchase',
                :description,
                NOW()
            )
        ");

        return $stmt->execute([
            ':user_id' => $userId,
            ':amount' => -$amount,
            ':description' => $description
        ]);

    } catch (PDOException $e) {

        return false;
    }
}


/*
|--------------------------------------------------------------------------
| Format Money
|--------------------------------------------------------------------------
*/

function formatMoney(
    $amount
) {

    return '₹' .
        number_format(
            (float)$amount,
            2
        );
}


/*
|--------------------------------------------------------------------------
| Generate Order Number
|--------------------------------------------------------------------------
*/

function generateOrderNumber()
{

    return 'SSISS-' .
        date('Ymd') .
        '-' .
        strtoupper(
            substr(
                uniqid(),
                -6
            )
        );
}


/*
|--------------------------------------------------------------------------
| Generate Random Token
|--------------------------------------------------------------------------
*/

function generateToken(
    $length = 32
) {

    return bin2hex(
        random_bytes(
            $length
        )
    );
}


/*
|--------------------------------------------------------------------------
| Sanitize Search
|--------------------------------------------------------------------------
*/

function cleanSearch(
    $search
) {

    return trim(
        preg_replace(
            '/[^a-zA-Z0-9\s\-]/',
            '',
            $search
        )
    );
}


/*
|--------------------------------------------------------------------------
| Calculate Coin Reward
|--------------------------------------------------------------------------
*/

function calculateDonationReward(
    $quantity,
    $condition
) {

    $baseReward = 20;

    $conditionBonus = [
        'Excellent' => 30,
        'Good' => 20,
        'Fair' => 10
    ];

    $bonus =
        $conditionBonus[
            $condition
        ] ?? 0;

    return (
        $baseReward +
        $bonus
    ) * max(
        1,
        (int)$quantity
    );
}


/*
|--------------------------------------------------------------------------
| Format Status
|--------------------------------------------------------------------------
*/

function formatStatus(
    $status
) {

    return ucfirst(
        str_replace(
            '_',
            ' ',
            $status
        )
    );
}

?>