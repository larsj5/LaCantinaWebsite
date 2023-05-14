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

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    //The form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $dateErr = $timeErr = $nameErr = $emailErr = $guestsErr = $messageErr = "";
        $date = $time = $name = $email = $guests = $message =  "";
         
        //Check the query date field
        if (!empty($_POST["date"])) {
            $date = clean_input($_POST["date"]);
        }
        else
        {
            $typeErr = "Date is required";
            $validations['dateError'] = $dateErr;
        }

        //Check the query time field
        if (!empty($_POST["time"])) {
            $time = clean_input($_POST["time"]);
            $time = $time . ':00';
        }
        else
        {
            $timeErr = "Time is required";
            $validations['timeError'] = $timeErr;
        }

        //Check the query name field
        if (!empty($_POST["name"])) {
            $name = clean_input($_POST["name"]);
        }
        else
        {
            $nameErr = "Name is required";
            $validations['nameError'] = $nameErr;
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

        //Check the query number of guests field
        if (!empty($_POST["guests"])) {
            $guests = clean_input($_POST["guests"]);
            if (!filter_var($guests, FILTER_VALIDATE_INT))
            {
                $guestsErr= 'You did not enter a number for the guests.';
                $validations['guestsError'] = $guestsErr;
            }

        }
        else
        {
            $guestsErr = "Number of Guests is required";
            $validations['guestsError'] = $guestsErr;
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
            $message = "No special requests";
        }

        //If all's ok
        if (empty($dateErr) && empty($timeErr) && empty($nameErr) 
            && empty($emailErr) && empty($guestsErr) && empty($messageErr))
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

            debug_to_console($date);
            debug_to_console($time);
            debug_to_console($name);
            debug_to_console($email);
            debug_to_console($guests);
            debug_to_console($message);

            $sql = "INSERT INTO Reservations (date, time, name, email, guests, requests) VALUES ('$date', '$time', '$name', '$email', $guests, '$message')";
            $message = mysqli_query($conn, $sql);
            $validations['pagemessage'] = "Form submitted successfully. Thank you!";
        }
        else
        {
            debug_to_console($validations);
            //Repopulate text fields with submitted data 
            $formvalues['date'] = $date;
            $formvalues['time'] = $time;
            $formvalues['name'] = $name;
            $formvalues['email'] = $email;
            $formvalues['guests'] = $guests;
            $formvalues['message'] = $message;
            $validations['pagemessage'] = "There are some issues with this form";

        }
        
        //Render view with validations (or success message)
        echo $twig->render('reservation.html', [ 
           'validations' => $validations,
           'formvalues' => $formvalues]);
    }

    else
    {
        //Render view without validations
        echo $twig->render('reservation.html');
    }
