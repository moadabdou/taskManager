<?php 
interface Middleware{
    public function handle(array $req): array;
}

?>