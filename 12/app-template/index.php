<?php
include "config_pdo.php";
include "header.php";




if (isset($_GET['category_id'])) {
    $cid = $_GET['category_id'];
    $sql = "SELECT * FROM `posts` where category_id=$cid";
} else {
    $sql = "SELECT * FROM `posts`";
}
$res = $conn->query($sql);

$sql2 = "SELECT * FROM `posts`  ";
$tmp = $conn->query($sql2);
$res2 = $tmp->fetchAll(PDO::FETCH_ASSOC);

?>


<main>
    <!-- Slider Section -->
    <section>
        <div id="carousel" class="carousel slide">
            <div id="carousel" class="carousel slide">
                <div class="carousel-indicators">
                    <?php
                    foreach ($res2 as $index => $val) {

                    ?>
                        <button
                            type="button"
                            data-bs-target="#carousel"
                            data-bs-slide-to="<?= $index ?>"
                            class="<?= $index == 0 ? 'active' : '' ?>"></button>
                    <?php
                    }
                    ?>
                </div>
                <div class="carousel-inner rounded">
                    <?php
                    $flag = true;
                    foreach ($res2 as $val) {

                    ?>
                        <div
                            class="carousel-item overlay carousel-height <?php if ($flag) {
                                                                                echo 'active';
                                                                                $flag = false;
                                                                            } ?> ">
                            <img
                                src="./upload/<?= $val['image'] ?>"
                                class="d-block w-100"
                                alt="post-image" />
                            <div class="carousel-caption d-none d-md-block">
                                <h5> <?= $val['title'] ?> </h5>
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی
                                    نامفهوم از صنعت چاپ و با استفاده
                                </p>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
    </section>

    <!-- Content Section -->
    <section class="mt-4">
        <div class="row">
            <!-- Posts Content -->
            <div class="col-lg-8">
                <div class="row g-3">
                    <?php

                    foreach ($res as $row) {
                        $cat_id = $row['category_id'];
                        $sql = "SELECT * FROM `categories` where id=$cat_id";
                        $result = $conn->query($sql);
                        $f = $result->fetch();
                        $title = $f['title'];
                        $img = $row['image'];
                    ?>
                        <div class="col-sm-6">
                            <div class="card">
                                <img
                                    src="./upload/<?= $img ?>"
                                    class="card-img-top"
                                    alt="post-image" />
                                <div class="card-body">
                                    <div
                                        class="d-flex justify-content-between">
                                        <h5 class="card-title fw-bold">
                                            <?= $row["title"]; ?>
                                        </h5>
                                        <div>
                                            <span
                                                class="badge text-bg-secondary"> <?= $title; ?></span>
                                        </div>
                                    </div>
                                    <p
                                        class="card-text text-secondary pt-3">
                                        <?php echo substr($row["body"], 0, 150); ?>
                                        <a href="single.php?post_id=<?= $row['id'] ?>">...</a>

                                    </p>
                                    <div
                                        class="d-flex justify-content-between align-items-center">
                                        <a
                                            href="single.php?post_id=<?= $row['id'] ?>"
                                            class="btn btn-sm btn-dark">مشاهده</a>

                                        <p class="fs-7 mb-0">
                                            نویسنده : <?= $row["author"]; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <!-- Sidebar Section -->
            <?php include "sidebar.php"; ?>
        </div>
    </section>
</main>

<!-- Footer Section -->
<?php include "footer.php"; ?>