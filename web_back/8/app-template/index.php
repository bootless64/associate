<?php 
include "config_pdo.php";
include "header.php"; ?>
            <main>
                <!-- Slider Section -->
                <section>
                    <div id="carousel" class="carousel slide">
                        <div class="carousel-indicators">
                            <button
                                type="button"
                                data-bs-target="#carousel"
                                data-bs-slide-to="0"
                                class="active"
                            ></button>
                            <button
                                type="button"
                                data-bs-target="#carousel"
                                data-bs-slide-to="1"
                            ></button>
                            <button
                                type="button"
                                data-bs-target="#carousel"
                                data-bs-slide-to="2"
                            ></button>
                        </div>
                        <div class="carousel-inner rounded">
                            <div
                                class="carousel-item overlay carousel-height active"
                            >
                                <img
                                    src="./assets/images/1.jpg"
                                    class="d-block w-100"
                                    alt="post-image"
                                />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>لورم ایپسوم متن</h5>
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی
                                        نامفهوم از صنعت چاپ و با استفاده
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item carousel-height overlay">
                                <img
                                    src="./assets/images/2.jpg"
                                    class="d-block w-100"
                                    alt="post-image"
                                />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>لورم ایپسوم متن</h5>
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی
                                        نامفهوم از صنعت چاپ و با استفاده
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item carousel-height overlay">
                                <img
                                    src="./assets/images/3.jpg"
                                    class="d-block w-100"
                                    alt="post-image"
                                />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>لورم ایپسوم متن</h5>
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی
                                        نامفهوم از صنعت چاپ و با استفاده
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carousel"
                            data-bs-slide="prev"
                        >
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next"
                            type="button"
                            data-bs-target="#carousel"
                            data-bs-slide="next"
                        >
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
                                $sql="SELECT * FROM `posts`";
                                $res = $conn->query($sql);
                                foreach($res as $row){
                                ?>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <img
                                            src="./assets/images/4.jpg"
                                            class="card-img-top"
                                            alt="post-image"
                                        />
                                        <div class="card-body">
                                            <div
                                                class="d-flex justify-content-between"
                                            >
                                                <h5 class="card-title fw-bold">
                                                    <?= $row["title"] ; ?>
                                                </h5>
                                                <div>
                                                    <span
                                                        class="badge text-bg-secondary"
                                                        >  <?= $row["category_id"] ; ?></span
                                                    >
                                                </div>
                                            </div>
                                            <p
                                                class="card-text text-secondary pt-3"
                                            >
                                            <?php echo substr($row["body"], 0 ,150). "..."; ?>
                                         
                                            </p>
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <a
                                                    href="single.html"
                                                    class="btn btn-sm btn-dark"
                                                    >مشاهده</a
                                                >

                                                <p class="fs-7 mb-0">
                                                    نویسنده :  <?= $row["author"] ; ?> 
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                        </div>

                        <!-- Sidebar Section -->
                      <?php include "sidebar.php" ;?>
                    </div>
                </section>
            </main>

            <!-- Footer Section -->
            <?php include "footer.php" ; ?>
