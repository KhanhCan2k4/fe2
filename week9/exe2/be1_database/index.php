<?php
require_once './config/database.php';
spl_autoload_register(function ($className)
{
   require_once "./app/models/$className.php";
});


$productModel = new ProductModel();

$productList = $productModel->getAllProducts();
$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <?php
                foreach ($categoryList as $item) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="category.php?id=<?php echo $item['id']; ?>"><?php echo $item['category_name']; ?></a>
                </li>
                <?php
                }
                ?>
            </ul>
            <form class="d-flex" role="search" action="search.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <?php
                    foreach ($productList as $item) {
                    ?>
                    <div class="col-md-3">
                        <img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid product-photo" data-product-id="<?php echo $item['id']; ?>">
                        <a href="product.php?id=<?php echo $item['id']; ?>">
                            <h6><?php echo $item['product_name']; ?></h6>
                        </a>
                        <p>
                            <span class="badge text-bg-warning"><i class="bi bi-eye-fill"></i> <i class="product_view"><?php echo $item['product_view']; ?></i></span>
                            <form action="index.php" method="post">
                                <input type="hidden" name="likedId" value="<?php echo $item['id']; ?>">
                                <button class="btn badge text-bg-danger"><i class="bi bi-heart-fill"></i> <?php echo $item['pLike']; ?></button>
                            </form>
                        
                            <?php echo $item['product_price']; ?>
                        </p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 bg-light">
                <h2>Thông tin sản phẩm</h2>
                <div class="result card p-5">

                </div>

            </div>
        </div>
        
    </div>
    <script src="public/js/app.js"></script>
</body>
</html>