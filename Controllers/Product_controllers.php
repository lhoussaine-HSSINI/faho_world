<?php

class Product_controllers
{
    public function getAll_products()
    {
        $rv = Product::getAll_products();
        return $rv;
    }

    public function delete_products()
    {
        if (isset($_POST['Product_id'])) {
            $Product_id = $_POST['Product_id'];
            $resul_delete = Product::Delete($Product_id);
            return $resul_delete;
        }
    }

    public function update_products()
    {
        if (isset($_POST['Product_id']) && isset($_POST['Product_name']) && isset($_POST['Product_price']) && isset($_POST['Product_quantity']) &&
            isset($_POST['Product_entership']) && isset($_FILES['file_update']['name'])) {
            $image_name = $_FILES['file_update']['name'];
            $valid_extensions = array("jpg", "jpeg", "png");
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            if (in_array($extension, $valid_extensions)) {
                $upload_path = 'http://localhost/faho_world/faho_world/src/assets/images/product/' . $image_name;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
                    $R_V = array(
                        'Product_id' => $_POST['Product_id'],
                        'Product_Name' => $_POST['Product_name'],
                        'Product_Price' => $_POST['Product_price'],
                        'Product_Quantity' => $_POST['Product_quantity'],
                        'Product_Brand' => $_POST['Product_entership'],
                        'Product_Image' => $image_name,
                    );
                    $resul_Edit = Product::Edit($R_V);
                    return $resul_Edit;
                } else {
                    return 0;
                }
            }
        }
    }

    public function Add_products()
    {
        if (isset($_POST['Product_name']) && isset($_POST['Product_price']) && isset($_POST['Product_quantity']) &&
            isset($_POST['Product_entership']) && isset($_FILES['file']['name'])) {
            $image_name = $_FILES['file']['name'];
            $valid_extensions = array("jpg", "jpeg", "png");
            $extension = pathinfo($image_name, PATHINFO_EXTENSION);
            if (in_array($extension, $valid_extensions)) {
                $new_name = time() . '.' . $extension;
                $upload_path = "C:/Users/faho/Desktop/faho_world/public/images/product/".$new_name;
//                $upload_path = "./images/products/$new_name";
                if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_path)) {
                    $R_V = array(
                        'Product_Name' => $_POST['Product_name'],
                        'Product_Price' => $_POST['Product_price'],
                        'Product_Quantity' => $_POST['Product_quantity'],
                        'Product_Brand' => $_POST['Product_entership'],
                        'Product_Image' => $new_name,
                    );
                    $resul_Add = Product::Add($R_V);
                    return $resul_Add;
                } else {
                    return 0;
                }
            }

        }
    }

    public function getImage()
    {
        
    }
}