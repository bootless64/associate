<?php
include "config_pdo.php";
include "header.php";

if (!isset($_GET['post_id'])) {
    die("شناسه پست ارسال نشده است");
}
if (isset($_POST['send_comment'])) {

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $post_id=$_GET['post_id'];

    $stmt = $conn->prepare(
        "INSERT INTO comments (name, comment, post_id, status)
         VALUES (?, ?, ?, 1)"
    );

    $stmt->execute([$name, $comment, $post_id]);
    ?>
    <script>
        alert("کامنت موفقیت اضافه شد");
        window.location.href = window.location.href;
    </script>"
    <?php
}




$post_id = (int) $_GET['post_id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("پست مورد نظر پیدا نشد.");
}

$commentStmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? AND status = 1");
$commentStmt->execute([$post_id]);
$comments = $commentStmt->fetchAll();
?>

<main>
    <!-- Content -->
    <section class="mt-4">
        <div class="row">
            <!-- Posts & Comments Content -->
            <div class="col-lg-8">
                <div class="row justify-content-center">
                    <!-- Post Section -->
                    <div class="col">
                        <div class="card">
                            <img src="./upload/<?= $post['image'] ?>" class="card-img-top" alt="post-image" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title fw-bold">
                                        <?= $post['title'] ?>


                                    </h5>
                                    <?php
                                    $cat_id=$post['category_id'];
                                    $sql="SELECT * FROM `categories` where id=$cat_id";
                                    $result=$conn->query($sql);
                                    $f=$result->fetch();
                                    $title=$f['title'];?>
                                    <div>
                                        <span class="badge text-bg-secondary"><?=$title?></span>
                                    </div>
                                </div>
                                <p class="card-text text-secondary text-justify pt-3">
                                    <?= $post['body'] ?>
                                </p>
                                <div>
                                    <p class="fs-6 mt-5 mb-0">
                                        <?= $post['author'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4" />

                    <!-- Comment Section -->
                    <div class="col">
                        <!-- Comment Form -->
                        <div class="card">
                            <div class="card-body">
                                <p class="fw-bold fs-5">
                                    ارسال کامنت
                                </p>

                                <form method="post">
                                    <div class="mb-3">
                                        <label class="form-label">نام</label>
                                        <input type="text" name="name" class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">متن کامنت</label>
                                        <textarea class="form-control" name="comment" rows="3"></textarea>
                                    </div>
                                    <button type="submit" name="send_comment" class="btn btn-dark">
                                        ارسال
                                    </button>
                                </form>
                            </div>
                        </div>

                        <hr class="mt-4" />
                        <!-- Comment Content -->
                        <p class="fw-bold fs-6">
                            تعداد کامنت : <?= count($comments) ?>
                        </p>


                        <?php foreach ($comments as $cm): ?>
                            <div class="card bg-light-subtle mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="./upload/profile.png" width="45" height="45" alt="user-profle" />

                                        <h5 class="card-title me-2 mb-0">
                                            <?= $cm['name'] ?>
                                        </h5>
                                    </div>

                                    <p class="card-text pt-3 pr-3">
                                        <?= $cm['comment'] ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php include "sidebar.php"; ?>



        </div>
    </section>
</main>
<?php include "footer.php"; ?>