<?php

/*
|--------------------------------------------------------------------------
| SSISS - Coin Functions
|--------------------------------------------------------------------------
|
| Handles:
| - Getting user's coin balance
| - Adding coins
| - Deducting coins
| - Checking coin balance
| - Getting transaction history
| - Calculating donation rewards
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Get User Coin Balance
|--------------------------------------------------------------------------
*/

function getCoinBalance($userId)
{
    global $pdo;

    if (!$userId) {
        return 0;
    }

    try {

        $sql = "
            SELECT COALESCE(SUM(amount), 0) AS balance
            FROM coin_transactions
            WHERE user_id = ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) ($result['balance'] ?? 0);

    } catch (PDOException $e) {

        return 0;
    }
}


/*
|--------------------------------------------------------------------------
| Add Coins
|--------------------------------------------------------------------------
|
| Used when:
| - Donation is approved
| - User receives a reward
| - Admin gives bonus coins
|
|--------------------------------------------------------------------------
*/

function addCoins(
    $userId,
    $amount,
    $description = '',
    $referenceId = null
) {
    global $pdo;

    if (
        !$userId ||
        $amount <= 0
    ) {
        return false;
    }

    try {

        $sql = "
            INSERT INTO coin_transactions
            (
                user_id,
                amount,
                transaction_type,
                description,
                reference_id,
                created_at
            )
            VALUES
            (
                ?,
                ?,
                'credit',
                ?,
                ?,
                NOW()
            )
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $userId,
            $amount,
            $description,
            $referenceId
        ]);

    } catch (PDOException $e) {

        return false;
    }
}


/*
|--------------------------------------------------------------------------
| Deduct Coins
|--------------------------------------------------------------------------
|
| Used when:
| - User uses coins for a discount
| - Coins are spent on an eligible purchase
|
|--------------------------------------------------------------------------
*/

function deductCoins(
    $userId,
    $amount,
    $description = '',
    $referenceId = null
) {
    global $pdo;

    if (
        !$userId ||
        $amount <= 0
    ) {
        return false;
    }


    /*
    | Check current balance
    */

    $balance = getCoinBalance($userId);

    if ($balance < $amount) {
        return false;
    }


    try {

        $sql = "
            INSERT INTO coin_transactions
            (
                user_id,
                amount,
                transaction_type,
                description,
                reference_id,
                created_at
            )
            VALUES
            (
                ?,
                ?,
                'debit',
                ?,
                ?,
                NOW()
            )
        ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $userId,
            -$amount,
            $description,
            $referenceId
        ]);

    } catch (PDOException $e) {

        return false;
    }
}


/*
|--------------------------------------------------------------------------
| Check If User Has Enough Coins
|--------------------------------------------------------------------------
*/

function hasEnoughCoins(
    $userId,
    $amount
) {
    return getCoinBalance($userId) >= $amount;
}


/*
|--------------------------------------------------------------------------
| Calculate Donation Coin Reward
|--------------------------------------------------------------------------
|
| Example:
|
| Excellent condition:
| 20 base + 30 bonus = 50 coins/item
|
| Good condition:
| 20 base + 20 bonus = 40 coins/item
|
| Fair condition:
| 20 base + 10 bonus = 30 coins/item
|
|--------------------------------------------------------------------------
*/

function calculateDonationCoins(
    $quantity,
    $condition
) {

    $baseCoins = 20;

    $condition = strtolower(
        trim($condition)
    );

    $conditionBonus = [

        'excellent' => 30,

        'good' => 20,

        'fair' => 10

    ];

    $bonus =
        $conditionBonus[$condition]
        ?? 0;

    $quantity = max(
        1,
        (int) $quantity
    );

    return (
        $baseCoins + $bonus
    ) * $quantity;
}


/*
|--------------------------------------------------------------------------
| Get Coin Transaction History
|--------------------------------------------------------------------------
*/

function getCoinTransactions($userId)
{
    global $pdo;

    if (!$userId) {
        return [];
    }

    try {

        $sql = "
            SELECT
                id,
                amount,
                transaction_type,
                description,
                reference_id,
                created_at
            FROM coin_transactions
            WHERE user_id = ?
            ORDER BY created_at DESC
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $userId
        ]);

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );

    } catch (PDOException $e) {

        return [];
    }
}


/*
|--------------------------------------------------------------------------
| Get Transaction Type Label
|--------------------------------------------------------------------------
*/

function getCoinTransactionLabel($type)
{
    $labels = [

        'credit' =>
            'Coins Earned',

        'debit' =>
            'Coins Used',

        'donation_reward' =>
            'Donation Reward',

        'purchase' =>
            'Purchase Discount',

        'bonus' =>
            'Bonus Coins'

    ];

    return $labels[$type]
        ?? ucfirst($type);
}


/*
|--------------------------------------------------------------------------
| Convert Coins Into Discount
|--------------------------------------------------------------------------
|
| Example rule:
| 100 coins = ₹10 discount
|
| We can change this later.
|
|--------------------------------------------------------------------------
*/

function coinsToDiscount($coins)
{
    $conversionRate = 10;

    return floor(
        $coins / 10
    ) * $conversionRate;
}


/*
|--------------------------------------------------------------------------
| Get Maximum Coins Usable For Order
|--------------------------------------------------------------------------
|
| Prevents users from using more coins
| than they actually have.
|
|--------------------------------------------------------------------------
*/

function getMaximumUsableCoins(
    $userId,
    $orderAmount
) {

    $balance =
        getCoinBalance($userId);

    $orderAmount =
        max(
            0,
            (float) $orderAmount
        );

    /*
    | For now:
    | 1 coin = ₹0.10 discount
    */

    $maximumCoins =
        floor(
            $orderAmount * 10
        );

    return min(
        $balance,
        $maximumCoins
    );
}

?>