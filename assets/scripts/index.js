function addToCart(productId) {
    if (confirm("Are you sure you want to add this product to your cart?"))
        window.location.href = `functions/add_to_cart.php?productID=${productId}`;
}

function removeFromCart(productId) {
    if (confirm("Are you sure you want to remove this product from your cart?"))
        window.location.href = `functions/delete_from_cart.php?productID=${productId}`;
}

function displayCart() {
    document.getElementById('cart-backdrop').style.display = 'flex';
    document.getElementById('cart-modal').style.display = 'flex';
}

function closeCart() {
    document.getElementById('cart-modal').style.display = 'none';
    document.getElementById('cart-backdrop').style.display = 'none';
}

function deleteProduct(productId, event) {
    event.stopPropagation();
    if (confirm("Are you sure you want to delete this product?"))
        window.location.href = "functions/delete_product.php?id=" + productId;
}

function showAddProductModal() {
    document.getElementById("add-product-modal").style.display = "block";
}

function closeAddProductModal() {
    document.getElementById("add-product-modal").style.display = "none";
}

// Close modal if user clicks outside the modal content
window.onclick = function(event) {
    let modal = document.getElementById("add-product-modal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

function toggleDropdown() {
    let dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function deleteAccount() {
    if (confirm("Are you sure you want to delete your account? All your data will be deleted and the deletion cannot be undone."))
        window.location.href = "delete_account.php";
}

// When I click anywhere other than the dropdown menu, it disappears away
window.onclick = function(event) {
    if (!event.target.matches('#username-btn')) {
        let dropdown = document.getElementById("dropdown-menu");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        }
    }
}