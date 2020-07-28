<!DOCTYPE html>
<html>
    <head>
       <style>
           .modal-backdrop {
                z-index: -1;
            }
           
       </style>
       
   </head>
<title>Pagina libro</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <!-- Font Icon -->
   <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
   <link rel="stylesheet" href="css/style_index.css">
   <!-- Main css -->
   <link type="text/xss" rel="stylesheet" href="css/style.css">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- Font Icon -->
   <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- Main css -->
   <link rel="stylesheet" href="css/style.css">
   <script>
      function readUrl(input) {
      
          if (input.files && input.files[0]) {
              let reader = new FileReader();
              reader.onload = (e) => {
                  let imgData = e.target.result;
                  let imgName = input.files[0].name;
                  input.setAttribute("data-title", imgName);
                  console.log(e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      
      }
      $(function() {
          $('[data-toggle="popover"]').popover()
      })
   </script>
<body>
 <?php
         session_start();
         include "connection.php";
         include "register.php";
         include "login.php";
         
         $id_libro=$_GET['id'];
         if($_SESSION['login']=="si"){
             $username = $_SESSION['username'];
             $mail = $_SESSION['email'];
             $accedi_txt="Ciao ".$username;
             $registrati_txt="";
         }else {
             $accedi_txt="Accedi";
             $registrati_txt="Registrati";
         }
         
         function logout(){
             session_destroy();
             header("location: https://www.libriusati.net/");
         }
         
         if(isset($_POST['usernameTopBar'])){
             logout();
         }
         
         if(isset($_POST['contatta_btn'])){
             contatta();
         }
         
         function contatta(){
            $mail=$_POST["mail_contatta"];
            $message=$_POST["messaggio_contatta"];
            $to="postmaster@libriusati.net";
            $subject="contatta_service";
            $headers = "From: $mail\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($to,$subject,$message,$headers, "-f$mail");
            echo "<script>alert('messaggio inviato');</script>";
         }
         dati($conn, $id_libro);
         
         ?>
      <!-- Modal -->
      <div class="modal bd-example-modal-lg fade w3-animate-zoom" id="ModalSignup" tabindex="-1" role="dialog" aria-labelledby="ModalSignupLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body" style="margin-bottom: -8%">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="signup-content">
                     <div class="signup-form">
                        <h2 class="form-title">Registrati</h2>
                        <form method="POST" class="register-form" id="register-form" action="">
                           <div class="form-group">
                              <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                              <input type="text" name="username_signup" id="name" placeholder="Username" required/>
                           </div>
                           <div class="form-group">
                              <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                              <input type="number" name="tel_signup" id="name" placeholder="Numero di telefono" min="9" required/>
                           </div>
                           <div class="form-group">
                              <label for="email"><i class="zmdi zmdi-email"></i></label>
                              <input type="email" name="email_signup" id="email" placeholder="Email" required/>
                           </div>
                           <div class="form-group">
                              <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                              <input type="password" name="password_signup" id="pass" placeholder="Password" required/>
                           </div>
                           <div class="form-group">
                              <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                              <input type="password" name="re_password" id="re_pass" placeholder="Ripeti password" required/>
                           </div>
                           <div class="form-group">
                              <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
                              <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                           </div>
                           <div class="form-group form-button">
                              <input type="submit" name="signup_btn" id="signup" class="form-submit" value="Registrati" style="background-color:grey; " />
                           </div>
                        </form>
                     </div>
                     <div class="signup-image">
                        <figure class="w3-hide-small" class="w3-hide-medium" id="signup-logo"><img src="./images/Logo.png" alt="logo"></figure>
                        <!--<a href="./login.php" class="signup-image-link">I am already member</a>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal bd-example-modal-lg fade w3-animate-zoom" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="signin-content">
                     <div class="signin-image">
                        <figure class="w3-hide-small" class="w3-hide-medium" id="signin-logo"><img src="./images/Logo.png" alt="logo"></figure>
                        <a class="signup-image-link" href="lost_password.php">password dimenticata</a>
                     </div>
                     <div class="signin-form">
                        <h2 class="form-title">Accedi</h2>
                        <form action="" method="POST" class="register-form" id="login-form">
                           <div class="form-group">
                              <label for="your_mail"><i class="zmdi zmdi-account material-icons-mail"></i></label>
                              <input type="email" name="mail_signin" id="your_mail" placeholder="Email" required/>
                           </div>
                           <div class="form-group">
                              <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                              <input type="password" name="password_signin" id="your_pass" placeholder="Password" required/>
                           </div>
                           <div class="form-group">
                              <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                           </div>
                           <div class="form-group form-button">
                              <input type="submit" name="signin_btn" id="signin" class="form-submit" value="Accedi" style="background-color:grey" />
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Navbar (sit on top) -->
      <div class="w3-top" style="background-color:white; color:black;">
         <div class="w3-bar" id="myNavbar">
            <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
            <i class="fa fa-bars"></i>
            </a>
            <a href="https://www.libriusati.net/" class="w3-bar-item w3-buttond">HOME</a>
            <a href="https://www.libriusati.net/#about" class="w3-bar-item w3-button w3-hide-small" onclick="toggleFunction()">CHI SIAMO</a>
            <a href="#contact" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> CONTATTACI</a>
            
            <?php if($_SESSION["login"]!="si"){ echo '
               <a href="javascript:void(0)" class="w3-bar-item w3-button float-right" data-toggle="modal" data-target="#ModalLogin" id="accedi_btn">
                  Accedi
               </a>
               <a href="javascript:void(0)" class="w3-bar-item w3-button float-right" data-toggle="modal" data-target="#ModalSignup" style="a:visited{ color:black;}">
                     Registrati
               </a>';} else {
                   echo '
               <div class="w3-dropdown-hover float-right">
                       <button class="w3-button" name="usernameTopBar" type="submit">'.$accedi_txt.'</button>
                       <div class="w3-dropdown-content w3-bar-block w3-border">
                          <form action="" method="POST">
                              <input type="submit" class="w3-bar-item w3-button" name="usernameTopBar" name="logout_btn" value="esci" />
                              <a href="https://www.libriusati.net/profilo.php" class="w3-bar-item w3-button" />Il mio profilo</a>
                              <input data-toggle="modal" data-target="#exampleModalCenter" class="w3-bar-item w3-button" value="inserisci libro" />
                              <input data-toggle="modal" data-target="#exampleModalCenter1" class="w3-bar-item w3-button" value="libro desideri" />
                            </form>
                       </div>
                    </div>
               <!-- Navbar on small screens -->
                 <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
                    <a href="#about" class="w3-bar-item w3-button" onclick="toggleFunction()">CHI SIAMO</a>
                    <a href="#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTATTACI</a>
                 </div>
              </div>';
               }
               ?>
         </div>
         
         

         <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Inserimento Libri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group inputDnD" >
                       <form action="insert_book.php" method="POST" enctype="multipart/form-data">
                          <div class="w3-row-padding" style="margin-top:-3px;">
                               <ul>
                                    <li>Se si vuole inserire più autori, bisgna dividerli con una virgola.</li>
                                    <li>Il prezzo che sarà impostato nell'annuncio equivale alla metà del prezzo dichiarato.</li>
                                </ul>
                          </div>
                          <input required name="book_img" type="file" class="form-control-file text-primary font-weight-bold" id="book_img" onchange="readUrl(this)" data-title="Trascina un'immagine" data-height="366" data-width="366" data-title-color="#c1c1c1">
                          <div class="w3-row-padding" style="margin-top:8px;">
                             <div class="w3-half w3-container">
                               <!-- <label>ISBN</label>-->
                                <input required name="book_isbn" class="w3-input w3-border" maxlength="13" minlength="13" type="text" style="height: 40px;" placeholder="ISBN">
                             </div>
                             <div class="w3-half w3-container">
                                <!--<label>Titolo</label>-->
                                <input required name="book_title" class="w3-input w3-border" type="text" style="height: 40px;"  placeholder="Titolo">
                             </div>
                          </div>
                          <div class="w3-row-padding" style="padding-top: 7px;">
                             <div class="w3-half w3-container">
                               <!-- <label>Autori</label>-->
                                <input required name="author" class="w3-input w3-border" type="text" style="height: 40px;" placeholder="Autori">
                             </div>
                             <div class="w3-half w3-container">
                                <!--<label>Edizione</label>-->
                                <input required name="edition" class="w3-input w3-border" type="text" style="height: 40px;" placeholder="Edizione">
                             </div>
                          </div>
                          <div class="w3-row-padding" style="padding-top: 7px;">
                             <div class="w3-half w3-container">
                                <select name="condition" class="w3-select w3-border" style="height: 40px;" required >
                                   <option selected disabled>/5</option>
                                   <option value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                                   <option value="5">5</option>
                                </select>
                             </div>
                             <div class="w3-half w3-container">
                                <!--<label>Prezzo (€)</label>-->
                                <input name="original_price" required class="w3-input w3-border"  type="number" style="height: 40px;" placeholder="Prezzo (€)">
                             </div>
                          </div>
                          <div class="w3-row-padding" style="padding-top: 7px;">
                            <div class="w3-half w3-container">
                                <input name="materia" required class="w3-input w3-border"  type="text" style="height: 40px;" placeholder="Materia">
                            </div>
                          
                            <div class="w3-half w3-container">
                                <!--<label>Prezzo (€)</label>-->
                                <!--<input name="inserisci_btn" type="submit" class="btn btn-primary" style="width:100%;" value="Inserisci" />-->
                                <button type="submit" class="btn btn-primary" style="width:100%;">Inserisci</button>
                             </div>
                             
                          </div>
                       </form>
                       
                    </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Lista dei desideri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group inputDnD" >
                       <form action="insert_search.php" method="POST" enctype="multipart/form-data">
                          
                          <div class="w3-row-padding" style="margin-top:8px;">
                             <div class="w3-half w3-container">
                               <!-- <label>ISBN</label>-->
                                <input required name="book_isbn_search" class="w3-input w3-border" maxlength="13" minlength="13" type="text" style="height: 40px;" placeholder="ISBN">
                             </div>
                              <div class="w3-half w3-container">
                               <!-- <label>ISBN</label>-->
                                <p>Inserisci l'ISBN di un libro che desideri, ti avviseremo appena sarà disponibile.</p>
                             </div>
                          </div>
                          <div class="w3-row-padding" style="padding-top: 0px;">
                          
                            <div class="w3-half w3-container">
                                <!--<label>Prezzo (€)</label>-->
                                <!--<input name="inserisci_btn" type="submit" class="btn btn-primary" style="width:100%;" value="Inserisci" />-->
                                <button type="submit" class="btn btn-primary" style="width:100%;">Inserisci</button>
                             </div>
                             
                          </div>
                       </form>
                       
                    </div>
              </div>
            </div>
          </div>
        </div>
        
         <!-- Navbar on small screens -->
         <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
            <a href="#about" class="w3-bar-item w3-button" onclick="toggleFunction()">CHI SIAMO</a>
            <a href="#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTATTACI</a>
         </div>
      </div>



<?php
function dati($con, $id_l){
    $query1="SELECT * FROM books WHERE id_book=$id_l";
    $libri=mysqli_query($con, $query1);
    if($libri->num_rows != 0){  //acq dati da DB
        $dati=$libri->fetch_assoc();  
        $GLOBALS['titolo']=$dati['titolo'];
        $GLOBALS['materia']=$dati['materia'];
        $GLOBALS['copertina']=$dati['copertina'];
        $GLOBALS['edizione']=$dati['edizione'];
        $GLOBALS['condizione']=$dati['condizione'];
        $GLOBALS['prezzo']=$dati['original_price']/2;
        $id_venditore=$dati['user'];
        $query2="SELECT * FROM writes WHERE cod_book=$id_l";
        $query_venditore="SELECT * FROM users WHERE id_user=$id_venditore";
        $venditore_q=mysqli_query($con, $query_venditore);
        if($venditore_q->num_rows==1){
            $dati_venditore=$venditore_q->fetch_assoc();
            $GLOBALS['email_venditore']=$dati_venditore['mail'];
        }
        
        /*$autore=mysqli_query($con, $query2);
        foreach($autore as $dati_a){  //acq dati da DB
            $autore_id=$dati_a['cod_author'];
            autore($autore_id, $con);
        }*/
        /*if($autore->num_rows != 0){
            $dati_a=$autore->fetch_assoc();
            $autore_id=$dati_a['cod_author'];
            autore($autore_id, $con);
        }*/
    }else{
        echo '<script>alert("il libro non esiste");</script>';
    }
    
    
}
?>

<div class="w3-content w3-container w3-padding-64" id="about">
  <?php echo '<h3 class="w3-center">Titolo: '.$titolo.'</h3>' ?> <br>
  <?php echo '<h4 class="w3-center">Edizione: '.$edizione.'</h4>' ?>
  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-large">
        <?php echo '<img src="'.$copertina.'" class="w3-round w3-image" alt="Libri" width="480" height="320">' ?>
    </div>
    
<?php
autore($id_libro, $conn);
function autore($id_li, $con){
    $query3="SELECT authors.* FROM authors, writes WHERE writes.cod_book=$id_li AND writes.cod_author=authors.id_author";
    $d_autore=mysqli_query($con, $query3);
    $n_righe=$d_autore->num_rows; $k=0;
    if($n_righe > 1){echo '<h4 class="w3-center">Autori: ';} else{echo '<h4 class="w3-center">Autore: ';}
    foreach($d_autore as $nome_a){  //acq dati da DB
        $k++;
        $autore_nome=$nome_a['nome'];
        if($n_righe>$k){
            echo ''.$autore_nome.', ';
        }else{
            echo ''.$autore_nome.'';
        }
    }
}

?>
</h4>
<!-- Container (About Section) -->

    <?php //echo '<h4 class="w3-center">Autore: '.$cognome_a.' '.$nome_a.'</h4>' ?>
    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-padding-large">
    	
    	<div class="w3-row w3-center w3-dark-grey w3-padding-16">
            <div class="w3-third w3-section">
                Condizione <br>
                <?php echo '<span class="w3-xlarge">'.$condizione.'/5</span>' ?>
            </div>
            <div class="w3-third w3-section">
                Prezzo <br>
                <?php echo '<span class="w3-xlarge">'.$prezzo.'€</span>' ?>
            </div>
            <div class="w3-third w3-section">
        	    Materia <br>
                <?php echo '<span class="w3-xlarge">'.$materia.'</span>' ?>
            </div>
        </div>
        <br>
        <?php echo '<h6 class="w3-center">Mail venditore: '.$email_venditore.'</h6>' ?>
        <a href=<?php echo '"mailto:'.$email_venditore.'"' ?> type="button" class="btn btn-outline-info btn-lg btn-block">Contatta il venditore</a>

    </div>
  </div>
</div>

<!-- Footer -->
      <footer class="w3-center w3-black w3-padding-64">
         <!-- Container (Contact Section) -->
         <div class="w3-content w3-container w3-padding-64" id="contact">
            <h3 class="w3-center">CONTATTACI</h3>
            <div class="w3-content w3-padding-64 w3-center">
               <div class="w3-large w3-margin-bottom">
                  <a href="https://www.google.it/maps/place/ITSOS+Marie+Curie/@45.5229992,9.3110847,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c803318e7ca7:0xcbcbb6f9b0762d8d!8m2!3d45.5229992!4d9.3132734" class="w3-text-white"><i class="fa fa-map-marker fa-fw w3-xlarge w3-margin-right"></i>Via Masaccio 4, Cernusco Sul Naviglio (MI)<br></a>
                  <a href="tel:3273454307" class="w3-text-white"><i class="fa fa-phone fa-fw  w3-xlarge w3-margin-right"></i>Telefono: +00 151515<br></a>
                  <a href="mailto:postmaster@libriusati.net" class="w3-text-white"><i class="fa fa-envelope fa-fw  w3-xlarge w3-margin-right"></i>postmaster@libriusati.net<br></a> 
                  <a href="https://www.paypal.me/comitatogenitori" class="w3-text-white"><i class="fa fa-paypal fa-fw  w3-xlarge w3-margin-right"></i>Sostieni il comitato</a> 
                  <br>
               </div>
               <form method="POST" action="" name="contatta_form">
                  <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                     <div class="w3-half w3-text-black">
                        <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name" id="nome_contatta" />
                     </div>
                     <div class="w3-half w3-text-black">
                        <input class="w3-input w3-border" type="text" placeholder="La tua mail" required name="mail_contatta" />
                     </div>
                  </div>
                  <div class="w3-text-black w3-margin-bottom">
                  <input class="w3-input w3-border" type="text" placeholder="Message" required name="messaggio_contatta">
                  </div>
                  <input type="submit" name="contatta_btn" id="contatta_btn" class="form-contatta" value="Send message" style="background-color:grey" />
               </form>
            </div>
         </div>
         <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
      </footer>

<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>