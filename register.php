<?php 

    function crearUsuario($username, $password){
        $file = fopen("usersDB.txt", "a");

        fwrite($file, PHP_EOL . $username . " " . $password).PHP_EOL;

        fclose($file);
    }

    function verificarUsuario($username){
        $file = fopen("usersDB.txt", "r");

        $dato = ' ';

        while($dato = fgetcsv($file, 1000000, " ")){
            $usuariosBD[] = $dato[0];
        }

        $verificacion = in_array($username, $usuariosBD);

        //retorna un valor booleano
        return $verificacion;
    }

    
    
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])){
       
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $error = null;
        $bandera = true;

        // echo "<pre>";
        // var_dump("Username => ", $username);
        // var_dump("Password => ", $password);
        // var_dump("Password2 => ", $password2);
        // echo "</pre>";
       
        //Si las contraseñas no coinciden, se termina la ejecución del programa
        if($password != $password2){
            $error = "* Las contraseñas tienen que ser iguales";
            $bandera = false;
        }

        // Luego, veririficamos el usuario si existe en la BD
        if(verificarUsuario($username)){
            $error = "* El usuario ya existe.";
            $bandera = false;
        };

        if($bandera){
            //Si todo esta correcto, procedemos a crear el usuario en la base de datos
            crearUsuario($username, $password);
        }

        // header("Location: /");
        // die();
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />

    <title>Register Hi Tweets!</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section class="h-full gradient-form bg-gray-200 md:h-screen">
        <div class="container py-12 px-6 h-full mx-auto">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="xl:w-10/12">
                    <div class="block bg-white shadow-lg rounded-lg">
                        <div class="lg:flex lg:flex-wrap g-0">
                        <div class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none" style="
                background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%)
              ">
                                <div class="text-white px-4 py-6 md:p-12 md:mx-6">
                                    <h4 class="text-xl font-semibold mb-6">We are more than just a company</h4>
                                    <p class="text-sm">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.
                                    </p>
                                </div>
                            </div>
                            <div class="lg:w-6/12 px-4 md:px-0">
                                <div class="md:p-12 md:mx-6">
                                    <div class="text-center flex justify-center">
                                        <a href="/">
                                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-12 sm:h-9" alt="Flowbite Logo">
                                        </a>
                                    </div>
                                    <form method="POST">
                                        <div class="mb-4">
                                            <label for="username" class="form-label inline-block mb-2 text-gray-700">Username</label>
                                            <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name='username' placeholder="Username" required/>
                                        </div>
                                        <div class="mb-4">
                                            <label for="password" class="form-label inline-block mb-2 text-gray-700">Password</label>
                                            <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name='password' placeholder="Password" required />
                                        </div>
                                        <div class="mb-4">
                                            <label for="password2" class="form-label inline-block mb-2 text-gray-700">Repeat Password</label>
                                            <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name='password2' placeholder="Repeat Password" required />
                                        </div>
                                        <div class="text-center pt-1 mb-12 pb-1">
                                            <button class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3" type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light" style="
                        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%)
                      ">
                                                Join Us
                                            </button>
                                            <?php if(isset($error)):?>
                                                <?php echo "<p class='text-red-600'>$error</p>" ?>
                                            <?php endif; ?>
                                            
                                        </div>
                                        <div class="flex items-center justify-between pb-6">
                                            <p class="mb-0 mr-2">Already have an account?</p>
                                            <a href="./login.php" class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                                Login
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>