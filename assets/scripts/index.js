const products = [
    { id: 1, name: "F-16 Fighting Falcon", price: 10.99, img: "../images/F-16_Fighting_Falcon.jpg" },
    { id: 2, name: "F-22 Raptor", price: 15.99, img: "../images/F-22_Raptor.jpg" },
    { id: 3, name: "Mirage 2000", price: 20.99, img: "../images/Mirage_2000C.jpg" }
];

const cart = [];

function addToCart(productId, event) {
    event.stopPropagation();
    const product = products.find(p => p.id === productId);
    cart.push(product);
    alert(`${product.name} added to cart!`);
}

function displayCart() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    cart.forEach((item, index) => {
        const cartItem = document.createElement('li');
        cartItem.innerHTML = `
            ${item.name} - $${item.price.toFixed(2)}
            <button onclick="removeFromCart(${index})">Remove</button>
        `;
        cartItems.appendChild(cartItem);
    });
    document.getElementById('cart-backdrop').style.display = 'block';
    document.getElementById('cart-modal').style.display = 'block';
}

function deleteProduct(productId, event) {
    event.stopPropagation();
    if (confirm("Are you sure you want to delete this product?")) {
        window.location.href = "functions/delete_product.php?id=" + productId;
    }
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
    if (confirm("Are you sure you want to delete your account? All your data will be deleted and the deletion cannot be undone.")) {
        window.location.href = "delete_account.php";
    }
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
function removeFromCart(index) {
    cart.splice(index, 1);
    displayCart();
}

function closeCart() {
    document.getElementById('cart-backdrop').style.display = 'none';
    document.getElementById('cart-modal').style.display = 'none';
}

document.getElementById('cart-btn').addEventListener('click', displayCart);