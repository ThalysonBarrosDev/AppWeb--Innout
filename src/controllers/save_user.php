<?php

    session_start();
    requireValidSession(true);

    $exception = null;
    $userdata = [];

    if (count($_POST) === 0 && isset($_GET['update'])) {

        $user = User::getOne(['id' => $_GET['update']]);
        $userdata = $user->getValues();
        $userdata['password'] = null;

    } elseif (count($_POST) > 0) {

        try {

            $dbuser = new User($_POST);

            if($dbuser->id) {

                $dbuser->update();
                addSuccessMsg('Usuário alterado com sucesso!');
                header('Location: users.php');
                exit();

            } else {

                $dbuser->insert();
                addSuccessMsg('Usuário cadastrado com sucesso!');

            }

            $_POST = [];

        } catch(Exception $e) {

            $exception = $e;

        } finally {

            $userdata = $_POST;

        }
    }

    loadTemplateView('save_user', $userdata + ['exception' => $exception]);