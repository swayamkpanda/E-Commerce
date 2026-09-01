<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YFF | Shopping Cart</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f3ee;
            color: #151515;
        }

        /* ================= HEADER ================= */

        header {
            height: 78px;
            padding: 0 6%;
            background: #ffffff;
            border-bottom: 1px solid #ddd9d0;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 30px;
            font-weight: 900;
            letter-spacing: 5px;
        }

        .logo span {
            display: block;
            font-size: 8px;
            letter-spacing: 2px;
            font-weight: 500;
            color: #777;
            margin-top: 2px;
        }

        .continue {
            color: #111;
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .continue:hover {
            opacity: .5;
        }

        /* ================= MAIN ================= */

        main {
            width: 90%;
            max-width: 1350px;
            margin: 55px auto 100px;
        }

        .heading small {
            font-size: 10px;
            letter-spacing: 3px;
            color: #777;
        }

        .heading h1 {
            font-size: clamp(45px, 6vw, 78px);
            margin-top: 8px;
            letter-spacing: -4px;
        }

        .demo-badge {
            display: inline-block;
            margin-top: 15px;
            padding: 7px 12px;
            background: #d8ebbd;
            color: #24351b;
            font-size: 9px;
            letter-spacing: 2px;
            font-weight: bold;
        }

        /* ================= LAYOUT ================= */

        .cart-layout {
            margin-top: 45px;

            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 55px;
            align-items: start;
        }

        /* ================= ITEMS ================= */

        .cart-items {
            border-top: 1px solid #ccc7bd;
        }

        .cart-item {
            display: grid;

            grid-template-columns:
                150px
                1fr
                auto;

            gap: 25px;

            padding: 25px 0;

            border-bottom: 1px solid #d5d0c7;

            animation: appear .5s ease;
        }

        @keyframes appear {

            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ================= IMAGE ================= */

        .product-image {
            width: 150px;
            height: 185px;
            background: #e2e0d9;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ================= PRODUCT INFO ================= */

        .product-info {
            padding: 5px 0;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .category {
            font-size: 9px;
            letter-spacing: 2px;
            color: #888;
            text-transform: uppercase;
        }

        .product-name {
            margin-top: 9px;
            font-size: 21px;
            font-weight: 600;
        }

        .product-price {
            margin-top: 7px;
            color: #555;
            font-size: 14px;
        }

        /* ================= QUANTITY ================= */

        .quantity {
            display: flex;
            width: fit-content;
            margin-top: 20px;

            border: 1px solid #c8c4bb;
        }

        .quantity button {
            width: 38px;
            height: 36px;

            border: none;
            background: transparent;

            cursor: pointer;
            font-size: 17px;

            transition: .2s;
        }

        .quantity button:hover {
            background: #151515;
            color: white;
        }

        .quantity span {
            width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 13px;
            font-weight: bold;
        }

        /* ================= RIGHT ================= */

        .item-right {
            display: flex;
            flex-direction: column;

            align-items: flex-end;
            justify-content: space-between;
        }

        .item-total {
            font-size: 17px;
            font-weight: bold;
        }

        .remove {
            border: none;
            background: none;

            color: #777;

            cursor: pointer;

            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .remove:hover {
            color: #b32626;
        }

        /* ================= SUMMARY ================= */

        .summary {
            background: #171717;
            color: white;

            padding: 35px;

            position: sticky;
            top: 100px;
        }

        .summary-label {
            font-size: 9px;
            letter-spacing: 3px;
            color: #999;
        }

        .summary h2 {
            margin-top: 12px;
            font-size: 28px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;

            padding: 15px 0;

            border-bottom: 1px solid #3b3b3b;

            font-size: 13px;
        }

        .summary-row span:first-child {
            color: #999;
        }

        .total {
            display: flex;
            justify-content: space-between;

            margin-top: 25px;

            font-size: 21px;
            font-weight: bold;
        }

        .checkout {
            width: 100%;

            margin-top: 30px;
            padding: 17px;

            border: none;

            background: #d9edbd;
            color: #17200f;

            font-weight: bold;
            font-size: 11px;

            letter-spacing: 2px;

            cursor: pointer;

            transition: .3s;
        }

        .checkout:hover {
            transform: translateY(-3px);
            background: white;
        }

        .clear {
            width: 100%;

            margin-top: 12px;
            padding: 13px;

            border: 1px solid #555;

            background: transparent;
            color: #aaa;

            cursor: pointer;

            font-size: 9px;
            letter-spacing: 2px;
        }

        .clear:hover {
            color: white;
            border-color: white;
        }

        /* ================= EMPTY ================= */

        .empty {
            display: none;

            text-align: center;

            padding: 100px 20px;
        }

        .empty-icon {
            font-size: 55px;
            margin-bottom: 20px;

            animation: floating 2s infinite ease-in-out;
        }

        @keyframes floating {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .empty h2 {
            font-size: 32px;
        }

        .empty p {
            color: #777;
            margin: 10px 0 25px;
        }

        .shop {
            display: inline-block;

            padding: 14px 28px;

            background: #171717;
            color: white;

            text-decoration: none;

            font-size: 10px;
            letter-spacing: 2px;
        }

        /* ================= TOAST ================= */

        .toast {
            position: fixed;

            right: 25px;
            bottom: 25px;

            padding: 15px 22px;

            background: #171717;
            color: white;

            font-size: 12px;

            opacity: 0;
            transform: translateY(30px);

            transition: .3s;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* ================= MOBILE ================= */

        @media(max-width: 900px) {

            .cart-layout {
                grid-template-columns: 1fr;
            }

            .summary {
                position: static;
            }

        }

        @media(max-width: 600px) {

            main {
                width: 92%;
                margin-top: 35px;
            }

            .cart-item {
                grid-template-columns: 90px 1fr;
                gap: 15px;
            }

            .product-image {
                width: 90px;
                height: 125px;
            }

            .item-right {
                grid-column: 2;
                flex-direction: row;
                align-items: center;
            }

            .product-name {
                font-size: 16px;
            }

        }

    </style>

</head>


<body>


<!-- ================= HEADER ================= -->

<header>

    <div class="logo">

        YFF

        <span>
            YOUR FASHION FUTURE
        </span>

    </div>


    <a
        href="../index.php"
        class="continue"
    >
        ← CONTINUE SHOPPING
    </a>

</header>


<!-- ================= MAIN ================= -->

<main>


    <div class="heading">

        <small>
            YOUR SELECTION
        </small>

        <h1>
            YOUR CART
        </h1>

        <div class="demo-badge">
            DEMO MODE • PRESENTATION
        </div>

    </div>


    <!-- ================= CART ================= -->

    <div
        id="cartLayout"
        class="cart-layout"
    >


        <div
            id="cartItems"
            class="cart-items"
        ></div>


        <!-- ================= SUMMARY ================= -->

        <aside class="summary">

            <div class="summary-label">
                ORDER SUMMARY
            </div>

            <h2>
                Your Order
            </h2>


            <div class="summary-row">

                <span>
                    Items
                </span>

                <span id="itemCount">
                    0
                </span>

            </div>


            <div class="summary-row">

                <span>
                    Quantity
                </span>

                <span id="totalQuantity">
                    0
                </span>

            </div>


            <div class="summary-row">

                <span>
                    Delivery
                </span>

                <span>
                    FREE
                </span>

            </div>


            <div class="total">

                <span>
                    TOTAL
                </span>

                <span>
                    ₹<span id="subtotal">0</span>
                </span>

            </div>


            <button
                class="checkout"
                onclick="checkout()"
            >
                PROCEED TO CHECKOUT
            </button>


            <button
                class="clear"
                onclick="clearCart()"
            >
                CLEAR CART
            </button>

        </aside>

    </div>


    <!-- ================= EMPTY CART ================= -->

    <div
        id="emptyCart"
        class="empty"
    >

        <div class="empty-icon">
            🛒
        </div>

        <h2>
            Your cart is empty
        </h2>

        <p>
            Your next favourite look is waiting.
        </p>

        <a
            href="../index.php"
            class="shop"
        >
            START SHOPPING
        </a>

    </div>


</main>


<div
    id="toast"
    class="toast"
></div>


<script>

/*
|--------------------------------------------------------------------------
| YFF CART — DEMO MODE
|--------------------------------------------------------------------------
| No database
| No API
| No login
|
| This is only for presentation/showcase.
|--------------------------------------------------------------------------
*/


// ==========================================================
// DEMO PRODUCTS
// ==========================================================

let cart = [

    {
        id: 1,

        name: "Oversized Utility Jacket",

        category: "Streetwear",

        price: 2499,

        image: "https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?auto=format&fit=crop&w=600&q=80",

        quantity: 1
    },


    {
        id: 2,

        name: "Relaxed Pleated Trousers",

        category: "Minimal",

        price: 1899,

        image: "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&w=600&q=80",

        quantity: 1
    },


    {
        id: 3,

        name: "Vintage Graphic Tee",

        category: "Y2K",

        price: 1299,

        image: "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=600&q=80",

        quantity: 2
    }

];


// ==========================================================
// RENDER CART
// ==========================================================

function renderCart() {

    const container =
        document.getElementById("cartItems");


    container.innerHTML = "";


    if (cart.length === 0) {

        document.getElementById(
            "cartLayout"
        ).style.display = "none";


        document.getElementById(
            "emptyCart"
        ).style.display = "block";


        updateSummary();

        return;
    }


    document.getElementById(
        "cartLayout"
    ).style.display = "grid";


    document.getElementById(
        "emptyCart"
    ).style.display = "none";


    cart.forEach(
        (item, index) => {

            const itemTotal =
                item.price *
                item.quantity;


            const element =
                document.createElement("div");


            element.className =
                "cart-item";


            element.style.animationDelay =
                `${index * 0.1}s`;


            element.innerHTML = `

                <div class="product-image">

                    <img
                        src="${item.image}"
                        alt="${item.name}"
                    >

                </div>


                <div class="product-info">

                    <div>

                        <div class="category">
                            ${item.category}
                        </div>


                        <div class="product-name">
                            ${item.name}
                        </div>


                        <div class="product-price">
                            ₹${formatMoney(item.price)}
                        </div>

                    </div>


                    <div class="quantity">

                        <button
                            onclick="changeQuantity(
                                ${item.id},
                                -1
                            )"
                        >
                            −
                        </button>


                        <span>
                            ${item.quantity}
                        </span>


                        <button
                            onclick="changeQuantity(
                                ${item.id},
                                1
                            )"
                        >
                            +
                        </button>

                    </div>

                </div>


                <div class="item-right">

                    <div class="item-total">
                        ₹${formatMoney(itemTotal)}
                    </div>


                    <button
                        class="remove"
                        onclick="removeItem(${item.id})"
                    >
                        Remove
                    </button>

                </div>

            `;


            container.appendChild(element);

        }
    );


    updateSummary();

}


// ==========================================================
// CHANGE QUANTITY
// ==========================================================

function changeQuantity(
    id,
    change
) {

    const item =
        cart.find(
            product =>
                product.id === id
        );


    if (!item) {
        return;
    }


    item.quantity += change;


    if (item.quantity <= 0) {

        removeItem(id);

        return;
    }


    if (item.quantity > 10) {

        item.quantity = 10;

        showToast(
            "Maximum quantity is 10."
        );

    }


    renderCart();

}


// ==========================================================
// REMOVE ITEM
// ==========================================================

function removeItem(id) {

    const item =
        cart.find(
            product =>
                product.id === id
        );


    cart =
        cart.filter(
            product =>
                product.id !== id
        );


    showToast(
        `${item ? item.name : "Item"} removed from cart.`
    );


    renderCart();

}


// ==========================================================
// CLEAR CART
// ==========================================================

function clearCart() {

    if (cart.length === 0) {
        return;
    }


    if (
        !confirm(
            "Clear all items from your cart?"
        )
    ) {

        return;
    }


    cart = [];


    showToast(
        "Cart cleared."
    );


    renderCart();

}


// ==========================================================
// SUMMARY
// ==========================================================

function updateSummary() {

    let totalQuantity = 0;

    let total = 0;


    cart.forEach(
        item => {

            totalQuantity +=
                item.quantity;


            total +=
                item.price *
                item.quantity;

        }
    );


    document.getElementById(
        "itemCount"
    ).textContent =
        cart.length;


    document.getElementById(
        "totalQuantity"
    ).textContent =
        totalQuantity;


    document.getElementById(
        "subtotal"
    ).textContent =
        formatMoney(total);

}


// ==========================================================
// CHECKOUT
// ==========================================================

function checkout() {

    if (cart.length === 0) {

        showToast(
            "Your cart is empty."
        );

        return;
    }


    showToast(
        "Checkout flow ready for integration."
    );

}


// ==========================================================
// MONEY
// ==========================================================

function formatMoney(
    amount
) {

    return Number(amount)
        .toLocaleString(
            "en-IN"
        );

}


// ==========================================================
// TOAST
// ==========================================================

function showToast(
    message
) {

    const toast =
        document.getElementById(
            "toast"
        );


    toast.textContent =
        message;


    toast.classList.add(
        "show"
    );


    setTimeout(
        () => {

            toast.classList.remove(
                "show"
            );

        },
        2200
    );

}


// ==========================================================
// START
// ==========================================================

renderCart();

</script>


</body>

</html>