<?php

namespace App;


class MyDynamicForm
{

    private $valeurs;
    private $donnee;
    public $tag = 'p';


    public function __construct($valeurs = array())
    {
        $this->valeurs = $valeurs;
    }


    public function input($type, $name, $placeholder=null, $multiple=null, $id=null, $verification=null){
        return $this->retour ("<input class='form-control' id=".$id." $multiple type=".$type." name=" .$name." 
        placeholder=".$placeholder."> <small id=".$verification."> </small>");
    }


    public function select($name, $id=null){
        return $this->retour('<select id="'.$id.'" name="'.$name.'">
 <option value="Freelance">FREELANCE</option> 
 <option value="Entreprise">ENTREPRISE</option>
 </select>');
    }


    public function textarea($name, $message, $id=null, $verification=null, $class=null){
        return $this->retour ("<textarea id='$id' class='$class' name='$name' 
        placeholder='$message'></textarea> <small id='$verification'> </small>" );
    }

    public function submit($text, $class=null, $id=null, $title=null){
        return $this->retour ("<input class=' ".$class."' title='.$title.' required='required' type='submit' id='$id' value='$text'>") ;
    }



    private function retour($html){
        return "<{$this->tag}>$html</{$this->tag}>" ;
    }

    //accesseurs
    private function getValue($index){
        return  isset($this->valeurs[$index]) ? $this->valeurs[$index] : null;
    }

}