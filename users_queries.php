<?php

require "db_connection.php";

// $query = "CREATE TABLE IF NOT EXISTS users(
// id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY ,
// name varchar(75),
// email varchar(75),
// username varchar(50),
// password varchar(255),
// image varchar(75))";
// 
// if(mysqli_query($conn, $query))
//     {
//         echo "Data Seved successfully.";
//     }
// else{
//     echo "Data Not Successfully.";
// }



// $query = "INSERT INTO users(name , email, username, password, image)
// VALUES('Khaled', 'khaled333@gmail.com', 'k7aled_CE', '12345', 'c:\Users\Aljazeera\Downloads\admin.png')";
// 
// 
// if(mysqli_query($conn,$query))
//     {
//         echo "Data Saved Successfully.";
//     }
// else
//     {
//         echo "Not Data Successfully.";
//     }
// 
// mysqli_close($conn);




// $query = "CREATE TABLE IF NOT EXISTS news(
// id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
// title varchar(255),
// content text,
// image varchar(100),
// date Date,
// added_by_userid INT,
// update_date INT NULL,
// update_by_userid INT NULL
// );";
// 
// if(mysqli_query($conn,$query))
//     {
//         echo "Data Seaved successfully.";
//     }
// else
//     {
//         echo "Data Not Successfully.";
//     }


// $query = "INSERT INTO news(title, content, date, added_by_userid)
// VALUES ('اخبار الرياضه', 'محتوي اخبار الرياضه' , Now() , 1),
// ('اخبار الطقس' , 'محتوي اخبار الطقس' , Now() , 1);";
// 
// if(mysqli_query($conn,$query))
//     {
//         echo "Data seved successfully.";
//     }
// else
//     {
//         echo "Data Not Seved";
//     }
// 


$query = "UPDATE news SET 
                        category =  CASE
                        When id = 1 Then 'رياضة'
                        else category
                    end,
                        category = CASE
                        When id = 2 Then 'طقس'
                        else category
                    end
                    where id IN (1,2);";
if(mysqli_query($conn, $query))
    {
        echo "Data seved successfuly.";
    }
else
    {
        echo "Not Data successfully.";
    }
mysqli_close($conn);

?>