const baseUrl = "http://127.0.0.1"; // Menyimpan URL dasar dalam variabel

const container = document.querySelector('.product-container');

// Fungsi untuk mengambil produk dari API
const fetchProducts = async () => {
    try {
        const response = await fetch(`${baseUrl}/app/main.php/products`); // Menggunakan variabel baseUrl
        const data = await response.json();

        if (data.status === 200) {
            const products = data.data;
            displayProducts(products);
        } else {
            alert('Failed to load products.');
        }
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

// Menampilkan produk ke dalam container
const displayProducts = (products) => {
    container.innerHTML = ''; // Bersihkan container sebelum render
    products.forEach((product) => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${product.image_url}" alt="${product.nama_product}">
            <h3>${product.nama_product}</h3>
            <p>Rp${product.harga_product.toLocaleString()}</p>
            <div class="card-buttons">
                <button onclick="orderNow('${product.nama_product}')">Order Now</button>
                <button onclick="deleteProduct(${product.id})" class="delete-btn">Delete</button>
                <button onclick="editProduct(${product.id})" class="edit-btn">Edit</button>
            </div>
        `;
        container.appendChild(card);
    });
};

// Fungsi untuk menghapus produk
const deleteProduct = async (id) => {
    const confirmDelete = confirm(`Are you sure you want to delete product with ID ${id}?`);
    if (confirmDelete) {
        try {
            const response = await fetch(`${baseUrl}/app/main.php/products/${id}`, {
                method: 'DELETE',
            });

            // Memeriksa status respons sebelum mengurai JSON
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json(); // Mengurai JSON hanya jika respons valid
            console.log('Delete response data:', data); // Debugging log

            if (data.status === 200) {
                alert(data.message);
                fetchProducts(); // Refresh the product list
            } else {
                alert('Failed to delete product.');
            }
        } catch (error) {
            console.error('Error deleting product:', error);
            alert('There was an error deleting the product.');
        }
    }
};


// Fungsi untuk mengedit produk
const editProduct = async (id) => {
    const newName = prompt('Edit product name:');
    const newPrice = prompt('Edit product price:');
    const newImage = prompt('Edit product image URL:');

    if (newName && newPrice && newImage) {
        const updatedProduct = { nama_product: newName, harga_product: newPrice, image_url: newImage };
        try {
            const response = await fetch(`${baseUrl}/app/main.php/products/${id}`, { // Menggunakan variabel baseUrl
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(updatedProduct),
            });
            const data = await response.json();
            if (data.status === 200) {
                alert(data.message);
                fetchProducts(); // Refresh the product list
            } else {
                alert('Failed to update product.');
            }
        } catch (error) {
            console.error('Error updating product:', error);
        }
    }
};

// Fungsi untuk tombol Order Now
const orderNow = (productName) => {
    alert(`You have selected: ${productName}. Proceed to checkout!`);
};

// Menambahkan produk baru
const addProductBtn = document.getElementById('add-product-btn');
addProductBtn.addEventListener('click', async () => {
    const newName = prompt('Enter product name:') || 'New Product';
    const newPrice = prompt('Enter product price:') || '0';
    const newImage = prompt('Enter product image URL:') || 'img/default.jpg';

    const newProduct = { nama_product: newName, harga_product: parseFloat(newPrice), image_url: newImage };

    try {
        const response = await fetch(`${baseUrl}/app/main.php/products`, { // Menggunakan variabel baseUrl
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(newProduct),
        });
        const data = await response.json();
        if (data.status === 201) {
            alert(data.message);
            fetchProducts(); // Refresh the product list
        } else {
            alert('Failed to add product.');
        }
    } catch (error) {
        console.error('Error adding product:', error);
    }
});

// Memanggil fetchProducts saat pertama kali memuat halaman
fetchProducts();
