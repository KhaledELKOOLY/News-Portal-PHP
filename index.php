

<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == NULL)
    {
        header("location:login.php");
        exit();
    }



?>

<?php


require "db_connection.php";
if(isset($_POST['q']))
    {
        $search = $_POST['q'];
        $query = "SELECT * FROM news WHERE title like '%$search%' or category like '%$search%' or content like '%$search%'";
        $result = mysqli_query($conn, $query);
    }
else
    {
        $query = "SELECT * FROM news";
        $result = mysqli_query($conn, $query);
    }


?>


<h1 style= "color:red; text-align:center"> Welcom <?php echo $_SESSION["name"];?>  <a href= "logout.php"> تسجيل الخروج </a></h1>
<p dir= "rtl" style = "text-align: right; padding-right: 250px"><a href = "add_news.php">اضافة خبر جديد </a>
</p>
<form class="search-form" action="index.php" method="POST">
    <style>
      .search-form {
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        width: 100%;
        max-width: 540px;
        margin-left: auto;
        margin-top: -40px;
        margin-right: 493px;
        margin-bottom: 10px;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 4px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
      }

      .search-form:focus-within {
        border-color: #2563eb;
        box-shadow: 0 12px 30px rgba(37, 99, 235, 0.16);
      }

      .search-form .search-input {
        flex: 1;
        direction: rtl;
        border: none;
        background: transparent;
        padding: 12px 16px;
        font-size: 1rem;
        color: #0f172a;
        outline: none;
        min-width: 0;
      }

      .search-form .search-input::placeholder {
        color: #94a3b8;
      }

      .search-form .search-btn {
        border: none;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        padding: 12px 26px;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.2s ease;
        white-space: nowrap;
      }

      .search-form .search-btn:hover {
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.32);
        transform: translateY(-1px);
      }

      .search-form .search-btn:active {
        transform: translateY(0);
      }
    </style>

    <input
      type="search"
      name="q"
      class="search-input"
      placeholder="ابحث عن خبر، موضوع، أو كلمة مفتاحية..."
      aria-label="بحث"
    />
    <button type="submit" class="search-btn">بحث</button>
  </form>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple HTML CSS Table</title>
  <style>
    /* Basic page styling */
    body {
      font-family: system-ui, -apple-system, sans-serif;
      padding: 2rem;
    }

    /* Responsive wrapper for small screens */
    .table-container {
      overflow-x: auto;
    }

    /* Core table styles */
    table {
      width: 100%;
      max-width: 800px;
      border-collapse: collapse; /* Removes double borders */
      margin: 0 auto;
      font-size: 0.95rem;
      text-align: left;
    }

    /* Header styling */
    thead tr {
      background-color: #2563eb;
      color: #ffffff;
    }

    /* Cell padding and borders */
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #e2e8f0;
      text-align:center;
    }

    /* Zebra striping for alternating rows */
    tbody tr:nth-child(even) {
      background-color: #f8fafc;
    }

    /* Row hover effect */
    tbody tr:hover {
      background-color: #eff6ff;
    }
  </style>
</head>
<body>

  <div class="table-container">
    <table dir = 'rtl'>
      <thead>
        <tr>
          <th scope="col">title</th>
          <th scope="col">category</th>
          <th scope="col">content</th>
          <th scope="col">image</th>
          <th scope="col">control</th>
        </tr>
      </thead>
      <tbody>
<?php
      if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
            { ?>

        <tr>
          <td><?php echo $row['title'];?></td>
          <td><?php echo $row['category'];?></td>
          <td><?php echo $row['content'];?></td>
          <td><img  src="<?php echo $row['image']; ?>" alt="image" width="90"></td>
          <td>
            <a href="delete_news.php?action=delete&id=<?php echo $row['id'];?>"><img src="image/trash_can.png" alt="Delete" width="20"></a>
            <a href="update_news.php?action=update&id=<?php echo $row['id'];?>" style="margin-right: 30px;"><img src="image/pencil.png" alt="update" width="20"></a>
          </td>
        </tr>


<?php
              

            }
        
    }
    else
        { ?>


<tr> <td colspan = "4"  style = "text-align:center;"> عفوا لاتوجد بيانات تعرفها</td></tr>
<?php



        }



?>
    
      
      </tbody>
    </table>
  </div>

</body>
</html>