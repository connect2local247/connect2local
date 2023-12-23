<?php
      require "/code_generator/code_generator.php";

    
      if(!isset($_SESSION['KEY'])){
          $key = generateSecurityKey();
          $_SESSION['KEY'] = $key;
      }
      
      function encryptData($data, $key) {
          $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
          $ciphertext = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
          return base64_encode($iv . $ciphertext);
      }
  
      function decryptData($encryptedData, $key) {
          $decodedData = base64_decode($encryptedData);
          $iv = substr($decodedData, 0, openssl_cipher_iv_length('aes-256-cbc'));
          $ciphertext = substr($decodedData, openssl_cipher_iv_length('aes-256-cbc'));
          return openssl_decrypt($ciphertext, 'aes-256-cbc', $key, 0, $iv);
      }   
?>