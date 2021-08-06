<?php

namespace Project\Controllers\front;

class FrontController{

   
    function accueil(){
        $slides = new \Project\Models\ImagesManager();
        $allSlides = $slides->getSlides(); 
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();         
        $reducs = new \Project\Models\ReducManager();
        $allReducs = $reducs->allReducs();
        require "app/Views/front/accueil.php";
    }

    function erreurChampsVides(){
        $slides = new \Project\Models\ImagesManager();
        $allSlides = $slides->getSlides(); 
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();         
        $reducs = new \Project\Models\ReducManager();
        $allReducs = $reducs->allReducs();
        require "app/Views/front/accueil.php";
        echo '<script>alert("Vous n avez pas rempli les champs !");</script>';
    }

    function pizzas(){      
        $pizzas = new \Project\Models\ProduitsManager();
        $allPizzas = $pizzas->allPizzas();
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne(); 
        require "app/Views/front/pizzas.php";
    }

     function veg($isVeg){
        $pizzas = new \Project\Models\ProduitsManager();
        $allPizzas = $pizzas->pizzasVeg($isVeg);       
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();
        require "app/Views/front/pizzas.php";
    }

    function pigless($isPigless){
        $pizzas = new \Project\Models\ProduitsManager();
        $allPizzas = $pizzas->pizzasPigless($isPigless);       
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();
        require "app/Views/front/pizzas.php";
    }
    
    function burger(){
        $burgers = new \Project\Models\ProduitsManager();
        $allBurgers = $burgers->allBurgers();
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne(); 
        require "app/Views/front/burger.php";
    }
   
    function boissons(){
        $boissons = new \Project\Models\ProduitsManager();
        $allBoissons = $boissons->allBoissons();
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne(); 
        require "app/Views/front/boissons.php";
    }

    function alcool($isAlcool){
        $boissons = new \Project\Models\ProduitsManager();
        $allBoissons = $boissons->alcool($isAlcool);       
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();
        require "app/Views/front/boissons.php";
    }
    
    
    function connexionAdmin($pseudo, $mdp){
        $userManager = new \Project\Models\UserManager();
        $connexAdmin = $userManager->recupMdpAdmin($pseudo, $mdp);

        $result = $connexAdmin->fetch();
        
        if($result != false){

            $isPasswordCorrect = password_verify( $mdp, $result["pwd"]); /* Vérifie que le hachage fourni correspond bien au mot de passe fourni. */
            if ($isPasswordCorrect){
                 require "app/Views/back/tableauDeBordAdmin.php";
             }
        }else{
            echo '<script>alert("Vos identifiants sont incorrects");</script>';
            $slides = new \Project\Models\ImagesManager();
        $allSlides = $slides->getSlides(); 
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();         
        $reducs = new \Project\Models\ReducManager();
        $allReducs = $reducs->allReducs();
        require "app/Views/front/accueil.php";
        }
        
    }  
    
    function toto($errorsz=array()){     
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();
        require "app/Views/front/inscription.php";
    }
    function connexionUser($pseudoUser, $pwdUser){
        
            $userManager2 = new \Project\Models\UserManager();
            $connexAdmin2 = $userManager2->recupMdpUser($pseudoUser, $pwdUser);
            $result = $connexAdmin2->fetch();


            if($result != false){

                $isPasswordCorrect2 = password_verify($pwdUser, $result["userPWD"]); 
                
                
               if ($isPasswordCorrect2){
                    session_unset(); 
    
                    $_SESSION["userId"] = $result["userId"];
                    $_SESSION["userName"] = $result["userName"];
                    $_SESSION["userFirstname"] = $result["userFirstname"];
                    $_SESSION["userPhone"] = $result["userPhone"];
                    $_SESSION["userAdress"] = $result["userAdress"];
                    $_SESSION["userMail"] = $result["userMail"];
                    $_SESSION["userPWD"] = $result["userPWD"];
    
                    require "app/Views/back/tableauDeBordUser.php";
            }
            
               
            
        }else{
            echo '<script>alert("Vos identifiants sont incorrects");</script>';
            $slides = new \Project\Models\ImagesManager();
        $allSlides = $slides->getSlides(); 
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();         
        $reducs = new \Project\Models\ReducManager();
        $allReducs = $reducs->allReducs();
        require "app/Views/front/accueil.php";

        }
      }

    function contact($errors=array()){
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne(); 
        require "app/Views/front/contact.php";
    }

     function contactMail($lastname, $mail, $sujet, $content){
        $contactManager = new \Project\Models\ContactManager;
        // Removing all illegal characters from email
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

        $errors = array();

        if(!empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
            $errors["invalid_email"] = "Votre Email n'est pas valide";
        }
        if(empty($lastname)){
            $errors["required_name"] = "Votre nom est requis";
        }   
        if(empty($mail)){
            $errors["required_email"] = "Votre Email est requis";
        }
        if(empty($sujet)){
            $errors["required_sujet"] = "Un sujet  est requis";  
        }
        if(empty($content)){
            $errors["required_content"] =   "Un message est requis";
        }
        if(strlen($content) > 300){
            $errors["too_long_message"] = 'Votre message est trop long ... 300 caractères maximum';
        } 
      
        if(!empty($lastname)  && (!empty($mail) && (!empty($sujet) && (!empty($content))))) {
            if(empty($errors)) {
                $contactUserMail = $contactManager->mail($lastname, $mail, $sujet, $content);
                $aLaUne = new \Project\Models\ImagesManager();
                $allALaUne = $aLaUne->getALaUne(); 
                require "app/Views/front/contact.php";
                echo '<script>alert("message envoyé");</script>';
            }
        } else{
            $this->contact($errors);
        }
    }

   function inscription($userName, $userFirstname,  $userAdress, $userPhone, $userMail, $userPWD){
            $toto = new \Project\Models\UserManager;
            // Removing all illegal characters from email
            $userMail = filter_var($userMail, FILTER_SANITIZE_EMAIL);

            $errorsz = array();

        if(empty($userName)){
            $errorsz["required_userName"] = "Votre nom est requis";
        }
        
        if(empty($userFirstname)){
            $errorsz["required_userFirstname"] = "Votre prénom est requis";
        }
        
        if(empty($userAdress)){
            $errorsz["required_userAdress"] = "Votre adresse est requise";
        }

        if(empty($userPhone)){
            $errorsz["required_userPhone"] = "Votre numero de téléphone est requis";
        }

        if(!empty($userMail) && filter_var($userMail, FILTER_VALIDATE_EMAIL) == false) {
            $errorsz["invalid_userEmail"] = "Votre Email est incorrect";
            }

        if(empty($userMail)){
            $errorsz["required_userEmail"] = "Votre Email est requis";
        }
    
        if(empty($userPWD)){
            $errorsz["required_userPWD"] = "Votre mot de passe est requis";
        }
    
        if(!empty($userName)  && (!empty($userFirstname) && (!empty($userAdress) && (!empty($userPhone)  && (!empty($userMail) && (!empty($userPWD) )))))) {
            if(empty($errorsz)) {
                 
                $inscription = $toto->newUser($userName, $userFirstname, $userAdress, $userPhone, $userMail, $userPWD);
                $slides = new \Project\Models\ImagesManager();
                $allSlides = $slides->getSlides(); 
                $aLaUne = new \Project\Models\ImagesManager();
                $allALaUne = $aLaUne->getALaUne();         
                $reducs = new \Project\Models\ReducManager();
                $allReducs = $reducs->allReducs();
                require "app/Views/front/accueil.php";

                echo '<script>alert("Bravo, vous etes maintenant inscrit");</script>';
            }
        } else{
            $this->toto($errorsz);
        }
    }

}

/*function inscription(){
        require "app/Views/front/inscription.php";
    }
    function createUser($pseudo,$mdp){
        $userAdmin = new \Project\Models\UserManager();
        $user = $userAdmin->createUser($pseudo ,$mdp);
        header("Location: indexAdmin.php?action=tableauDeBord");
    }*/