// TODO: Implement this SSISS asset.
document.addEventListener("DOMContentLoaded", function () {
  /* =========================
       PRODUCT DATA
    ========================= */

  const products = [
    {
      id: 1,
      name: "Oversized Essential Tee",
      category: "clothing",
      price: 799,
      badge: "NEW",
      image:
        "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 2,
      name: "Classic Leather Sneakers",
      category: "shoes",
      price: 2999,
      badge: "TRENDING",
      image:
        "https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 3,
      name: "Minimal Steel Watch",
      category: "watches",
      price: 3499,
      badge: "POPULAR",
      image:
        "https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 4,
      name: "Retro Square Sunglasses",
      category: "spectacles",
      price: 1299,
      badge: "NEW",
      image:
        "https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 5,
      name: "Urban Cargo Pants",
      category: "clothing",
      price: 1899,
      badge: "STREET",
      image:
        "https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 6,
      name: "Premium Canvas Shoes",
      category: "shoes",
      price: 2299,
      badge: "BESTSELLER",
      image:
        "https://images.unsplash.com/photo-1543508282-6319a3e2621f?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 7,
      name: "Classic Silver Watch",
      category: "watches",
      price: 4199,
      badge: "LIMITED",
      image:
        "https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=800&q=80",
    },

    {
      id: 8,
      name: "Minimal Crossbody Bag",
      category: "accessories",
      price: 1599,
      badge: "NEW",
      image:
        "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=800&q=80",
    },
  ];

  let currentCategory = "all";

  const shopProducts = document.getElementById("shopProducts");

  const shopEmpty = document.getElementById("shopEmpty");

  const productCount = document.getElementById("productCount");

  const wishlistCount = document.querySelector(".wishlist-count");

  const cartCount = document.querySelector(".cart-count");

  /* =========================
       GET LOCAL STORAGE
    ========================= */

  function getWishlist() {
    return JSON.parse(localStorage.getItem("ssissWishlist")) || [];
  }

  function getCart() {
    return JSON.parse(localStorage.getItem("ssissCart")) || [];
  }

  /* =========================
       UPDATE COUNTS
    ========================= */

  function updateCounts() {
    wishlistCount.textContent = getWishlist().length;

    const cart = getCart();

    const totalCartItems = cart.reduce(function (total, item) {
      return total + item.quantity;
    }, 0);

    cartCount.textContent = totalCartItems;
  }

  /* =========================
       DISPLAY PRODUCTS
    ========================= */

  function displayProducts() {
    let filteredProducts = products.filter(function (product) {
      if (currentCategory === "all") {
        return true;
      }

      return product.category === currentCategory;
    });

    const sortValue = document.getElementById("sortProducts").value;

    if (sortValue === "low") {
      filteredProducts.sort((a, b) => a.price - b.price);
    }

    if (sortValue === "high") {
      filteredProducts.sort((a, b) => b.price - a.price);
    }

    if (sortValue === "name") {
      filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
    }

    productCount.textContent = filteredProducts.length;

    shopProducts.innerHTML = "";

    if (filteredProducts.length === 0) {
      shopProducts.style.display = "none";

      shopEmpty.style.display = "block";

      return;
    }

    shopProducts.style.display = "grid";

    shopEmpty.style.display = "none";

    const wishlist = getWishlist();

    filteredProducts.forEach(function (product) {
      const isWishlisted = wishlist.some(
        (item) => String(item.id) === String(product.id),
      );

      const productCard = document.createElement("article");

      productCard.classList.add("shop-product");

      productCard.innerHTML = `

                    <div class="product-image">

                        <img
                            src="${product.image}"
                            alt="${product.name}"
                        >


                        <span class="product-badge">

                            ${product.badge}

                        </span>


                        <button
                            class="product-heart ${
                              isWishlisted ? "active" : ""
                            }"

                            data-id="${product.id}"
                        >

                            <i class="${
                              isWishlisted ? "fa-solid" : "fa-regular"
                            } fa-heart"></i>

                        </button>

                    </div>


                    <div class="product-info">

                        <p class="product-category">

                            ${product.category.toUpperCase()}

                        </p>


                        <h3>

                            ${product.name}

                        </h3>


                        <div class="product-bottom">

                            <span class="product-price">

                                ₹${product.price}

                            </span>


                            <button
                                class="quick-add"

                                data-id="${product.id}"
                            >

                                ADD TO BAG

                            </button>

                        </div>

                    </div>

                `;

      shopProducts.appendChild(productCard);
    });
  }

  /* =========================
       CATEGORY FILTER
    ========================= */

  document.querySelectorAll(".category-btn").forEach(function (button) {
    button.addEventListener("click", function () {
      document.querySelectorAll(".category-btn").forEach(function (btn) {
        btn.classList.remove("active");
      });

      this.classList.add("active");

      currentCategory = this.dataset.category;

      displayProducts();
    });
  });

  /* =========================
       SORT
    ========================= */

  document
    .getElementById("sortProducts")
    .addEventListener("change", displayProducts);

  /* =========================
       WISHLIST
    ========================= */

  document.addEventListener("click", function (event) {
    const heartButton = event.target.closest(".product-heart");

    if (!heartButton) {
      return;
    }

    const productId = heartButton.dataset.id;

    const product = products.find(
      (item) => String(item.id) === String(productId),
    );

    let wishlist = getWishlist();

    const exists = wishlist.some(
      (item) => String(item.id) === String(productId),
    );

    if (exists) {
      wishlist = wishlist.filter(
        (item) => String(item.id) !== String(productId),
      );
    } else {
      wishlist.push(product);
    }

    localStorage.setItem(
      "ssissWishlist",

      JSON.stringify(wishlist),
    );

    updateCounts();

    displayProducts();
  });

  /* =========================
       CART
    ========================= */

  document.addEventListener("click", function (event) {
    const cartButton = event.target.closest(".quick-add");

    if (!cartButton) {
      return;
    }

    const productId = cartButton.dataset.id;

    const product = products.find(
      (item) => String(item.id) === String(productId),
    );

    let cart = getCart();

    const existingProduct = cart.find(
      (item) => String(item.id) === String(product.id),
    );

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

    updateCounts();

    showToast("Added to your bag 🛍️");
  });

  /* =========================
       TOAST
    ========================= */

  function showToast(message) {
    const toast = document.getElementById("toast");

    const toastMessage = document.getElementById("toastMessage");

    toastMessage.textContent = message;

    toast.classList.add("show");

    setTimeout(function () {
      toast.classList.remove("show");
    }, 2500);
  }

  /* =========================
       NEWSLETTER
    ========================= */

  document
    .querySelector(".newsletter-form")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      showToast("Welcome to SSISS! ✨");

      this.reset();
    });

  /* =========================
       INITIALIZE
    ========================= */

  displayProducts();

  updateCounts();
});
