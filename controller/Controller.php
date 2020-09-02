<?php

abstract class Controller
{
    protected function redirect(string $location, int $status = 302): void
    {
        header('Location ' . $location, true, $status);
        die;
    }
}