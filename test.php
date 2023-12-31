<?php
       $addressPattern = '/^(?=.*[A-Za-z0-9])[A-Za-z0-9\s,-]{10,50}(?:(?:\s?-\s?\d{1,2})|(?:\s?[A-Za-z\s]+))?$/';

        // Example usage
        $address = "A-25,Dhaval Plaza,kadi-382715";
        if (preg_match($addressPattern, $address) && strlen($address) <= 50) {
            echo "<h1>Valid address!</h1>";
        } else {
            echo "<h1>Invalid address!</h1>";
        }
        
?>