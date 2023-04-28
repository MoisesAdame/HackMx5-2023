<!DOCTYPE html>
<html lang="es">

<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta property="og:image" content="https://hackmx.mx/images/hackmx-facebook.png" />
      <meta property="og:url"content="https://hackmx.mx/" />
      <meta property="og:title" content="HackMx by Tec de Monterrey" />

      <title>HackMx 2</title>

      <!--Font -->
      <link rel="stylesheet" href="https://use.typekit.net/bqt1rpy.css" />

      <!-- Bootstrap -->
      <link type="text/css" rel="stylesheet" href="stylesheets/bootstrap.min.css" />

      <!-- Magnific Popup -->
      <link type="text/css" rel="stylesheet" href="stylesheets/magnific-popup.css" />

      <!-- Font Awesome Icon -->
      <link rel="stylesheet" href="stylesheets/font-awesome.min.css">

      <!-- Custom stlylesheet -->
      <link type="text/css" rel="stylesheet" href="stylesheets/style.css" />
      <link type="text/css" rel="stylesheet" href="stylesheets/styleReg.css" />
      <style>

      .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
      }
      .autocomplete-items div {

            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
      }
      .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
      }
      .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
      }
      </style>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body>
      <!-- Header -->
      <header id="home">
            <!-- Background Image -->
            <div class="bg-img" style="background-color: #d97d7b;">
            </div>
            <!-- /Background Image -->

            <!-- Nav -->
            <nav id="nav" class="navbar nav-transparent">
                  <div class="container">

                        <div class="navbar-header">
                              <!-- Logo -->
                              <div class="navbar-brand">
                                    <a href="/">
                                          <img class="logo" src="images/logo.png" alt="logo">
                                          <img class="logo-alt" src="images/logo-alt.png" alt="logo">
                                    </a>
                              </div>
                              <!-- /Logo -->

                              <!-- Collapse nav button -->
                              <div class="nav-collapse">
                                    <span></span>
                              </div>
                              <!-- /Collapse nav button -->
                        </div>

                        <!--  Main navigation  -->
                        <ul class="main-nav nav navbar-nav navbar-right">
                              <li><a href="?inicio">Inicio</a></li>
                              <li class="active"><a href="#">Registro</a></li>
                              <li><a href="?miRegistro">Confirmar Registro</a></li>


                              <li><a href="//www.facebook.com/TecHackMx/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        </ul>
                        <!-- /Main navigation -->

                  </div>
            </nav>
            <!-- /Nav -->

            <!-- home wrapper -->
            <div class="home-wrapper">
                  <div class="container">
                        <div class="row">
                              <!-- Alerts -->
                              <div class="col-xs-12">
                                    <div class="hidden alert alert-success alert-dismissible"  id="registerAlertSuccess">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Registro exitoso!</strong> Revisa tu correo para completar el registro.[Checa spam :/]
                                    </div>
                                    <div class="hidden alert alert-danger alert-dismissible"  id="registerAlertFailure">
                                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <p id="registerAlertFailureMessage"><strong>Rayos!</strong> Hubo un problema con nuestros servidores inténtalo más tarde.</p>
                                    </div>
                              </div>
                              <!-- /Alerts -->

                              <!-- home content -->
                              <div class="col-xs-12">
                                    <form id="registrationForm">
                                          <div class="row">
                                                <div class="col-xs-12 col-md-4 mb form-group" id="groupInputName">
                                                      <label for="inputName" class="control-label" style="color:#fff">Nombre(s)*: </label>
                                                      <input type="text" class="form-control" name="name" id="inputName" placeholder="Juan" required>
                                                </div>
                                                <div class="col-xs-12 col-md-4 mb form-group" id="groupInputLastName">
                                                      <label for="inputLastName" class="control-label" style="color:#fff">Apellidos*: </label>
                                                      <input type="text" class="form-control" name="lastName" id="inputLastName" placeholder="Perez" required>
                                                </div>
                                                <div class="col-xs-12 col-md-4 mb form-group" id="groupInputEmail">
                                                      <label for="inputEmail" class="control-label" style="color:#fff">Correo*: </label>
                                                      <input type="email" class="form-control" name="email" id="inputEmail" placeholder="example@example.com" required>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-4 form-group mb" id="groupInputTel">
                                                      <label for="inputTel" class="control-label" style="color:#fff">Teléfono*: </label>
                                                      <input type="number" class="form-control" name="tel" id="inputTel" placeholder="55555555" required>
                                                </div>
                                                <div class="col-xs-12 col-md-8 form-group mb" id="groupInputInstitucion">
                                                      <label for="inputInstitucion" class="control-label" style="color:#fff">Institución*: </label>
                                                      <div class="autocomplete">
                                                            <input type="text" class="form-control" name="institucion" id="inputInstitucion" placeholder="Home Schooled" required>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row" >
                                                <div class="col-xs-12 col-md-4 form-group mb" id="groupInputBirthDate">
                                                      <label for="inputBirthDate" class="control-label" style="color:#fff">Fecha de nacimiento*: </label>
                                                      <input type="" name="birthDate" data-provide="datepicker" data-date-format="dd/MM/yyyy" id="inputBirthDate" data-date-language="es" placeholder="01/Abril/1994" required>
                                                </div>
                                                <div class="col-xs-12 col-md-8 mb form-group" id="groupInputLocalidad">
                                                      <label for="inputLocalidad" class="control-label" style="color:#fff">Localidad*: </label>
                                                      <select name="localidad" class="styled-select" id="inputLocalidad" required>
                                                            <option value="" disabled hidden selected>Elegir una opción...</option>
                                                            <option value="Aguascalientes">Aguascalientes</option>
                                                            <option value="Baja California">Baja California</option>
                                                            <option value="Baja California Sur">Baja California Sur</option>
                                                            <option value="Campeche">Campeche</option>
                                                            <option value="Coahuila">Coahuila</option>
                                                            <option value="Colima">Colima</option>
                                                            <option value="Chiapas">Chiapas</option>
                                                            <option value="Chihuahua">Chihuahua</option>
                                                            <option value="Cd. de Mexico">Cd. de México</option>
                                                            <option value="Durango">Durango</option>
                                                            <option value="Guanajuato">Guanajuato</option>
                                                            <option value="Guerrero">Guerrero</option>
                                                            <option value="Hidalgo">Hidalgo</option>
                                                            <option value="Jalisco">Jalisco</option>
                                                            <option value="Edo. de Mexico">Edo. de México</option>
                                                            <option value="Michoacan">Michoacán</option>
                                                            <option value="Morelos">Morelos</option>
                                                            <option value="Nayarit">Nayarit</option>
                                                            <option value="Nuevo Leon">Nuevo León</option>
                                                            <option value="Oaxaca">Oaxaca</option>
                                                            <option value="Puebla">Puebla</option>
                                                            <option value="Queretaro">Querétaro</option>
                                                            <option value="Quintana Roo">Quintana Roo</option>
                                                            <option value="San Luis Potosi">San Luis Potosí</option>
                                                            <option value="Sinaloa">Sinaloa</option>
                                                            <option value="Sonora">Sonora</option>
                                                            <option value="Tabasco">Tabasco</option>
                                                            <option value="Tamaulipas">Tamaulipas</option>
                                                            <option value="Tlaxcala">Tlaxcala</option>
                                                            <option value="Veracruz">Veracruz</option>
                                                            <option value="Yucatan">Yucatán</option>
                                                            <option value="Zacatecas">Zacatecas</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 form-group mb" id="groupInputGrado">
                                                      <label for="inputGrado" class="control-label" style="color:#fff">Grado de estudios*: </label>
                                                      <select class="styled-select" id="inputGrado" name="grado" required>
                                                            <option value="" disabled hidden selected>Elegir una opción...</option>
                                                            <option value="Bachiller">Bachiller</option>
                                                            <option value="Licenciante">Licenciante</option>
                                                            <option value="Maestrante">Maestrante</option>
                                                            <option value="Doctorante">Doctorante</option>
                                                      </select>
                                                </div>
                                                <div class="col-xs-12 col-md-6 form-group mb" id="groupInputGender">
                                                      <label for="inputSex" class="control-label" style="color:#fff">Sexo*: </label>
                                                      <select class="styled-select" id="inputSex" name="gender" required>
                                                            <option value="" disabled hidden selected>Elegir una opción...</option>
                                                            <option value="m">Masculino</option>
                                                            <option value="f">Femenino</option>
                                                            <option value="n">Prefiero no responder</option>
                                                      </select>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12">
                                                      <p class="semi-lead text-warning" style="color:#fff">En caso de estudiar en el Tecnológico de Monterrey, completar los campos siguientes.</p>
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="col-xs-12 col-md-6 form-group mb" id="groupInputCampus">
                                                      <label for="inputCampus" class="control-label" style="color:#fff">Campus: </label>
                                                      <select class="styled-select" id="inputCampus" name="campus">
                                                            <option value="" disabled hidden selected>Elegir una opción...</option>
                                                            <option value='Aguascalientes'>Aguascalientes</option>
                                                            <option value='Central de Veracruz'>Central de Veracruz</option>
                                                            <option value='Ciudad de México'>Ciudad de México</option>
                                                            <option value='Ciudad Juárez'>Ciudad Juárez</option>
                                                            <option value='Ciudad Obregón'>Ciudad Obregón</option>
                                                            <option value='Navojoa (Preparatoria)'>Navojoa (Preparatoria)</option>
                                                            <option value='Cuernavaca'>Cuernavaca</option>
                                                            <option value='Chiapas'>Chiapas</option>
                                                            <option value='Chihuahua'>Chihuahua</option>
                                                            <option value='Estado de México'>Estado de México</option>
                                                            <option value='Guadalajara'>Guadalajara</option>
                                                            <option value='Hidalgo'>Hidalgo</option>
                                                            <option value='Irapuato'>Irapuato</option>
                                                            <option value='León'>León</option>
                                                            <option value='Laguna'>Laguna</option>
                                                            <option value='Monterrey'>Monterrey</option>
                                                            <option value='Cumbres (Preparatoria)'>Cumbres (Preparatoria)</option>
                                                            <option value='Eugenio Garza Lagüera (Preparatoria)'>Eugenio Garza Lagüera (Preparatoria)</option>
                                                            <option value='Eugenio Garza Sada (Preparatoria)'>Eugenio Garza Sada (Preparatoria)</option>
                                                            <option value='Santa Catarina (Preparatoria)'>Santa Catarina (Preparatoria)</option>
                                                            <option value='Valle Alto (Preparatoria)'>Valle Alto (Preparatoria)</option>
                                                            <option value='Morelia'>Morelia</option>
                                                            <option value='Puebla'>Puebla</option>
                                                            <option value='Querétaro'>Querétaro</option>
                                                            <option value='Saltillo'>Saltillo</option>
                                                            <option value='San Luis Potosí'>San Luis Potosí</option>
                                                            <option value='Santa Fe'>Santa Fe</option>
                                                            <option value='Sinaloa'>Sinaloa</option>
                                                            <option value='Sonora Norte'>Sonora Norte</option>
                                                            <option value='Tampico'>Tampico</option>
                                                            <option value='Matamoros (Preparatoria)'>Matamoros (Preparatoria)</option>
                                                            <option value='Toluca'>Toluca</option>
                                                            <option value='Zacatecas'>Zacatecas</option>
                                                      </select>
                                                </div>
                                                <div class="col-xs-12 col-md-6 form-group mb" id="groupInputSemestre">
                                                      <label for="inputSemestre" class="control-label" style="color:#fff">Semestre: </label>
                                                      <input type="number" name="semestre" min="1">
                                                </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-xs-12 col-md-6 col-md-offset-3 mb form-group" id="groupInputCheckbox">
                                                  <label style="color: #fff"><input type="checkbox" name="cartaRespAlumnos"  id="inputCheckbox" value="Aceptar" required> He leído y acepto el <a href="https://tec.mx/es/aviso-de-privacidad-para-participantes-y-expositores-congresos-y-simposiums" style="color: #50205c">Aviso de Privacidad</a>.</label><br>
                                            </div>
                                          </div>
                                          <div class="row">
                                                <hr/>
                                                <div class="col-xs-12 text-center">
                                                      <button type="submit" class="btn btn-lg btn-send">Enviar</button>
                                                </div>
                                          </div>
                                    </form></div>
                              </div>
                        </div>
                  </div>
                  <!-- /home wrapper -->


            </header>
            <!-- /Header -->

            <!-- jQuery Plugins -->
            <script type="text/javascript" src="javascripts/jquery.min.js"></script>
            <script type="text/javascript" src="javascripts/bootstrap.min.js"></script>
            <script type="text/javascript" src="javascripts/main.js"></script>
            <script type="text/javascript" src="javascripts/jquery.magnific-popup.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript" src="javascripts/register.js"></script>
            <script src="javascripts/bootstrap-datepicker.es.js" charset="UTF-8"></script>
            <script type="text/javascript" src="javascripts/register.js"></script>
            <?php
            require "connect.php";
            $schoolQuery = "SELECT DISTINCT escuela FROM participantes";
            $schoolQuery = $connection->query($schoolQuery);
            $schools = array();
            if($schoolQuery->num_rows >0)
            {
                  while($row = $schoolQuery->fetch_assoc())
                  {
                        array_push($schools, $row["escuela"]);
                  }
            }

            ?>
            <script>
            var schools = <?php echo json_encode($schools); ?>;
            function autocomplete(inp, arr) {
                  /*the autocomplete function takes two arguments,
                  the text field element and an array of possible autocompleted values:*/
                  var currentFocus;
                  /*execute a function when someone writes in the text field:*/
                  inp.addEventListener("input", function(e) {
                        var a, b, i, val = this.value;
                        /*close any already open lists of autocompleted values*/
                        closeAllLists();
                        if (!val) { return false;}
                        currentFocus = -1;
                        /*create a DIV element that will contain the items (values):*/
                        a = document.createElement("DIV");
                        a.setAttribute("id", this.id + "autocomplete-list");
                        a.setAttribute("class", "autocomplete-items");
                        /*append the DIV element as a child of the autocomplete container:*/
                        this.parentNode.appendChild(a);
                        /*for each item in the array...*/
                        for (i = 0; i < arr.length; i++) {
                              /*check if the item starts with the same letters as the text field value:*/
                              if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                    /*create a DIV element for each matching element:*/
                                    b = document.createElement("DIV");
                                    /*make the matching letters bold:*/
                                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                    b.innerHTML += arr[i].substr(val.length);
                                    /*insert a input field that will hold the current array item's value:*/
                                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                                    /*execute a function when someone clicks on the item value (DIV element):*/
                                    b.addEventListener("click", function(e) {
                                          /*insert the value for the autocomplete text field:*/
                                          inp.value = this.getElementsByTagName("input")[0].value;
                                          /*close the list of autocompleted values,
                                          (or any other open lists of autocompleted values:*/
                                          closeAllLists();
                                    });
                                    a.appendChild(b);
                              }
                        }
                  });
                  /*execute a function presses a key on the keyboard:*/
                  inp.addEventListener("keydown", function(e) {
                        var x = document.getElementById(this.id + "autocomplete-list");
                        if (x) x = x.getElementsByTagName("div");
                        if (e.keyCode == 40) {
                              /*If the arrow DOWN key is pressed,
                              increase the currentFocus variable:*/
                              currentFocus++;
                              /*and and make the current item more visible:*/
                              addActive(x);
                        } else if (e.keyCode == 38) { //up
                              /*If the arrow UP key is pressed,
                              decrease the currentFocus variable:*/
                              currentFocus--;
                              /*and and make the current item more visible:*/
                              addActive(x);
                        } else if (e.keyCode == 13) {
                              /*If the ENTER key is pressed, prevent the form from being submitted,*/
                              e.preventDefault();
                              if (currentFocus > -1) {
                                    /*and simulate a click on the "active" item:*/
                                    if (x) x[currentFocus].click();
                              }
                        }
                  });
                  function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                  }
                  function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                              x[i].classList.remove("autocomplete-active");
                        }
                  }
                  function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                              if (elmnt != x[i] && elmnt != inp) {
                                    x[i].parentNode.removeChild(x[i]);
                              }
                        }
                  }
                  /*execute a function when someone clicks in the document:*/
                  document.addEventListener("click", function (e) {
                        closeAllLists(e.target);
                  });
            }
            autocomplete(document.getElementById("inputInstitucion"), schools);


            </script>

      </body>

      </html>
