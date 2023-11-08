<?php

class Classes {

    public function showSelect($conn) {
        $sql = "select * from selector";
        $result = $conn->query($sql);
        return $result;
    }

    public function showFood($conn) {
        $sql = "select * from food";
        $result = $conn->query($sql);
        return $result;
    }

    public function showProduct($conn, $iddm) {
        if ($iddm == 0) {
            $sql = "select * from product";
        } else if ($iddm > 0 && $iddm <= 5) {
            $sql = "select * from product where iddm = $iddm";
        } else if ($iddm == 7) {
            $sql = "select * from product where price < 500";
        } else if ($iddm == 8) {
            $sql = "select * from product where price < 1000";
        } else if ($iddm == 9) {
            $sql = "select * from product where price < 1500";
        } else if ($iddm == 10) {
            $sql = "select * from product where price > 1500";
        } else if ($iddm == 6) {
            $sql = "select * from product order by price asc";
        }
        $result = $conn->query($sql);
        $listproduct = array();
        while ($row = $result->fetch_assoc()) {
            $listproduct[] = $row;
        }
        return $listproduct;
    }

    public function showDetails($conn, $id) {
        $sql = "select * from product where id = $id";
        $sqlUpdate = "update product set view = view + 1 where id = $id";
        $update = $conn->query($sqlUpdate);
        $result = $conn->query($sql);
        return $result;
    }

    public function showInfor($conn, $id) {
        $sql = "select * from detailsproduct,product where product.id = detailsproduct.idproduct and product.id = $id";
        $result = $conn->query($sql);
        return $result;
    }

    public function showSubMenu($conn) {
        $sql = "select * from product where idsub > 0";
        $result = $conn->query($sql);
        $listproduct = array();
        while ($row = $result->fetch_assoc()) {
            $listproduct[] = $row;
        }
        return $listproduct;
    }

    public function checkUser($conn, $user, $pass) {
        $sql = "select * from user where username = '" . $user . "' and password = '" . $pass . "'";
        $result = $conn->query($sql);
        return $result;
    }

    public function showOrder($conn) {
        $sql = "select count(orderID) from orders";
        $result = $conn->query($sql);
        return $result;
    }

    public function showRevenue($conn) {
        $sql = "select sum(price) from orderdetails";
        $result = $conn->query($sql);
        return $result;
    }

    public function showSale($conn) {
        $sql = "select sum(sold) from product";
        $result = $conn->query($sql);
        return $result;
    }

    public function showOrderDetails($conn,$word) {
        if($word != '' && $word != 1){
            $sql = "select * from orderdetails,orders where orders.orderID = orderdetails.orderID and orderdetails.productName like '%".$word."%' order by orders.orderID asc";
        }else if($word == '' || $word == 1){
            $sql = "select * from orderdetails,orders where orders.orderID = orderdetails.orderID order by orders.orderID asc";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showAllProduct($conn, $word) {
        if($word != '' && $word != 1){
            $sql = "select * from product where name like '%".$word."%'";
        }else if($word == '' || $word == 1){
            $sql = "select * from product";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function delProduct($conn, $id) {
        $sql = "delete from product where id = '".$id."'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showAllUser($conn) {
        $sql = "select count(id) from user";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showCustomerUser($conn) {
        $sql = "select role,count(id) from user where role = 2";
        $result = $conn->query($sql);
        return $result; 
    }
    
    public function showAdminUser($conn) {
        $sql = "select role,count(id) from user where role = 1";
        $result = $conn->query($sql);
        return $result; 
    }
    
    public function showSumProduct($conn) {
        $sql = "select count(id)from product";
        $result = $conn->query($sql);
        return $result; 
    }
    
    public function showSumQuantity($conn) {
        $sql = "select sum(quantity)from product";
        $result = $conn->query($sql);
        return $result; 
    }
    
    public function showSumView($conn) {
        $sql = "select sum(view)from product";
        $result = $conn->query($sql);
        return $result; 
    }
    
    public function showUser($conn,$word) {
        if($word != '' && $word != 1){
            $sql = "select * from user where name like '%".$word."%'";
        }else if($word == '' || $word == 1){
            $sql = "select * from user";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function delUser($conn, $id) {
        $sql = "delete from user where id = '".$id."'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function sumRevene($conn, $id) {
        $sql = "delete from user where id = '".$id."'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showBestSeller($conn) {
        $sql = "select sum(price) from orderdetails where productName = 'BUFFET FLOOR 81'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showSlow($conn) {
        $sql = "select sum(price) from orderdetails where productName = 'The Fruit Court 18'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showRevenuebyID($conn, $word) {
        if($word != '' && $word != 1){
            $sql = "select * from orderdetails WHERE productName name like '%".$word."%'";
        }else if($word == '' || $word == 1){
            $sql = "select * from orderdetails";
        }
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showSoldOut($conn) {
        $sql = "select * from product";
        $result = $conn->query($sql);
        $listproduct = array();
        while ($row = $result->fetch_assoc()) {
            $listproduct[] = $row;
        }
        echo json_encode($listproduct);
    }
    
    public function checkAccount($conn, $user) {
        $sql = "select * from user where username='".$user."'";
        $result = $conn->query($sql);
        return $result;
    }

    public function createUser($conn, $name, $phone, $email, $user, $pass, $address) {
        $sql = "insert into user(username,password,name,phone,email,address,role) values('$user','$pass','$name','$phone','$email','$address','2')";
        $sqlNoti = "insert into notifications(username,st) values ('$user','success')";
        $result = $conn->query($sql);
        $result2 = $conn->query($sqlNoti);
        return $result;
    }
    
    
    public function countID($conn) {
        $sql = "select count(id) from notifications";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countIDOrder($conn,$user) {
        $sql = "select count(userID) from orders where userID = '$user'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showParaOrder($conn, $start, $limit, $user) {
        $sql = "select * from orders where userID = '$user' order by date desc limit $start,$limit";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showPara($conn, $start, $limit) {
        $sql = "select * from notifications order by date asc limit $start,$limit";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showImg($conn, $user) {
        $sql = "select * from user where username = '$user'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function createNewProduct($conn, $name, $infor, $details, $type, $price, $quantity, $sold, $inventory, $date, $img) {
        $sql = "insert into product(name,infor,details,type,price,view,quantity,sold,inventory,date,img) values('$name','$infor','$details','$type','$price','0','$quantity','$sold','$inventory','$date','$img')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function createNewUser($conn, $user, $pass, $name, $gen, $birth, $position, $phone, $email, $address, $role, $date, $img) {
        $sql = "insert into user(username,password,name,gender, birthday,position,phone,email,address,role,date,img) values ('$user','$pass','$name', '$gen', '$birth','$position','$phone','$email','$address','$role','$date','$img')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addBooking($conn, $name, $phone, $email, $floor, $quan, $note, $date) {
        $sql = "insert into booking(name,phone,email,floor,quantity,notes,date) values('$name','$phone','$email','$floor','$quan','$note', '$date')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showBooking($conn) {
        $sql = "select * from booking";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addContact($conn, $name, $phone, $email, $note) {
        $sql = "insert into contact(name,phone,email,note) values ('$name','$phone','$email','$note')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showContact($conn) {
        $sql = "select * from contact";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateAdmin($conn, $name, $pass, $pos, $phone, $email, $address, $gender, $birthday, $img, $user) {
        $sql = "update user set name = '$name', password = '$pass', position = '$pos', phone = '$phone', email = '$email', address = '$address', gender = '$gender', birthday = '$birthday', img = '$img' where username = '$user'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function searchAccount($conn, $user, $phone, $email) {
        $sql = "select * from user where username = '$user' and phone = '$phone' and email = '$email'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updatePassword($conn, $user, $pass , $opass) {
        $sql = "update user set password = '$pass' where username = '$user' and password = '$opass' ";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateInforUser($conn, $user, $name, $email, $phone, $gender, $birth , $img) {
        $sql = "update user set name = '$name', email = '$email', phone = '$phone', gender = '$gender', birthday = '$birth', img = '$img' where username = '$user'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function editProductByID($conn, $id) {
        $sql = "select * from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    
    public function updateProduct($conn, $name, $infor, $details, $type, $view, $price, $quan, $sold, $inven, $date, $id, $img) {
        $sql = "update product set name = '$name', infor = '$infor', details = '$details', type = '$type', view = '$view', price = '$price', quantity = '$quan', sold = '$sold', inventory = '$inven', date = '$date', img = '$img' where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function editUserByID($conn, $id) {
        $sql = "select * from user where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateUser($conn, $name, $pos, $gender, $pass, $birth, $phone, $email, $address, $date, $id, $img) {
        $sql = "update user set name = '$name', position = '$pos', gender = '$gender', password = '$pass', birthday = '$birth', phone = '$phone', email = '$email', address = '$address', date = '$date', img = '$img' where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function findProductById($conn, $id) {
        $sql = "select * from product where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function addOrder($conn,$id, $date, $st) {
        $sql = "insert into orders(userID,date,st) values('$id','$date','$st')";
        $result = $conn->query($sql);
        return $result;
    }
    
    
    public function addOrderDetails($conn,$product,$price,$quantity) {
        $last = mysqli_insert_id($conn);
        $sql = "insert into orderdetails (orderID,productName,price,quantity) values ('$last','$product','$price','$quantity')";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showUserByID($conn, $user, $password) {
        $sql = "select * from user where username = '$user' and password = '$password'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderedit($conn,$id) {
        $sql = "select * from orderdetails,orders where orders.orderID = orderdetails.orderID and orders.orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function editOrrder($conn, $id, $st) {
        $sql = "update orders set st = '$st' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    
    public function editStatus($conn, $id, $name, $price, $quan) {
        $sql = "update orderdetails set productName = '$name', price = '$price', quantity = '$quan' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderDetailUser($conn, $id) {
        $sql = "select * from orders,orderdetails where orders.orderID = orderdetails.orderID and orders.orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countOrderDone($conn) {
        $sql = "select count(st) from orders where st = 'done' or st = 'Done'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function countOrderPending($conn) {
        $sql = "select count(st) from orders where st = 'pending' or st = 'Pending'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function showOrderPending($conn,$st) {
        $sql = "select orders.orderID,user.id,user.name,user.phone,user.email,orders.date,orders.st from orders,user where orders.userID = user.id and orders.st = '$st'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateStatus($conn,$st,$id) {
        $sql = "update orders set st = '$st' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function updateStatusRefuse($conn,$st,$id) {
        $sql = "update orders set st = '$st' where orderID = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
}
