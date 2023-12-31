<!-- content -->
<?php
session_start();
if (!isset($_SESSION['data']['user'])) {
    header('location: ./layouts/authLayouts/loginPage.php');
}

?>
<div class="main-content">
    <div class="library-header">
        <span class="library-header__text text-white d-flex align-items-center">
            <h1 style="font-size: 40px; font-weight: 700;">Bài hát yêu thích</h1>
            <span class="library-header__icon-play ms-3">
                <i class="fa-solid fa-play text-black fs-4 "></i>
            </span>
        </span>
    </div>

    <div class="library-nav mt-5">
        <ul class="nav nav-underline fs-2">
            <li class="nav-item me-3">
                <a id="songTab" class="nav-link activeTopBar" href="../views/main.php?page_layout=librarySongPage">Tất cả</a>
            </li>
        </ul>
    </div>
    <?php
    include_once('../controllers/renderView.php');
    $favourite = new querySQL();
    $result = $favourite->renderToFavourite();
    $num_rows = mysqli_num_rows($result);
    if ($num_rows <= 0) {
    ?>
        <div class="library-empty text-white">
            <div class="library-empty__icon">
                <i class="fa-solid fa-music"></i>
            </div>

            <span class="library-empty__title fs-3">Chưa có bài hát yêu thích nào</span>

        </div>
        <?php } else {
        while ($row = $result->fetch_assoc()) {
        ?>
            <div id="<?php echo $row['song_id'] ?>" class=" col-12 new_release__song d-flex text-white justify-content-around align-items-center mt-3" onclick="controllerMusic.clickOnSong(this.id,this)">
                <img src="<?php echo $row['image']; ?>" alt="" class="song__image ">
                <div class="song__name flex-fill ms-5">
                    <h3><?php echo $row['title'] ?></h3>
                    <span>
                        <a style="text-decoration: none; color: #ccc; font-size: 12px; font-weight:500;" href=""><?php echo $row['artist'] ?>,</a>
                        <a style="text-decoration: none; color: #ccc; font-size: 12px; font-weight:500;" href=""><?php echo $row['genre'] ?></a>
                    </span>
                </div>
                <div class="song__interact fs-4">
                    <div class="dropdown song-item" onclick="event.stopPropagation()">
                        <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu song-menu">
                            <li class="dropdown-item> " onclick="removeFromFavourite(this,event),toast('Đã xóa bài hát khỏi yêu thích')">
                                <button type="button" class="btn liveToastBtn fs-4 text-white ">Xóa khỏi yêu thích</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</div>

<!-- content -->