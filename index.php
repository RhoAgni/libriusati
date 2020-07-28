<!DOCTYPE html>
<html>
    <head>
       <style>
           .modal-backdrop {
                z-index: -1;
            }
           
       </style>
       
   </head>
   <title>Libri Usati</title>
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
      <!-- First Parallax Image with Logo Text -->
      <div style="height:25%; margin-top:40px" class=" w3-display-container w3-white w3-padding-16" id="home">
     
         <div class="w3-display-middle w3-hide-small" style="white-space:nowrap; ">
             <div class="w3-col s3 w3-center">
            <figure class="w3-hide-small" class="w3-hide-medium" id="signin-logo"><img src="./images/logonbg.jpg" alt="sing up image"></figure>
            </div>
             <div class="w3-col s9 w3-center">
            <form class="form-inline" action="portfolio.php" method="GET">
               <input id="l" type="text" placeholder="Cerca per titolo, autore o ISBN" aria-label="Search" name="search" />
            </form>
            </div>
         </div>
        
         <div class="w3-display-middle w3-hide-large w3-hide-medium" style="white-space:nowrap; ">
            <figure class="w3-hide-large hide-medium" class="w3-hide-medium" id="signin-logo"><img src="./images/logonbg.jpg" alt="sing up image"></figure>
            <form class="form-inline" method="GET" action="portfolio.php">
               <input id="s" type="text" placeholder="Cerca..." aria-label="Search" name="search" />
            </form>
         </div>
      </div>
      <!-- Container (About Section) -->
      <br>
      <div class="container" style="width:100%;">
         <div class="row">
            <div class="col-sm" style="margin-top:1%; margin-bottom:2%">
               <div class="w3-container w3-content text-center" id="about">
                  <h3 class="w3-margin-top">SEI UNO STUDENTE?</h3>
                  <p>Vorresti risparmiare sui libri? Vuoi guadagnare qualcosa sui vecchi libri che non usi più? Grazie a noi potrai farlo! Compra e vendi libri in buone condizioni a prezzi onesti e vantaggiosi.</p>
               </div>
            </div>
            <div class="col-sm" style="margin-top:1%; margin-bottom:1%">
               <div class=" w3-container w3-content text-center" id="about">
                  <h3 class="w3-margin-top">CHI SIAMO</h3>
                  <p>Siamo un gruppo di Genitori di alunni dell'ITSOS Marie Curie di Cernusco sul Naviglio (MI). Abbiamo deciso di costituire questo Comitato Genitori per aiutare la scuola a migliorare la qualità dell'offerta formativa di tutto l'Istituto.</p>
               </div>
            </div>
         </div>
      </div>
      <BR>
      <!-- Container (Portfolio Section) -->
      <div class="w3-content w3-display-container" id="portfolio">
         <h3 class="w3-center">MATERIE</h3>
         <br>
         <!-- Responsive Grid. Four columns on tablets, laptops and desktops. Will stack on mobile devices/small screens (100% width) -->
         <div class="w3-row-padding w3-center">
            <a href="./portfolio.php?search=scienze">
            <div class="w3-col m3 container">
               <img src="./images/scienze.jpg" alt="Avatar" class="image">
               <div class="overlay w3-cente">
                  <div class="text">Scienze</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=chimica">
            <div class="w3-col m3 container">
               <img src="./images/chimica.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Chimica</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=filosofia">
            <div class="w3-col m3 container">
               <img src="./images/filosofia.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Filosofia</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=arte">
            <div class="w3-col m3 container">
               <img src="./images/arte.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Arte</div>
               </div>
            </div>
            </a>
         </div>
         <div class="w3-row-padding w3-center w3-section">
             <a href="./portfolio.php?search=informatica">
            <div class="w3-col m3 container">
               <img src="./images/informatica.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Informatica</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=italiano">
            <div class="w3-col m3 container">
               <img src="./images/italiano.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Italiano</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=inglese">
            <div class="w3-col m3 container">
               <img src="./images/inglese.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Inglese</div>
               </div>
            </div>
            </a>
            <a href="./portfolio.php?search=fisica">
            <div class="w3-col m3 container">
               <img src="./images/fisica.jpg" alt="Avatar" class="image">
               <div class="overlay">
                  <div class="text">Fisica</div>
               </div>
            </div>
            </a>
         </div>
      </div>
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
      <script text="text/javascript">
         $('#ModalLogin').modal('handleUpdate');
      </script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>