<?php
session_start();
include('../connection/connect.php');
include('./functions/functions.php');


if (isset($_POST['add_category'])) {

    $cat_name = $_POST['cat_name'];
    $index_name = $_POST['cat_index'];
    $description = $_POST['cat_description'];
    $keywords = $_POST['cat_keywords'];
    $status = isset($_POST['cat_status']) ? '1' : '0';
    $popular = isset($_POST['cat_popular']) ? '1' : '0';
    $image = $_FILES['cat_image']['name'];

    $path = "../staff/images/";
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);


    $cat_query = "INSERT INTO category (`cat_name`,`cat_index`,`cat_description`,`cat_status`,`cat_popular`,`cat_image`,`cat_keywords`) VALUES('$cat_name','$index_name','$description','$status','$popular','$image','$keywords')";
    $cat_run = mysqli_query($conn, $cat_query);

    if ($cat_run) {
        redirect("./category/addcat.php", "Category added successfully to the database.");
    } else {
        redirect("./category/addcat.php", "Something Went Wrong, Try Again!");
    }
} else if (isset($_POST['update_category'])) {
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $index_name = $_POST['cat_index'];
    $description = $_POST['cat_description'];
    $keywords = $_POST['cat_keywords'];
    $status = isset($_POST['cat_status']) ? '1' : '0';
    $popular = isset($_POST['cat_popular']) ? '1' : '0';


    $new_image = $_FILES['cat_image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $update_filename = $new_image;
    } else {
        $update_filename = $old_image;
    }

    $path = "../staff/images/";
    $update_query = "UPDATE `category` SET cat_name='$cat_name', cat_index='$index_name', cat_description='$description',cat_keywords='$keywords', cat_status='$status', cat_popular='$popular', cat_image='$update_filename' WHERE cat_id = '$cat_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['cat_image']['name'] != "") {
            move_uploaded_file($_FILES['cat_image']['tmp_name'], $path . '/' . $new_image);
            if (file_exists("../staff/images/" . $old_image)); {
                unlink("../images/" . $old_image);
            }
        }
        redirectTo("./category/editcat.php?id=$cat_id", "Category Updated Successfully");
    }
} else if (isset($_POST['delete_cat'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM `category` WHERE cat_id ='$category_id'";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['cat_image'];

    $delete_query = "DELETE FROM `category` WHERE cat_id = '$category_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../staff/images/" . $image)); {
            unlink("../staff/images/" . $image);
        }
        redirect("./category/category.php", "Category deleted Successfully");
    } else {
        redirect("./category/category.php", "Something went wrong!");
    }
} elseif (isset($_POST['add_product'])) {

    $cat_id = $_POST['cat_id'];
    $prod_name = $_POST['prod_name'];
    $prod_index = $_POST['prod_index'];
    $description = $_POST['prod_description'];
    $price = $_POST['prod_price'];
    $qty = $_POST['prod_qty'];
    $status = isset($_POST['prod_status']) ? '1' : '0';
    $trending = isset($_POST['prod_trending']) ? '1' : '0';
    $keywords = $_POST['prod_keywords'];

    $image = $_FILES['prod_image']['name'];
    $image1 = $_FILES['prod_img1']['name'];
    $image2 = $_FILES['prod_img2']['name'];
    $image3 = $_FILES['prod_img3']['name'];

    $path = "../staff/images/";
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $image_extension1 = pathinfo($image1, PATHINFO_EXTENSION);
    $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
    $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);

    $product_query = "INSERT INTO products (`cat_id`,`prod_name`,`prod_index`,`prod_description`,`prod_price`,`prod_qty`,`prod_status`,`prod_trending`,`prod_keywords`,`prod_image`,`prod_img1`,`prod_img2`,`prod_img3`) VALUES ('$cat_id','$prod_name',' $prod_index','$description','$price','$qty','$status','$trending','$keywords','$image','$image1','$image2','$image3')";

    $product_query_run = mysqli_query($conn, $product_query);

    if ($product_query_run) {
        redirect("./product/addprod.php", "Product added successfully to the database.");
    } else {
        redirect("./product/addprod.php", "Something Went Wrong");
    }
} elseif (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $cat_id = $_POST['cat_id'];

    $prod_name = $_POST['prod_name'];
    $prod_index = $_POST['prod_index'];
    $description = $_POST['prod_description'];
    $price = $_POST['prod_price'];
    $qty = $_POST['prod_qty'];
    $status = isset($_POST['prod_status']) ? '1' : '0';
    $trending = isset($_POST['prod_trending']) ? '1' : '0';
    $keywords = $_POST['prod_keywords'];

    $image = $_FILES['prod_image']['name'];
    $image1 = $_FILES['prod_img1']['name'];
    $image2 = $_FILES['prod_img2']['name'];
    $image3 = $_FILES['prod_img3']['name'];

    $path = "../staff/images/";
    $new_image = $_FILES['prod_image']['name'];
    $old_image = $_POST['old_image'];
    $new_image1 = $_FILES['prod_img1']['name'];
    $old_image1 = $_POST['old_image1'];
    $new_image2 = $_FILES['prod_img2']['name'];
    $old_image2 = $_POST['old_image2'];
    $new_image3 = $_FILES['prod_img3']['name'];
    $old_image3 = $_POST['old_image3'];

    if ($new_image != "" OR $new_image1 != "" OR $new_image2 != "" OR $new_image3 != "") {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $update_filename = $new_image;
        $image_extension1 = pathinfo($image1, PATHINFO_EXTENSION);
        $update_filename1 = $new_image1;
        $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
        $update_filename2 = $new_image2;
        $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);
        $update_filename3 = $new_image3;
    } else {
        $update_filename = $old_image;
        $update_filename1 = $old_image1;
        $update_filename2 = $old_image2;
        $update_filename3 = $old_image3;
    }
    $update_product_query = "UPDATE `products` SET cat_id = '$cat_id',prod_name = '$prod_name', prod_index ='$prod_index', prod_description = '$description', prod_price = '$price',prod_qty = '$qty', prod_status = '$status', prod_trending = '$trending',prod_image='$update_filename',prod_img1='$update_filename1',prod_img2='$update_filename2',prod_img3='$update_filename3' WHERE prod_id='$product_id' ";
    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['prod_image']['name'] != "") {
            move_uploaded_file($_FILES['prod_image']['tmp_name'], $path . '/' . $new_image);
            if (file_exists("../staff/images/" . $old_image)); {
                unlink("../staff/images/" . $old_image);
            }
        }
        redirect("./product/editprod.php?id=$product_id", "Product Updated Successfully");
    } else {
        redirect("./product/editprod.php?id=$product_id", "Something Went Wrong");
    }
} elseif (isset($_POST['delete_prod'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $prod_query = "SELECT * FROM `products` WHERE prod_id ='$product_id'";
    $prod_query_run = mysqli_query($conn, $prod_query);
    $prod_data = mysqli_fetch_array($prod_query_run);
    $image = $prod_data['prod_image'];
    $image1 = $prod_data['prod_img1'];
    $image2 = $prod_data['prod_img2'];
    $image3 = $prod_data['prod_img3'];

    $delete_query = "DELETE FROM `products` WHERE prod_id = '$product_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        
        echo 200;
    } else {
        echo 500;
    }

}elseif(isset($_POST['update_order'])){
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['o_status'];

    $update_q = "UPDATE `orders` SET order_status = '$order_status' WHERE tracking_no = '$track_no'";
    $updateq_run = mysqli_query($conn, $update_q);

    redirect("./transaction.php","Order Status Updated!");
}
else {
    header("Location: ../home.php");
}
