<?php
session_start();

function generateCaptcha($length = 4) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $captcha = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $captcha;
}

$captcha = generateCaptcha();
$_SESSION['captcha'] = strtolower($captcha); // 将生成的验证码转换为小写并存储在会话中

// 创建图像
$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// 随机生成背景颜色
$bgColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
imagefill($image, 0, 0, $bgColor);

// 设置文本颜色
$textColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));

// 在图像上随机绘制验证码
$font = 30; // 字体大小
for ($i = 0; $i < strlen($captcha); $i++) {
    $x = rand(10, 30) + $i * 20; // 随机生成每个字符的x坐标
    $y = rand(10, 20); // 随机生成每个字符的y坐标
    imagestring($image, $font, $x, $y, $captcha[$i], $textColor);
}

// 增加噪点
for ($i = 0; $i < 100; $i++) {
    $noiseColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
}

// 输出图像
header('Content-Type: image/png');
imagepng($image);

// 释放内存
imagedestroy($image);
?>