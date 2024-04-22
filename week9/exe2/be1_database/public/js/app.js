const productPhoto = document.querySelectorAll('.product-photo');
productPhoto.forEach(element => {
    element.addEventListener('click', function () {
        const id = this.dataset.productId;
        setView(element.parentElement.querySelector(".product_view"), id);
        getProductById(id);
    });
});

async function getProductById(id) {
    // 1
    const url = 'app/api/productdetail.php';
    const data = { productId: id };

    // 2
    const response = await fetch(url, {
        method  : "POST",
        body    : JSON.stringify(data)
    });

    // 3
    const result = await response.json();
    const divResult = document.querySelector('.result');
    divResult.innerHTML = `
        <h2>${result.product_name}</h2>
        <p>${result.product_price}</p>
        <img src="public/images/${result.product_photo}" alt="" class="img-fluid">
        <div>${result.product_description}</div>    
    `;
}

async function setView(container, id) {
    let url = 'app/api/setview.php';
    const data = { productId: id };

    // 2
    await fetch(url, {
        method  : "POST",
        body    : JSON.stringify(data)
    });

    url = 'app/api/productdetail.php';

    // 2
    const response = await fetch(url, {
        method  : "POST",
        body    : JSON.stringify(data)
    });

    // 3
    const result = await response.json();

    container.innerHTML = result.product_view;
}