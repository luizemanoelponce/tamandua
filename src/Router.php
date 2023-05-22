<?php
Namespace Tarefas;

class Router {

    public $routes;

    public function __construct(){
        $this->routes = [];
    }

    public function Route($method, $path, $callback){
        try{
            $method = strtoupper($method);

            if($path){
                if(is_callable($callback)){
                    array_push($this->routes, [$method, $path, $callback]);
                } else {
                    throw new \Exception("A função não é válida");
                }
            } else {
                throw new \Exception("o caminho precisa ser válido");
            }
        } catch(\Exception $e){
            echo $e;
            die();
        }

    }

    public function isRoute(){

        /* REQUEST_URI REQUEST_METHOD PATH_INFO*/

        try{

            /* retorna lista de rotas registradas compatíveis com o método da requisição */

            $routesWithMethod = array_filter($this->routes, function($var){
                return ($var[0] === $_SERVER['REQUEST_METHOD']);
            });

            /* lança erro se não existe rota definida com o método da requisição */
            if(!$routesWithMethod){
                $metodoDaChamada = $_SERVER['REQUEST_METHOD'];
                throw new \Exception("Nenhuma rota com o método $metodoDaChamada definida");
            }
            $isRoute = array_filter($routesWithMethod, function($var){
                //separa o path das rotas selecionadas para testar
                $registredPath = $var[1];
                $requestPath = $_SERVER['PATH_INFO'] ? $_SERVER['PATH_INFO'] : "/";

                return ($registredPath === $requestPath);
            });

            /* lança erro se não existe rota definida com o compatível com da requisição, se existe chama callback */
            if($isRoute){

                // $i =array_keys($isRoute);

                // $i = $i[0];

                // $callback = $isRoute[$i][2];
                // return $callback();

                return $isRoute[array_keys($isRoute)[0]][2]();
                
            } else {
                throw new \Exception("Nenhuma rota compatível definida");
                die();
            }

            echo "<br><br>";

            var_dump($isRoute);
            echo "<br><br>";
            echo "<br><br>";
            echo "<br><br>";

        }catch(\Exception $e){
            echo "excessão lançada: {$e->getMessage()}";
            die();
        }
        


        echo "<br><br>";

        var_dump( explode('/', $_SERVER['REQUEST_URI']));

        echo "<br><br>";

        echo $_SERVER['REQUEST_URI'];
    }

    public function getRoutes(){

        return var_dump($this->routes);
    }


}