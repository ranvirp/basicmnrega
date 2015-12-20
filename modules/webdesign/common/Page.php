<?php
namespace app\modules\webdesign\common;
class Page 
{
	public $layout;
	public $content;
	public $html;
	/*

      creates layout of a page with placeholder for inserting
      content
	*/
	public function makePage($layout,$content)
	{
       $page=new Page;
       $page->makeLayout($layout);
       $page->fillContent($content);
	}
	/*
      Layout consists of elements placed from top to bottom
      and left to right. There are 12 grids horizontally with
      vertical height of 1000px. Boxes are placed on this space
      .Boxes have following properties:
        1. horizontal grid location in form of range
        2. vertical height
        3. Type 
             - simple div box
             - ordered list
             - table
        4. Additional properties
        Box may consist of other boxes.

	*/
	public function makeLayout($layout)
	{


	}

}