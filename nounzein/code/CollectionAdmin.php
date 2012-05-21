<?php
class CollectionAdmin extends ModelAdmin {

  public static $managed_models = array('Collection');

  static $url_segment = 'collections';
  static $menu_title = 'Collections';

  function init(){parent::init();Requirements::javascript('nounzein/javascript/admin.js');}
}
?>
