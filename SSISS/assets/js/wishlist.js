document.addEventListener("DOMContentLoaded", function () {
  const wishlistProducts = document.getElementById("wishlistProducts");
  const emptyWishlist = document.getElementById("emptyWishlist");

  const wishlistItemCount = document.getElementById("wishlistItemCount");

  const wishlistCount = document.querySelector(".wishlist-count");

  const clearWishlist = document.getElementById("clearWishlist");

  const toast = document.getElementById("toast");
  const toastMessage = document.getElementById("toastMessage");

  /* =========================
       GET WISHLIST
    ========================= */

  function getWishlist() {
    return JSON.parse(localStorage.getItem("ssissWishlist")) || [];
  }

  /* =========================
       SAVE WISHLIST
    ========================= */

  function saveWishlist(wishlist) {
    localStorage.setItem("ssissWishlist", JSON.stringify(wishlist));
  }

  /* =========================
       UPDATE COUNTS
    ========================= */

  function updateCounts() {
    const wishlist = getWishlist();

    wishlistItemCount.textContent = wishlist.length;

    wishlistCount.textContent = wishlist.length;
  }

  /* =========================
       DISPLAY WISHLIST
    ========================= */

  function displayWishlist() {
    const wishlist = getWishlist();

    wishlistProducts.innerHTML = "";

    if (wishlist.length === 0) {
      wishlistProducts.style.display = "none";

      emptyWishlist.style.display = "block";

      updateCounts();

      return;
    }

    wishlistProducts.style.display = "grid";

    emptyWishlist.style.display = "none";

    wishlist.forEach(function (product) {
      const productCard = document.createElement("article");

      productCard.classList.add("wishlist-card");

      productCard.innerHTML = `

                <div class="wishlist-image">

                    <img
                        src="${product.image}"
                        alt="${product.name}"
                    >


                    <button
                        class="remove-wishlist"
                        data-id="${product.id}"
                        title="Remove from wishlist"
                    >

                        <i class="fa-solid fa-heart"></i>

                    </button>

                </div>


                <div class="wishlist-info">

                    <p class="wishlist-category">

                        ${product.category}

                    </p>


                    <h3>

                        ${product.name}

                    </h3>


                    <div class="wishlist-bottom">

                        <span class="wishlist-price">

                            ₹${product.price}

                        </span>


                        <button
                            class="add-cart-btn"
                            data-id="${product.id}"
                        >

                            ADD TO BAG

                        </button>

                    </div>

                </div>

            `;

      wishlistProducts.appendChild(productCard);
    });

    updateCounts();
  }

  /* =========================
       REMOVE PRODUCT
    ========================= */

  document.addEventListener("click", function (event) {
    const removeButton = event.target.closest(".remove-wishlist");

    if (!removeButton) {
      return;
    }

    const productId = removeButton.dataset.id;

    let wishlist = getWishlist();

    wishlist = wishlist.filter(function (product) {
      return String(product.id) !== String(productId);
    });

    saveWishlist(wishlist);

    displayWishlist();

    showToast("Removed from wishlist");
  });

  /* =========================
       CLEAR WISHLIST
    ========================= */

  if (clearWishlist) {
    clearWishlist.addEventListener("click", function () {
      const wishlist = getWishlist();

      if (wishlist.length === 0) {
        showToast("Wishlist is already empty");

        return;
      }

      const confirmed = confirm("Remove all items from your wishlist?");

      if (!confirmed) {
        return;
      }

      localStorage.removeItem("ssissWishlist");

      displayWishlist();

      showToast("Wishlist cleared");
    });
  }

  /* =========================
       ADD TO CART
    ========================= */

  document.addEventListener("click", function (event) {
    const cartButton = event.target.closest(".add-cart-btn");

    if (!cartButton) {
      return;
    }

    const productId = cartButton.dataset.id;

    const wishlist = getWishlist();

    const product = wishlist.find(function (item) {
      return String(item.id) === String(productId);
    });

    if (!product) {
      return;
    }

    let cart = JSON.parse(localStorage.getItem("ssissCart")) || [];

    const existingProduct = cart.find(function (item) {
      return String(item.id) === String(product.id);
    });

    if (existingProduct) {
      existingProduct.quantity += 1;
    } else {
      cart.push({
        ...product,

        quantity: 1,
      });
    }

    localStorage.setItem(
      "ssissCart",

      JSON.stringify(cart),
    );

    showToast("Added to your bag");
  });

  /* =========================
       TOAST
    ========================= */

  function showToast(message) {
    toastMessage.textContent = message;

    toast.classList.add("show");

    setTimeout(function () {
      toast.classList.remove("show");
    }, 2500);
  }

  /* =========================
       INITIALIZE
    ========================= */

  displayWishlist();
});
