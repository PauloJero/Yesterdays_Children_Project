<?php
// include("./autoload.php");
?>

<div id="mensagem"></div>
<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src="../Midia/svgs/logosite.svg" style="width: 185px;" alt="logo">
                                </div>

                                <form action="login/index/form" method="post">
                                    <span>Fazer login</span>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail"/>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="senha">Palavra-passe</label>
                                        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha"/>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Login</button><br>
                                        <a class="text-muted" href="#">Esqueceu-se da palavra-passe?</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <p class="small mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>