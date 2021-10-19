<?php
interface Controller {

    /**
     * traite la variable $_REQUEST reçue en paramètre.
     */
    public function handle($request);
}
?>
