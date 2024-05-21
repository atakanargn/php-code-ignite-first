<?php

namespace App\Controllers;

use App\Controllers\BaseController;


use App\Models\Duyuru;
use App\Models\Mesajlar;
use App\Models\User;
use App\Models\Admin;
use App\Models\Demirbas;

use Config\Services;
use Config\Database;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->index();
    }

    public function index()
    {
        if (isset($_SESSION['loggedIn'])) {
            return redirect()->to('/anasayfa');
        } else {
            return redirect()->to('/giris');
        }
    }

    public function login()
    {
        if (isset($_SESSION['loggedIn'])) {
            return redirect()->to('/anasayfa');
        } else {
            return view('giris');
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/giris');
    }
    public function dashboard()
    {
        if (isset($_SESSION['loggedIn'])) {
            if ($_SESSION['role'] == 'admin')
                return view('anasayfa_admin');
            else
                return view('duyurular_user');
        } else {
            return redirect()->to('/giris');
        }
    }

    public function doLogin()
    {
        $role = $this->request->getVar('role');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $errors = [];

        // Rol seçilmemişse
        if ($role == null) {
            // errors dizisine ekle
            $errors[] = 'Lütfen rol seçin!';
        }

        // E-posta alanı boş bırakılmışsa
        if (empty($email)) {
            // errors dizisine ekle
            $errors[] = 'E-posta alanı boş bırakılamaz!';
        }

        // Şifre alanı boş bırakılmışsa
        if (empty($password)) {
            // errors dizisine ekle
            $errors[] = 'Şifre alanı boş bırakılamaz!';
        }

        // error dizisi boyutu 1 ise 
        if (count($errors) == 1) {
            // Tek hata var demektir, sonuna <br> tagi eklemeden, hata değişkenine at 
            $_SESSION['danger'] = $errors[0];
            // error dizisi boyutu 1'den büyükse
        } elseif (count($errors) > 1) {
            // Tüm hataları $_SESSION['danger'] değişkenine ekliyoruz. 
            for ($i = 0; $i < count($errors); $i++) {
                // $_SESSION['danger'] değişkenini kontrol ediyoruz. Eğer tanımlı değilse, boş bir string ile başlatıyoruz. 
                if (!isset($_SESSION['danger'])) {
                    $_SESSION['danger'] = '';
                }
                // Hata mesajını $_SESSION['danger'] değişkenine ekliyoruz. 
                // <br> tagi de ekliyoruz 
                $_SESSION['danger'] .= $errors[$i] . "<br>";
            }
        }

        if (isset($_SESSION["danger"])) {
            return redirect()->to('/giris');
        }

        if ($role == 1) {
            // Admin modeli alında
            $adminModel = new Admin();
            $user = $adminModel->verifyAdmin($email, $password);
            if ($this->request->getMethod() == 'POST') {
                if (!empty($user->resultID->num_rows > 0) || $user->resultID->num_rows > 0) {
                    $data = $user->getResult();
                    if (!password_verify($password, $data[0]->password)) {
                        $_SESSION['danger'] = 'Kullanıcı adı ya da parolanız yanlış!';
                        return redirect()->to('/giris');
                    } else {
                        $_SESSION['id'] = $data[0]->id;
                        $_SESSION['role'] = 'admin';
                        $_SESSION['fullname'] = $data[0]->fullname;
                        $_SESSION['email'] = $email;
                        $_SESSION['loggedIn'] = true;
                        return redirect()->to('/anasayfa');
                    }
                } else {
                    $_SESSION['danger'] = 'Kullanıcı adı ya da parolanız yanlış!';
                    return redirect()->to('/giris');
                }
            }
        } else {
            // User modeli alında
            $userModel = new User();
            $user = $userModel->verifyUser($email, $password);
            if ($this->request->getMethod() == 'POST') {
                if (!empty($user->resultID->num_rows > 0) || $user->resultID->num_rows > 0) {
                    $data = $user->getResult();
                    if (!password_verify($password, $data[0]->password)) {
                        $_SESSION['danger'] = 'Kullanıcı adı ya da parolanız yanlış!';
                        return redirect()->to('/giris');
                    } else {
                        $_SESSION['id'] = $data[0]->id;
                        $_SESSION['role'] = 'user';
                        $_SESSION['fullname'] = $data[0]->fullname;
                        $_SESSION['email'] = $email;
                        $_SESSION['loggedIn'] = true;
                        return redirect()->to('/anasayfa');
                    }
                } else {
                    $_SESSION['danger'] = 'Kullanıcı adı ya da parolanız yanlış!';
                    return redirect()->to('/giris');
                }
            }
        }
    }

    public function addUserPage()
    {
        if ($this->request->getMethod() == 'GET') {
            if ($_SESSION['role'] == 'admin') {
                $db = Database::connect();

                // SQL sorgusunu çalıştırın
                $query = $db->query("
                    SELECT *, 'user' as role FROM users
                    UNION ALL
                    SELECT *, 'admin' as role FROM admins
                ");



                $data['results'] = $query->getResult();

                return view('kullanicilar', $data);
            } else {
                echo '404 Not Found';
            }

        } elseif ($this->request->getMethod() == 'POST') {

            $userModel = new User();
            $adminModel = new Admin();

            $id = $this->request->getVar('id');
            $fullname = $this->request->getVar('fullname');
            $role = $this->request->getVar('role');
            $email = $this->request->getVar('email');

            $action = $this->request->getVar('action');

            if ($action == 'update') {
                if ($role == 'user') {
                    $userModel->updateUser($id, ['fullname' => $fullname, 'email' => $email]);
                } else {
                    $adminModel->updateUser($id, ['fullname' => $fullname, 'email' => $email]);
                }
                return redirect()->to('/kullanicilar');
            } elseif ($action == 'delete') {
                if ($role == 'user') {
                    $userModel->deleteUser($id);
                } else {
                    $adminModel->deleteAdmin($id);
                }
                return redirect()->to('/kullanicilar');
            } else {
                $fullname = $this->request->getVar('fullname');
                $role = $this->request->getVar('role');
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $errors = [];

                // Rol seçilmemişse
                if ($role == null) {
                    // errors dizisine ekle
                    $errors[] = 'Lütfen rol seçin!';
                }

                // Ad soyad alanı boş bırakılmışsa
                if (empty($fullname)) {
                    // errors dizisine ekle
                    $errors[] = 'Ad soyad alanı boş bırakılamaz!';
                }

                // E-posta alanı boş bırakılmışsa
                if (empty($email)) {
                    // errors dizisine ekle
                    $errors[] = 'E-posta alanı boş bırakılamaz!';
                }

                // Şifre alanı boş bırakılmışsa
                if (empty($password)) {
                    // errors dizisine ekle
                    $errors[] = 'Şifre alanı boş bırakılamaz!';
                }

                // error dizisi boyutu 1 ise 
                if (count($errors) == 1) {
                    // Tek hata var demektir, sonuna <br> tagi eklemeden, hata değişkenine at 
                    $_SESSION['danger'] = $errors[0];
                    // error dizisi boyutu 1'den büyükse
                } elseif (count($errors) > 1) {
                    // Tüm hataları $_SESSION['danger'] değişkenine ekliyoruz. 
                    for ($i = 0; $i < count($errors); $i++) {
                        // $_SESSION['danger'] değişkenini kontrol ediyoruz. Eğer tanımlı değilse, boş bir string ile başlatıyoruz. 
                        if (!isset($_SESSION['danger'])) {
                            $_SESSION['danger'] = '';
                        }
                        // Hata mesajını $_SESSION['danger'] değişkenine ekliyoruz. 
                        // <br> tagi de ekliyoruz 
                        $_SESSION['danger'] .= $errors[$i] . "<br>";
                    }
                }

                if (isset($_SESSION["danger"])) {
                    return redirect()->to('/kullanicilar');
                }

                if ($role == "1") {
                    $userModel = new Admin();
                    $data = ['fullname' => $fullname, 'email' => $email, 'password' => $password];
                    $userModel->createAdmin($data);
                    $_SESSION['success'] = 'Kullanıcı başarıyla eklendi!';
                    return redirect()->to('/kullanicilar');
                } else {
                    $userModel = new User();
                    $data = ['fullname' => $fullname, 'email' => $email, 'password' => $password];
                    $userModel->createUser($data);
                    $_SESSION['success'] = 'Kullanıcı başarıyla eklendi!';
                    return redirect()->to('/kullanicilar');
                }
            }
        }
    }

    public function DemirbasPage()
    {
        if ($this->request->getMethod() == 'GET') {
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    $db = Database::connect();

                    // SQL sorgusunu çalıştırın
                    $query = $db->query("SELECT * FROM demirbas ORDER BY id DESC;");

                    $data['results'] = $query->getResult();

                    return view('anasayfa_admin', $data);
                } else {
                    echo '404 Not Found';
                }
            } else {
                return redirect()->to('/');
            }

        } elseif ($this->request->getMethod() == 'POST') {

            $duyuruModel = new Demirbas();

            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $description = $this->request->getVar('description');
            $status = $this->request->getVar('status');
            $price = $this->request->getVar('price');

            $action = $this->request->getVar('action');

            if ($action == 'update') {
                $duyuruModel->updateDemirbas($id, ['description' => $description, 'status' => $status]);
                return redirect()->to('/anasayfa');
            } elseif ($action == 'delete') {
                $duyuruModel->deleteDemirbas($id);
                return redirect()->to('/anasayfa');
            } else {
                $errors = [];

                // Ad soyad alanı boş bırakılmışsa
                if (empty($name)) {
                    // errors dizisine ekle
                    $errors[] = 'Ad alanı boş bırakılamaz!';
                }

                // Status alanı boş kontrolü
                if ($status == null) {
                    // errors dizisine ekle
                    $errors[] = 'Durum alanı boş bırakılamaz!';
                }

                $description = $description == null ? '' : $description;

                // error dizisi boyutu 1 ise 
                if (count($errors) == 1) {
                    // Tek hata var demektir, sonuna <br> tagi eklemeden, hata değişkenine at 
                    $_SESSION['danger'] = $errors[0];
                    // error dizisi boyutu 1'den büyükse
                } elseif (count($errors) > 1) {
                    // Tüm hataları $_SESSION['danger'] değişkenine ekliyoruz. 
                    for ($i = 0; $i < count($errors); $i++) {
                        // $_SESSION['danger'] değişkenini kontrol ediyoruz. Eğer tanımlı değilse, boş bir string ile başlatıyoruz. 
                        if (!isset($_SESSION['danger'])) {
                            $_SESSION['danger'] = '';
                        }
                        // Hata mesajını $_SESSION['danger'] değişkenine ekliyoruz. 
                        // <br> tagi de ekliyoruz 
                        $_SESSION['danger'] .= $errors[$i] . "<br>";
                    }
                }

                if (isset($_SESSION["danger"])) {
                    return redirect()->to('/anasayfa');
                }

                $demirbasModel = new Demirbas();
                $data = ['name' => $name, 'status' => $status, 'description' => $description, 'price' => $price];
                $demirbasModel->createDemirbas($data);
                return redirect()->to('/anasayfa');
            }
        }
    }

    public function DuyuruPage()
    {
        if ($this->request->getMethod() == 'GET') {
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    $db = Database::connect();

                    // SQL sorgusunu çalıştırın
                    $query = $db->query("SELECT * FROM duyuru ORDER BY id DESC;");

                    $data['results'] = $query->getResult();

                    return view('duyurular', $data);
                } else {
                    echo '404 Not Found';
                }
            } else {
                return redirect()->to('/');
            }

        } elseif ($this->request->getMethod() == 'POST') {

            $duyuruModel = new Duyuru();

            $id = $this->request->getVar('id');
            $content = $this->request->getVar('content');
            $status = $this->request->getVar('status');
            $action = $this->request->getVar('action');

            if ($action == 'update') {
                $duyuruModel->updateDuyuru($id, ['content' => $content]);
                return redirect()->to('/duyurular');
            } elseif ($action == 'delete') {
                $duyuruModel->deleteDuyuru($id);
                return redirect()->to('/duyurular');
            } else {
                $errors = [];

                if (empty($content)) {
                    $errors[] = 'İçerik alanı boş bırakılamaz!';
                }

                if ($status == null) {
                    $errors[] = 'Durum alanı boş bırakılamaz!';
                }

                if (count($errors) == 1) {
                    $_SESSION['danger'] = $errors[0];
                } elseif (count($errors) > 1) {
                    for ($i = 0; $i < count($errors); $i++) {
                        if (!isset($_SESSION['danger'])) {
                            $_SESSION['danger'] = '';
                        }
                        $_SESSION['danger'] .= $errors[$i] . "<br>";
                    }
                }

                if (isset($_SESSION["danger"])) {
                    return redirect()->to('/duyurular');
                }

                $duyuruModel = new Duyuru();
                $data = ['content' => $content, 'status' => $status, 'created_by' => $_SESSION['id']];
                $duyuruModel->createDuyuru($data);
                return redirect()->to('/duyurular');
            }
        }
    }

    public function MesajPage()
    {
        if ($this->request->getMethod() == 'GET') {
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    $db = Database::connect();

                    // SQL sorgusunu çalıştırın
                    $query = $db->query("SELECT * FROM mesajlar ORDER BY id DESC");

                    $data['results'] = $query->getResult();

                    return view('mesajlar', $data);
                } else {
                    echo '404 Not Found';
                }
            } else {
                return redirect()->to('/');
            }

        } elseif ($this->request->getMethod() == 'POST') {

            $mesajlarModel = new Mesajlar();

            $id = $this->request->getVar('id');
            $reply = $this->request->getVar('reply');
            $action = $this->request->getVar('action');

            if ($action == 'update') {
                if (empty($reply)) {
                    $_SESSION['danger'] = 'Cevap alanı boş bırakılamaz!';
                    return redirect()->to('/mesajlar');
                }

                $mesajlarModel->updateMesaj($id, ['reply' => $reply]);
                return redirect()->to('/mesajlar');
            } elseif ($action == 'read') {
                $mesajlarModel->readMesaj($id);
                return redirect()->to('/mesajlar');
            }
        }
    }

    public function UserDuyuru()
    {
        if ($this->request->getMethod() == 'GET') {
            $db = Database::connect();

            // SQL sorgusunu çalıştırın
            $query = $db->query("SELECT d.id as id, d.content as content, d.status as status, a.email as created_by, d.created_at as created_at FROM duyuru d LEFT JOIN admins a ON a.id=d.created_by ORDER BY d.id DESC;");

            $data['results'] = $query->getResult();

            return view('duyurular_user', $data);
        }
    }

    public function DemirbasUserPage()
    {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM demirbas ORDER BY id DESC;");
        $data['results'] = $query->getResult();
        return view('demirbas_liste', $data);
    }

    public function DemirbasUserAjax()
    {
        header("Content-type:application/json;");
        $db = Database::connect();
        if(isset($_GET['q'])){
            $query = $db->query("
            SELECT * FROM demirbas
            WHERE
            name LIKE '%".$_GET['q']."%' OR
            description LIKE '%".$_GET['q']."%' OR
            status LIKE '%".$_GET['q']."%' OR
            price LIKE '%".$_GET['q']."%'
            ORDER BY id DESC;");
        }else{
            $query = $db->query("SELECT * FROM demirbas ORDER BY id DESC;");
        }

        $data['results'] = $query->getResult();
        echo json_encode($data['results']);
        exit();
    }

    public function MesajlarUserPage()
    {
        if ($this->request->getMethod() == 'GET') {
            $db = Database::connect();
            $query = $db->query("SELECT * FROM mesajlar WHERE created_by=".$_SESSION['id']." ORDER BY id DESC;");
            $data['results'] = $query->getResult();
            return view('mesajlar_user', $data);
        } else {

            $content = $this->request->getVar('content');

            $mesajModel = new Mesajlar();
            $data = ['content' => $content, 'created_by' => $_SESSION['id']];
            $mesajModel->createMesaj($data);
            return redirect()->to('/mesajlar');
        }
    }

    public function SifreDegistirPage(){
        

        if($this->request->getMethod() == 'POST'){
            $userModel = new User();

            $current_password = $this->request->getVar('current_password');
            $new_pass = $this->request->getVar('new_pass');
            $re_pass = $this->request->getVar('re_pass');

            if(empty($current_password)){
                $_SESSION['danger'] = 'Geçerli şifre alanı boş bırakılamaz!';
                return redirect()->to('/sifre');
            }

            if(empty($new_pass)){
                $_SESSION['danger'] = 'Yeni şifre alanı boş bırakılamaz!';
                return redirect()->to('/sifre');
            }

            if(empty($re_pass)){
                $_SESSION['danger'] = 'Yeni şifre tekrar alanı boş bırakılamaz!';
                return redirect()->to('/sifre');
            }

            if($new_pass!=$re_pass){
                $_SESSION['danger'] = 'Yeni şifre ile şifre tekrarı uyuşmuyor!';
                return redirect()->to('/sifre');
            }

            $user = $userModel->verifyUser($_SESSION['email'], $current_password);

            if (!empty($user->resultID->num_rows > 0) || $user->resultID->num_rows > 0) {
                $data = $user->getResult();
                if (!password_verify($current_password, $data[0]->password)) {
                    $_SESSION['danger'] = 'Geçerli parolanızı yanlış girdiniz!';
                    return redirect()->to('/sifre');
                } else {
                    $userModel->updateUserPassword($_SESSION['id'],['password'=>$new_pass]);
                    session_destroy();
                    $_SESSION['success'] = 'Şifreniz başarıyla güncellendi!<br/>Yeni şifreniz ile giriş yapabilirsiniz!';
                    return redirect()->to('/giris');
                }
            }
        }else{
            return view('sifre_degistir');
        }
    }
}