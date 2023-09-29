<div class="container-fluid p-3">
    <div class="row">
        <div class="col-md-6">
            <div class="container p-5">
                <h1 id="welcome">bem-vindo ao nosso lar</h1>
                <h2 id="slogan">O apoio profissional <br> que você precisa</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, eveniet?</p>
                <?php
                if (!isset($_SESSION["idUser"])) {
                    ?>
                    <button><a href="<?= ROOT ?>/login">Serviços</a></button>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="v-img-container">
                <img src="Midia\imgs\vimg1.jpg" class="v-img" alt="foto1">
                <img src="Midia\imgs\vimg2.jpg" class="v-img" alt="foto2">
            </div>
        </div>
    </div>
</div>