<?php
    $conn = mysqli_connect('localhost','root','','shop_db') or die('connection failed');

    $a = $_POST['name'];
    $sql = "SELECT * FROM products where name like'%".$_POST['name']."%'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row=mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $link = 'http://localhost/BTL_WEB_29/book_detail.php&id='.$id;
            
            echo $link;
            echo "	<tr>
            <td>".$row['name']."</td>
            <td>".$row['author']."</td>
            <td>".$row['category']."</td>
            <td>".$row['publisher']."</td>
            <td><button type='button' name='detail' class='btn'><a href='".$link."' target='parent'> Chi Tiết</a></td>
          </tr>";

        }
    }
    else{
        echo "<tr><td>0 result's found</td></tr>";
    }
?>