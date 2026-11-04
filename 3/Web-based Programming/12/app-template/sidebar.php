<?php
include("config_pdo.php");
$sql = "SELECT * FROM categories ";
$categories = $conn->query($sql);

$sql1 = "SELECT * FROM posts ";
$posts = $conn->query($sql1);

if (isset($_POST['subscribe'])) {

    $name  = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO subscribers (id, name, email) VALUES (NULL, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $email]);
    ?>
    <script>
        alert("عضویت با موفقیت انجام شد");
        window.location.href = window.location.href;
    </script>"
          <?php
}

?>

<div class="col-lg-4">
    <!-- Sesrch Section -->
    <div class="card">
        <div class="card-body">
            <p class="fw-bold fs-6">جستجو در وبلاگ</p>
            <form action="search.php?">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="txtsearch" placeholder="جستجو ..." />
                    <button class="btn btn-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="card mt-4">
        <div class="fw-bold fs-6 card-header">دسته بندی ها</div>
        <ul class="list-group list-group-flush p-0">
            <?php
            foreach ($categories as $category) {
                ?>
                <li class="list-group-item">
                    <a class="link-body-emphasis text-decoration-none" href="?category_id=<?= $category['id'] ?>">
                        <?= $category['title'] ?>
                    </a>
                </li>
                <?php
            }
            ?>

        </ul>
    </div>

    <!-- Subscribue Section -->
    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">عضویت در خبرنامه</p>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">نام</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="subscribe" class="btn btn-secondary">
                        ارسال
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- About Section -->
    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">درباره ما</p>
            <p class="text-justify">
                لورم ایپسوم متن ساختگی با تولید سادگی
                نامفهوم از صنعت چاپ و با استفاده از
                طراحان گرافیک است. چاپگرها و متون بلکه
                روزنامه و مجله در ستون و سطرآنچنان که
                لازم است و برای شرایط فعلی تکنولوژی مورد
                نیاز و کاربردهای متنوع با هدف بهبود
                ابزارهای کاربردی می باشد.
            </p>
        </div>
    </div>
</div>