<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == NULL)
    {
        header('location:login.php');
        exit();
    }
?>
<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $TITLE = $_POST['title'];
        $CATEGORY = $_POST['category'];
        $DATE = $_POST['date'];
        $CONTENT = $_POST['content'];
        $ADDEDBYUSER = $_SESSION['userid'];
        
        require 'db_connection.php';

        $trget_file = "Uploads/".basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES['image']['tmp_name'],  $trget_file);

        $query = "INSERT INTO news(title , category , date , content , added_by_userid,image) VALUES ('$TITLE', '$CATEGORY' , '$DATE' , '$CONTENT', '$ADDEDBYUSER','$trget_file')";

        mysqli_query($conn, $query);
        header("location:index.php");
        exit();
    
        
    }


?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>إضافة خبر جديد</title>
 <link rel="stylesheet" href="style2add_news.css">
</head>
<body>
  <main class="container">
    <div class="header">
      <h1>إضافة خبر جديدة</h1>
      <p>املأ البيانات التالية لإنشاء خبر جديد.</p>
    </div>

    <form action="add_news.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title">العنوان / الاسم *</label>
        <input type="text" id="title" name="title" placeholder="مثال:اضافة عنوان للخبر " required />
      </div>



     <h5>الصورة البارزة</h5>

    <!-- صندوق اختيار وتغيير الصورة (النقر في أي مكان داخله يفتح نافذة الملفات) -->
    <div class="upload-container">
      <div class="upload-icon">📁</div>
      <p class="upload-text">اضغط هنا لإختيار صورة أو تغييرها</p>
      <p class="upload-hint">PNG, JPG, WebP مسموح بها</p>
      <input type="file" name="image" accept="image/*" />
    </div>


      <div class="form-group">
        <label for="category">التصنيف</label>
        <select id="category" name="category" required>
          <option value="محلي">محلي</option>
          <option value="دولي">دولي</option>
          <option value="سياسة">سياسة</option>
          <option value="اقتصاد">اقتصاد</option>
          <option value="رياضة">رياضة</option>
          <option value="تكنولوجيا">تكنولوجيا</option>
          <option value="منوعات">منوعات/ثقافةوفن</option>
          <option value="عاجل">عاجل</option>
          <option value="أخرى">أخرى</option>
        </select>
      </div>

      <div class="form-group">
        <label for="date">التاريخ</label>
        <input type="date" id="date" name="date" />
      </div>

      <div class="form-group">
        <label for="content">الوصف</label>
        <textarea id="content" name="content" placeholder="اكتب تفاصيل إضافية هنا..."></textarea>
      </div>

      <div class="actions">
        <button type="submit" class="btn-primary">إضافة</button>
        <button type="reset" class="btn-secondary">مسح الحقول</button>
      </div>
    </form>
  </main>
</body>
</html>