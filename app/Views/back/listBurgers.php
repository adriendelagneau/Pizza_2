<?php ob_start();?>
<main class="pizzas">
    <h1> Liste des Burgers</h1>
    <section>
        <div class="article_about">
            <div class="all-articles">
                <?php foreach($allBurgers as $burgers){ ?>

                <div class="card_articles">
                    <div class="card_title">Nom : <?= $burgers["productName"] ?></div>
                    <div class="card_content">Ingrédients : <?= $burgers["productDescription"] ?></div>
                    <div class="card_content">Prix : <?= $burgers["prix"] ?>€</div>
                    <button>
                        <a class="btn_update" href="indexAdmin.php?action=selectBurger&id=<?= $burgers['id'] ?>"> update
                            article</a>
                    </button>
                    <button class="btn_gestion">
                        <a class="btn_delete" href="indexAdmin.php?action=deleteBurger&id=<?= $burgers['id'] ?>">
                            supprimer
                            cette boisson</a>
                    </button><br>
                </div>
                
                <?php   } ?>
            </div>
        </div>
    </section>
    <section>
        <div class="newPizzas">
            <h2>Créez votre nouveau Burger </h2>
            <form action="indexAdmin.php?action=addBurger" method="POST">

                <label for="productName">Nom du burger : </label>
                <input type="text" id="productName" name="productName">

                <label for="productDescription">Ingrédients : </label>
                <textarea name="productDescription" id="productDescription" cols="30" rows="10"></textarea>

                <label for="prix">Prix : </label>
                <input type="number" id="prix" name="prix">

                <div class="subBtn">
                    <button type="submit" class="btn bt-secondary" data-dismiss="modal">Creer</button>
                </div>

            </form>
        </div>
    </section>
</main>
<?php $content = ob_get_clean()?>
<?php require 'templates/template.php'?>