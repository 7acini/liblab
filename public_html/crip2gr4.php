<?php
function CriaAlgo($tamanho){
        if($tamanho == 0) {$tamanho=6;}
        //          1       2       3
        //indice    012345678901234567890
        $sLetras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sNumeros = '0123456789';
        $lnt = $tamanho;
        $novaSenha='';
        for($lni = 0;$lni < $lnt;$lni++){
            if(($lni % 2) == 0){
                $sorte = intval(rand(0,25));
                $novaSenha .= substr($sNumeros,$sorte,1);
            }
        }
        return $novaSenha;
}

function FazSenha($username,$password){
        //create 256 bit (64 caracters) long random salt
        //Let's add 'something random' and the username 
        //to the salt  as well for added security
        $salt = hash('sha256',uniqid(mt_rand(),true) . CriaAlgo(26) . strtolower($username));
        //prefixe the password with the salt
        $hash = $salt . $password;
        $loops=113;
        //hash the salted password with the salt 
        for($i = 0;$i < $loops;$i++){
            $hash = hash('sha256',$hash);
        }
        //prefixe the hash with the salt so we can find it back later
        $hash = $salt . $hash;
        return $hash;
}

function ChecaSenha($password,$dbpassword){
    // the first 64 caracters of the hash is the salt 
    $salt = substr($dbpassword,0,64);
    $hash = $salt . $password;
    //ha the password as we did before 
    $loops = 113;
    for($i = 0;$i < $loops;$i++){
        $hash = hash('sha256',$hash);
    }
    $hash = $salt . $hash;
    if($hash == $dbpassword) {
        return true;
    }else{
        return false;
    }
}
?>