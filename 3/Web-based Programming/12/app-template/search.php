<?php
include "config_pdo.php";
include "header.php";


if (isset($_GET['txtsearch']) && trim($_GET['txtsearch']) !== '') {
    $ser = trim($_GET['txtsearch']);

    $sql = "SELECT * FROM posts WHERE title LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'search' => "%$ser%"
    ]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<body>
<div class="container py-3">
    <main>
        <section class="mt-4">
            <div class="row">

                <!-- Posts Content -->
                <div class="col-lg-8">

                    <?php if ($ser !== ''): ?>
                        <div class="alert alert-secondary">
                            پست‌های مرتبط با کلمه [ <?= htmlspecialchars($ser) ?> ]
                        </div>

                        <?php if (count($results) === 0): ?>
                            <div class="alert alert-danger">
                                مقاله مورد نظر پیدا نشد!
                            </div>
                        <?php else: ?>

                            <div class="row g-3">
                                <?php foreach ($results as $post): ?>

                                    <?php
                                    $catId = $post['category_id'];
                                    $catStmt = $conn->prepare(
                                        "SELECT title FROM categories WHERE id = ?"
                                    );
                                    $catStmt->execute([$catId]);
                                    $category = $catStmt->fetch();
                                    ?>

                                    <div class="col-sm-6">
                                        <div class="card h-100">
                                            <img
                                                src="./upload/<?= htmlspecialchars($post['image']) ?>"
                                                class="card-img-top"
                                                alt="post-image"
                                            />

                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title fw-bold">
                                                        <?= htmlspecialchars($post['title']) ?>
                                                    </h5>
                                                    <span class="badge text-bg-secondary">
                                                        <?= $category['title'] ?? 'بدون دسته‌بندی' ?>
                                                    </span>
                                                </div>

                                                <p class="card-text text-secondary pt-3">
                                                    <?= mb_substr(strip_tags($post['body']), 0, 150) ?>
                                                    <a href="single.php?post_id=<?= $post['id'] ?>">...</a>
                                                </p>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a
                                                        href="single.php?post_id=<?= $post['id'] ?>"
                                                        class="btn btn-sm btn-dark"
                                                    >مشاهده</a>

                                                    <p class="fs-7 mb-0">
                                                        نویسنده: <?= htmlspecialchars($post['author']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                        <?php endif; ?>
                    <?php endif; ?>

                </div>

                <!-- Sidebar -->
                <?php include "sidebar.php"; ?>

            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
