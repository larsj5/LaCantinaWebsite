<?php
    require_once __DIR__.'/bootstrap.php';
    require_once __DIR__.'/database.php';

    function clean_input($data) {
        $data = trim($data);
        //stripslashes(): The stripslashes() function removes backslashes.
        $data = stripslashes($data);
        //htmlspecialchars(): Convert special characters to HTML entities.
        $data = htmlspecialchars($data);
        return $data;
    }

    //The form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $typeErr = $emailErr = $messageErr = "";
        $type = $email = $message = "";
         
        //Check the query type field
        if (!empty($_POST["type"])) {
            $type = clean_input($_POST["type"]);
        }
        else
        {
            $typeErr = "Type is required";
            $validations['typeError'] = $typeErr;
        }
            
        //Check email field
        if (!empty($_POST["email"])) {
            $email = clean_input($_POST["email"]);
            //FILTER_VALIDATE_EMAIL is one of many validation filters: https://www.php.net/manual/en/filter.filters.validate.php
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailErr= 'You did not enter a valid email.';
                $validations['emailError'] = $emailErr;
            }
        }
        else
        {
            $emailErr = "Email is required";
            $validations['emailError'] = $emailErr;
        }
         
        //Check message field   
        if (!empty($_POST["message"])) {
            $message = clean_input($_POST["message"]);
            if(strlen($message)>150){
                $messageErr=  "Messages cannot be longer than 150 characters.";
                $validations['messageError'] = $messageErr;
            }
        }
        else {
            $messageErr = "Message is required";
            $validations['messageError'] = $messageErr;
        }

        //If all's ok
        if (empty($emailErr) && empty($typeErr) && empty($messageErr))
        {
            $formvalues = [];

            // Connexion à la base de données
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "resto";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Vérification de la connexion
            if (!$conn) {
            die("La connexion a échoué : " . mysqli_connect_error());
            }

            $sql = "INSERT INTO Contact VALUES ('$type','$email','$message')";
            if (mysqli_query($conn, $sql));

            $validations['pagemessage'] = "Form submitted successfully. Thank you!";
        }
        else
        {
            //Repopulate text fields with submitted data 
            $formvalues['email'] = $email;
            $formvalues['message'] = $message;
            $validations['pagemessage'] = "There are some issues with this form";
        }
        
        //Render view with validations (or success message)
        echo $twig->render('contact.html', [ 
            'validations' => $validations,
            'formvalues' => $formvalues]);
    }

    else
    {
        //Render view without validations
        echo $twig->render('contact.html');
    }
