
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == NULL)
    {
        header("location:login.php");
        exit();
    }

?>

<?php
$row = null;
require 'db_connection.php';

if($_GET['action'] == 'update' && isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query = "SELECT *FROM news where id = '$id' limit 1;";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();
    }



if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rowid = $_POST['id'];
        $query = "SELECT * FROM news where id = '$id' limit 1;";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_assoc();



        $TITLE = $_POST['title'];
       
        $UPDATE_BY_USERID = $_SESSION['userid'];
        $CATEGORY = $_POST['category'];
        $UPDATE_DATE = !empty($_POST['date'])? $_POST['date'] : date('Y-m-d');
        $CONTENT = $_POST['content'];

        if(!empty($_FILES['image']['name']))
            {
                $target_file = "Uploads/".basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

                if(file_exists($row['image']))
                    {
                        unlink($row['image']);
                    }
                
        
                $query = "UPDATE news SET title = '$TITLE', update_by_userid = '$UPDATE_BY_USERID', category = '$CATEGORY', update_date = '$UPDATE_DATE', content = '$CONTENT', image = '$target_file' WHERE id = '$rowid';";
                mysqli_query($conn,$query);
                header("location:index.php");
                exit();
            }
        else
            {
                
             
        
                $query = "UPDATE news SET title = '$TITLE', update_by_userid = '$UPDATE_BY_USERID', category = '$CATEGORY', update_date = '$UPDATE_DATE', content = '$CONTENT' WHERE id = '$rowid';";
                 mysqli_query($conn,$query);
                header("location:index.php");
                exit();
            }





    }





?>











<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>تحديث الخبر </title>
 <link rel="stylesheet" href="style2add_news.css">
</head>
<body>
  <main class="container">
    <div class="header">
      <h1>تحديث الخبر </h1>
    </div>

    

    <form action="update_news.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">العنوان / الاسم *</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title'] ?>" required />
      </div>
      
       <input type = "hidden" name="id" value="<?php echo $row['id'];?>">

     <h5>الصورة البارزة</h5>

    <!-- صندوق اختيار وتغيير الصورة (النقر في أي مكان داخله يفتح نافذة الملفات) -->
    <div class="upload-container">
      <img  src="<?php echo $row['image']; ?>" alt="image" width="90">
      <p class="upload-text">اضغط هنا لإختيار صورة أو تغييرها</p>
      <p class="upload-hint">PNG, JPG, WebP مسموح بها</p>
      <input type="file" name="image" accept="image/*" />
    </div>


      <div class="form-group">
        <label for="category">التصنيف</label>
        <select id="category" name="category" required>
          <option value="محلي"<?php if($row['category'] == 'محلي') echo 'selected'; ?>>محلي</option>
          <option value="دولي"<?php if($row['category'] == 'دولي') echo 'selected'; ?>>دولي</option>
          <option value="سياسة"<?php if($row['category'] == 'سياسة') echo 'selected'; ?>>سياسة</option>
          <option value="اقتصاد"<?php if($row['category'] == 'اقتصاد') echo 'selected'; ?>>اقتصاد</option>
          <option value="رياضة"<?php if($row['category'] == 'رياضة') echo 'selected'; ?>>رياضة</option>
          <option value="تكنولوجيا"<?php if($row['category'] == 'تكنولوجيا') echo 'selected'; ?>>تكنولوجيا</option>
          <option value="منوعات"<?php if($row['category'] == 'ثقافةوفن/منوعات') echo 'selected'; ?>>منوعات/ثقافةوفن</option>
          <option value="عاجل"<?php if($row['category'] == 'عاجل') echo 'selected'; ?>>عاجل</option>
          <option value="أخرى"<?php if($row['category'] == 'أخرى') echo 'selected'; ?>>أخرى</option>
        </select>
      </div>

      <div class="form-group">
        <label for="date">التاريخ</label>
        <input type="date" id="date" name="date"  value="<?php echo $row['date']; ?>"/>
      </div>

      <div class="form-group">
        <label for="content">الوصف</label>
        <textarea id="content" name="content"><?php echo $row['content'];?></textarea>
      </div>

      <div class="actions">
        <button type="submit" class="btn-primary">تحديث</button>
        <button type="reset" class="btn-secondary">مسح الحقول</button>
      </div>
    </form>
  </main>
</body>
</html>