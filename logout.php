<?php 

    function logout() {
        setcookie('auth', 'ok', time() - 10);
        header("Location: /");
    }   