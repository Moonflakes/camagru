<?PHP
session_start();
if (isset($_POST['submit']))
{
    $camera = explode(",", $_POST['camera']);
    $u = $_POST['camera'];
    $name = json_decode($_POST['name']);
    $top = json_decode($_POST['top']);
    $left = json_decode($_POST['left']);
    $width = json_decode($_POST['width']);
    $height = json_decode($_POST['height']);
    $check = json_decode($_POST['check']);
    $src = json_decode($_POST['src']);

    $img = str_replace(' ', '+', $camera[1]);
    $data = base64_decode($img);
    
    $im = imagecreatefromstring($data); //créer l'image de la camera

    foreach ($name as $key => $value) {
        $im2 = imagecreatefrompng($src[$key]);
        $size = getimagesize($src[$key]);

        if (imagecopyresized($im, $im2, $left[$key], $top[$key], 0, 0, $width[$key], $height[$key], $size[0], $size[1]))
        {
            ob_start(); // Let's start output buffering.
                imagepng($im); //This will normally output the image, but because of ob_start(), it won't.
                $contents = ob_get_contents(); //Instead, output above is saved to $contents
            ob_end_clean(); //End the output buffer.
            $encode = base64_encode($contents);
            $str = $camera[0].",".$encode;
        }
    }
    $arr = array("submit" => $_POST['submit'], "cam" => $u, "data" => $str, "o" => $size);
}
else
{
    print("il n'y a pas de post");
    $arr = array("arr" => "blabla");
}
echo json_encode($arr);

?>