<?php
interface Imprimible
{
   public function imprime();
}

class Curriculum implements Imprimible
{
   public function imprime(){
      return "imprime el currículum";
   }
}

class Informe implements Imprimible
{
   public function imprime(){
      return "imprime el informe";
   }
}

class Impresora
{
   public function imprimir(Imprimible $algo){
      echo $algo->imprime();
   }
}

abstract class Main
{
   public static function run(){
      $impresora = new Impresora();

      $impresora->imprimir(new Curriculum());
      echo "<br>";
      $impresora->imprimir(new Informe());
      // $impresora->imprimir("asjo");
   }
}

Main::run();