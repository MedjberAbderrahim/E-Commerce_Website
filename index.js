const products = [
    { id: 1, name: "F-16 Fighting Falcon", price: 10.99, img: "Assets/F-16_Fighting_Falcon.jpg" },
    { id: 2, name: "F-22 Raptor", price: 15.99, img: "Assets/F-22_Raptor.jpg" },
    { id: 3, name: "Mirage 2000", price: 20.99, img: "Assets/Mirage_2000C.jpg" }
];

const cart = [];

function addToCart(productId) {
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

function removeFromCart(index) {
    cart.splice(index, 1);
    displayCart();
}

function closeCart() {
    document.getElementById('cart-backdrop').style.display = 'none';
    document.getElementById('cart-modal').style.display = 'none';
}

document.getElementById('cart-btn').addEventListener('click', displayCart);