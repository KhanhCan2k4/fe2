<?php
class ProductModel extends Model
{
    public function getAllProducts()
    {
        // $sql = parent::$connection->prepare('SELECT * FROM products');
        //SELECT *, (SELECT COUNT(*) FROM product_user WHERE product_user.product_id = products.id) AS pLike FROM `products`;
        $sql = parent::$connection->prepare('SELECT *, COUNT(product_user.user_id) AS pLike FROM `products` LEFT JOIN product_user ON products.id = product_user.product_id GROUP BY products.id;');

        return parent::select($sql);
    }
    public function getProductById($id)
    {
        $sql = parent::$connection->prepare('SELECT * FROM products WHERE id=?');
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }

    public function setView($id)
    {
        $sql = parent::$connection->prepare('UPDATE products SET product_view = product_view + 1 WHERE id = ?');
        $sql->bind_param('i', $id);
        $sql->execute();
    }
    
    public function getProductByIds($arrId)
    {
        
        // for ($i=0; $i < count($arrId) - 1; $i++) { 
        //     $chamHoi .= '?,';
        // }
        $chamHoi = str_repeat('?,', count($arrId) - 1);
        $chamHoi .= '?';
        
        $i = str_repeat('i', count($arrId));

        // $chamHoi = substr($chamHoi, 0, -1);

        // for ($i=0; $i < count($arrId); $i++) {
        //     if($ == n)
        //     $chamHoi .= '?';
        //     else
        //     $chamHoi .= '?,';
        // }

        // $arrChamhoi = [];
        
        // for ($i=0; $i < count($arrId); $i++) {
        //     array_push($arrChamhoi, '?');
        // }
        // implode(',', $arrChamhoi);

        $sql = parent::$connection->prepare("SELECT * FROM products WHERE id IN ( $chamHoi ) ORDER BY FIELD(id, $chamHoi ) DESC");
        $sql->bind_param($i . $i, ...$arrId, ...$arrId);

        return parent::select($sql);
    }

    public function getProductByCategory($id)
    {
        $sql = parent::$connection->prepare('SELECT products.*
                                            FROM `products_categories`
                                            INNER JOIN products
                                            ON products_categories.product_id = products.id
                                            WHERE `category_id` = ?');
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
    public function getProductsByKeyword($q)
    {
        $sql = parent::$connection->prepare('SELECT * FROM products WHERE product_name LIKE ?');
        $q = "%{$q}%";
        $sql->bind_param('s', $q);
        return parent::select($sql);
    }

    // INSERT
    public function addProduct($product_name, $product_description, $product_price, $product_photo)
    {
        $sql = parent::$connection->prepare('INSERT INTO `products`(`product_name`, `product_description`, `product_price`, `product_photo`) VALUES (?, ?, ?, ?)');
        $sql->bind_param('ssis', $product_name, $product_description, $product_price, $product_photo);
        return $sql->execute();
    }

    // UPDATE
    public function editProduct($product_name, $product_description, $product_price, $product_photo, $id)
    {
        $sql = parent::$connection->prepare('UPDATE `products` SET `product_name`=?,`product_description`=?,`product_price`=?,`product_photo`=? WHERE `id`=?');
        $sql->bind_param('ssisi', $product_name, $product_description, $product_price, $product_photo, $id);
        return $sql->execute();
    }
    // DELETE
    public function deleteProduct($id)
    {
        $sql = parent::$connection->prepare('DELETE FROM `products` WHERE `id`=?');
        $sql->bind_param('i', $id);
        return $sql->execute();
    }

    // like
    public function likeProductGuest($id)
    {
        $sql = parent::$connection->prepare('UPDATE `products` SET `product_like` = `product_like` + 1 WHERE `id`=?');
        $sql->bind_param('i', $id);
        return $sql->execute();
    }
    // like
    public function likeProductUser($productId, $userId)
    {
        $sql = parent::$connection->prepare('INSERT INTO `product_user`(`product_id`, `user_id`) VALUES (?, ?)');
        $sql->bind_param('ii', $productId, $userId);
        return $sql->execute();
    }
}
