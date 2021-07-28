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
    
    function toto($errorsz=array()){     
        $aLaUne = new \Project\Models\ImagesManager();
        $allALaUne = $aLaUne->getALaUne();
        require "app/Views/front/inscription.php";
    }








    
    function connexion($pseudo, $mdp){
        $userManager = new \Project\Models\UserManager();
        $connexAdmin = $userManager->recupMdp($pseudo, $mdp);
        $result = $connexAdmin->fetch();
        $isPasswordCorrect = password_verify( $mdp, $result["pwd"]); /* Vérifie que le hachage fourni correspond bien au mot de passe fourni. */
        $_SESSION["pseudo"] = $result["pseudo"];
        $_SESSION["pwd"] = $result["pwd"];

        if ($isPasswordCorrect){
            require "app/Views/back/tableauDeBord.php";
        }
        else {
            echo "vos identifiants sont incorectes";
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
            $errors["invalid_email"] = "The e-mail is invalid";
        }
        if(empty($lastname)){
            $errors["required_name"] = "The name is required";
        }   
        if(empty($mail)){
            $errors["required_email"] = "The e-mail is required";
        }
        if(empty($sujet)){
            $errors["required_sujet"] = "The subject is required";  
        }
        if(empty($content)){
            $errors["required_content"] =   "The message is required";
        }
        if(strlen($content) > 300){
            $errors["too_long_message"] = 'Message is too long ! 300 characters maximum are allowed';
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
            $errorsz["required_userName"] = "The name is required";
        }
        
        if(empty($userFirstname)){
            $errorsz["required_userFirstname"] = "The Firstname is required";
        }
        
        if(empty($userAdress)){
            $errorsz["required_userAdress"] = "The adress is required";
        }

        if(empty($userPhone)){
            $errorsz["required_userPhone"] = "The Phone number is required";
        }

        if(!empty($userMail) && filter_var($userMail, FILTER_VALIDATE_EMAIL) == false) {
            $errorsz["invalid_userEmail"] = "The e-mail is invalid";
            }

        if(empty($userMail)){
            $errorsz["required_userEmail"] = "The e-mail is required";
        }
    
        if(empty($userPWD)){
            $errorsz["required_userPWD"] = "The password is required";
        }
    
            
        if(!empty($userName)  && (!empty($userFirstname) && (!empty($userAdress) && (!empty($userPhone)  && (!empty($userMail) && (!empty($userPWD) )))))) {
            if(empty($errorsz)) {
                 
                $inscription = $toto->newUser($userName, $userFirstname, $userAdress, $userPhone, $userMail, $userPWD);
                $aLaUne = new \Project\Models\ImagesManager();
                $allALaUne = $aLaUne->getALaUne(); 
                require "app/Views/front/inscription.php";
                echo '<script>alert("message envoyé");</script>';
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