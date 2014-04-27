<?php

//wrap the data into a json object and return with correct header type.
$this->output->set_header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);

?>