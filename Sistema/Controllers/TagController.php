<?php
/*
* Descrição da TagController
*
* @author Lucas
*/
require_once("..\Models\TagModel.php");
require_once("..\Data Objects\Tag.php");

//utiliza a namespace de tag
use Data\Object\Tag;

class  TagController{
     public function createTag($param){
           $createTag = new Tag();
           //Cria um novo objeto da classe Tag.
           $createTag->tag = $param["tag"];
           $createTag->idPostagem = $param["idPostagem"];
           //Recebe os valores e atribui aos registros.

           $objTag = new TagModel();
           $objTag->create($createTag);
           //Cria um objeto Model da Tag e salva os valores no banco de dados.
        }
     public function readTag($tag){
           $objTag = new TagModel();

           return $objTag->read('idPostagem',$tag["id"],"");
        }
	     public function readTagNome($tag){
           $objTag = new TagModel();

           return $objTag->read('tag',$tag,"");
        }
}
?>

