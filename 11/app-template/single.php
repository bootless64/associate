<?php
include "config_pdo.php";
include "header.php"; 
$post = null;

if (!isset($_GET['post_id'])) {
    die("شناسه پست ارسال نشده است");
}


$post_id = (int) $_GET['post_id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("پست مورد نظر پیدا نشد.");
}
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
                            <img
                                src="./upload/<?= $post['image']?>"
                                class="card-img-top"
                                alt="post-image" />
                            <div class="card-body">
                                <div
                                    class="d-flex justify-content-between">
                                    <h5 class="card-title fw-bold">
                                       <?= $post['title']?>

                                    </h5>
                                    <div>
                                        <span
                                            class="badge text-bg-secondary">طبیعت</span>
                                    </div>
                                </div>
                                <p
                                    class="card-text text-secondary text-justify pt-3">
                                    <?= $post['body']?>
                                </p>
                                <div>
                                    <p class="fs-6 mt-5 mb-0">
                                       <?= $post['author']?>
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

                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">نام</label>
                                        <input
                                            type="text"
                                            class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">متن کامنت</label>
                                        <textarea
                                            class="form-control"
                                            rows="3"></textarea>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-dark">
                                        ارسال
                                    </button>
                                </form>
                            </div>
                        </div>

                        <hr class="mt-4" />
                        <!-- Comment Content -->
                        <p class="fw-bold fs-6">تعداد کامنت : 3</p>

                        <div class="card bg-light-subtle mb-3">
                            <div class="card-body">
                                <div
                                    class="d-flex align-items-center">
                                    <img
                                        src="./assets/images/profile.png"
                                        width="45"
                                        height="45"
                                        alt="user-profle" />

                                    <h5
                                        class="card-title me-2 mb-0">
                                        محمد صالحی
                                    </h5>
                                </div>

                                <p class="card-text pt-3 pr-3">
                                    لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ و با
                                    استفاده از طراحان گرافیک است.
                                </p>
                            </div>
                        </div>

                        <div class="card bg-light-subtle mb-3">
                            <div class="card-body">
                                <div
                                    class="d-flex align-items-center">
                                    <img
                                        src="./assets/images/profile.png"
                                        width="45"
                                        height="45"
                                        alt="user-profle" />

                                    <h5
                                        class="card-title me-2 mb-0">
                                        متین سیدی
                                    </h5>
                                </div>

                                <p class="card-text pt-3 pr-3">
                                    لورم ایپسوم متن ساختگی با تولید
                                    سادگی نامفهوم از صنعت چاپ
                                </p>
                            </div>
                        </div>

                        <div class="card bg-light-subtle mb-3">
                            <div class="card-body">
                                <div
                                    class="d-flex align-items-center">
                                    <img
                                        src="./assets/images/profile.png"
                                        width="45"
                                        height="45"
                                        alt="user-profle" />

                                    <h5
                                        class="card-title me-2 mb-0">
                                        زهرا عزیزی
                                    </h5>
                                </div>

                                <p class="card-text pt-3 pr-3">
                                    لورم ایپسوم متن ساختگی با تولید
                                    سادگی
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "sidebar.php"; ?>

            <!-- Categories Section -->
            <div class="card mt-4">
                <div class="fw-bold fs-6 card-header">
                    دسته بندی ها
                </div>
                <ul class="list-group list-group-flush p-0">
                    <li class="list-group-item">
                        <a
                            class="link-body-emphasis text-decoration-none"
                            href="#">طبیعت</a>
                    </li>
                    <li class="list-group-item">
                        <a
                            class="link-body-emphasis text-decoration-none"
                            href="#">گردشگری</a>
                    </li>
                    <li class="list-group-item">
                        <a
                            class="link-body-emphasis text-decoration-none"
                            href="#">تکنولوژی</a>
                    </li>
                    <li class="list-group-item">
                        <a
                            class="link-body-emphasis text-decoration-none"
                            href="#">متفرقه</a>
                    </li>
                </ul>
            </div>

            <!-- Subscribue Section -->
            <div class="card mt-4">
                <div class="card-body">
                    <p class="fw-bold fs-6">عضویت در خبرنامه</p>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">نام</label>
                            <input
                                type="text"
                                class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ایمیل</label>
                            <input
                                type="email"
                                class="form-control" />
                        </div>
                        <div class="d-grid gap-2">
                            <button
                                type="submit"
                                class="btn btn-secondary">
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
        </div>
    </section>
</main>
<?php include "footer.php"; ?>