<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["status"])) {
    $_SESSION["status"] = "";
}

require_once __DIR__ . '/../config/Config.php';

require '../model/User.php';

$db = Config::getDB();



function login()
{
    global $db;

    $data = [
        'name/email' => trim($_POST['name/email']),
        'usersPwd' => trim($_POST['usersPwd'])
    ];

    //Check for Inputs 
    if (empty($data['name/email']) || empty($data['usersPwd'])) {
        $_SESSION["status"] = "emptyInput";
        header("location: ../view/loginPage.php");
        exit();
    } else {
        $_SESSION["status"] = "";
    }
    $user = User::findUserByEmailOrUsername($db, $data['name/email'], $data['usersPwd']);

    // Check for user/email
    if (!is_null($user)) {
        //User Found
        $_SESSION["name/email"] = $data['name/email'];
        $_SESSION["user"] = $user;

        // if (!empty($_POST["remember"])) {
        //     setcookie("name/email", "{$data['name/email']}",60*60);
        //     setcookie("usersPwd", "{$data['usersPwd']}",60*60);
        // } else {
        //     setcookie("name/email", "");
        //     setcookie("usersPwd", "");
        // }
        // if (!empty($_POST["remember"])) {
        //     $_SESSION["name/email"] = $data['name/email'];
        //     $_SESSION["usersPwd"] = $data['usersPwd'];
        // } else {
        //     $_SESSION["name/email"] = "";
        //     $_SESSION["usersPwd"] = "";
        // }
        header("location: ../../index.php");
        exit();
    } else {
        $_SESSION["status"] = "failed";
        $_SESSION["user"] = null;
        header("location: ../view/loginPage.php");
        exit();
    }
}
function updateU($id, $isAdmin)
{
    global $db;
    return User::updateUser($db, $id, $isAdmin);
}

function isAdmin($id)
{
    global $db;
    return User::isAdmin($db, $id);
}

function delete($id)
{
    global $db;
    return User::delete($db, $id);
}

function getAllUsers()
{
    global $db;

    $Users = User::getAll($db);
    if ($Users) {
        $result = " <table class='table'>
                    <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Username</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>UserID</th>
                        <th scope='col'>isAdmin</th>
                        <th scope='col' class='d-flex justify-content-center'>Action</th>
                    </tr>
                    </thead>
                    <tbody>";

        foreach ($Users as $user) {

            $result .= "    <tr>
                                <th scope='row'>$user->id</th>
                                <td>$user->username</td>
                                <td>$user->usersEmail</td>
                                <td>$user->usersUid</td>
                                <td id='$user->id'><p>$user->isAdmin</p></td>
                                <td>
                                <div class='d-flex justify-content-between'>
                                    <a onClick='toggle($user->id)' class='edit' title='edit' ><i class='fa fa-edit'></i></a>
                                    <a href='../controller/DeleteUserC.php?id=$user->id' class='delete' title='Delete' data-toggle='tooltip'><i class='fa fa-trash'></i></a>
                                </div>
                                </td>
                            </tr>";
        }
        $result .= " </tbody>
                    </table>";


        return $result;
    } else {
        return '';
    }
}
if (isset($_GET["exec"])) {
    $exec = $_GET["exec"];
    login();
}
