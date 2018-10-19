<?php
/**
 * Author: tegic
 * DateTime: 2018/10/19 9:24
 */

namespace teg1c\createScreenShot;
namespace iBrand\Miniprogram\Poster;
use Anam\PhantomMagick\Converter;
class ShareImg
{
	public static $conv = null;
	public static function init()
	{
		if (is_null(self::$conv) || !self::$conv instanceof Converter) {
			self::$conv = new Converter();
		}
		return self::$conv;
	}
	public static function generateShareImage($url, $type = 'default')
	{
		if (!$url) {
			return false;
		}
		$options = [
			'dimension'  => config('screenshot.width', '575px'),
			'zoomfactor' => config('screenshot.zoomfactor', 1.5),
			'quality'    => config('screenshot.quality', 100),
		];
		$saveName = date('Ymd') . '/' . $type . '_' . md5(uniqid()) . '.png';
		$file     = config('screenshot.disks.MiniProgramShare.root') . '/' . $saveName;
		$converter = self::init();
		$converter->source($url)->toPng($options)->save($file);
		if (config('screenshot.compress')) {
			self::imagePngSizeAdd($file);
		}
		return [
			'url'  => config('screenshot.MiniProgramShare.url'),
			'path' => $saveName,
		];
	}
	public static function imagePngSizeAdd($file)
	{
		list($width, $height, $type) = getimagesize($file);
		$new_width  = $width * 1;
		$new_height = $height * 1;
		//header('Content-Type:image/png');
		$resource = imagecreatetruecolor($new_width, $new_height);
		$image    = imagecreatefrompng($file);
		imagecopyresampled($resource, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagejpeg($resource, $file, config('screenshot.quality'));
		imagedestroy($resource);
	}
}