<?php

class ImageGalleryImage extends Image 
{
	public function generateRotateClockwise(GD $gd) 
	{
		return $gd->rotate(90);
	}
	
	public function generateRotateCounterClockwise(GD $gd)
	{
		return $gd->rotate(270);
	}
	
	public function clearResampledImages()
	{
		$files = glob(Director::baseFolder().'/'.$this->Parent()->Filename."_resampled/*-$this->Name");
	 	foreach($files as $file) {unlink($file);}
	}
	
	public function Landscape()
	{
		return $this->getWidth() > $this->getHeight();
	}
	
	public function Portrait()
	{
		return $this->getWidth() < $this->getHeight();
	}
	
	function BackLinkTracking() {return false;}
	
	/**
	 * Resize this Image by width, keeping aspect ratio. Use in templates with $SetWidth.
	 * @return GD
	 * @author CODEM
	 */
	public function generateSetWidth(GD $gd, $width) {
		$this->gdSetQuality($gd);
		return parent::generateSetWidth($gd, $width);
	}
	
	/**
	 * Resize this Image by height, keeping aspect ratio. Use in templates with $SetHeight.
	 * @return GD
	 * @author CODEM
	 */
	public function generateSetHeight(GD $gd, $height){
		$this->gdSetQuality($gd);
		return parent::generateSetHeight($gd, $height);
	}
	
	/**
	 * Given a box size of $width and  $height, resize the image by the minimum amount it takes to fit the image into the box
	 * @note requires some CSS overflow:hidden on the container element to hide the overflow
	 * @author CODEM
	 */
	function generateBoundIntoBox($gd, $width, $height) {
		
		$this->gdSetQuality($gd);
		
		$src_width = $this->getWidth();
		$src_height = $this->getHeight();
		
		$h_ratio = $height / $src_height;
		$w_ratio = $width / $src_width;
		
		//the minimum reduction ration to resize by (parent element will overflow in CSS)
		//i.e g by the max reduction ratio
		$ratio = max($h_ratio, $w_ratio);
		
		$width = round($ratio * $src_width);
		$height = round($ratio * $src_height);
		
		//now resize the image to this determined size
		return $gd->resize($width, $height);
	}
	
	/** 
	 * gdSetQuality()
	 * @note sets a quality on GD
	 * @note quality can be defined in config (0 - 100)
	 * @author CODEM
	 */
	private function gdSetQuality(&$gd) {
		$config = SiteConfig::current_site_config()->getAllFields();
		$quality = (isset($config['ImageThumbQuality']) && $config['ImageThumbQuality'] > 0 ? $config['ImageThumbQuality'] : 80);
		$gd->setQuality($quality);
	}
	
}

?>
